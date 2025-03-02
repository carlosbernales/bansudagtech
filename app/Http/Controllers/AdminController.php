<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Farms;
use App\Models\CalamityReport;
use App\Models\Assistance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\WeatherAlert;
use App\Mail\Announcements;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }

        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();
        $farmCount = Farms::count();
        $farmers = Accounts::where('role', 'user')->count();

        $reports = CalamityReport::count();
        $completedReports = CalamityReport::where('status', 'Completed')->count();

        $calamityReportsByMonth = CalamityReport::selectRaw('MONTH(date_reported) as month, YEAR(date_reported) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $chartData = [
            'labels' => $calamityReportsByMonth->map(function ($report) {
                return date('F Y', mktime(0, 0, 0, $report->month, 1, $report->year));
            }),
            'data' => $calamityReportsByMonth->pluck('count'),
        ];

        $farms = Farms::all()->map(function ($farm) {
            $recordCount = DB::table('calamity_report')
                ->where('location', $farm->location)
                ->count();
            $farm->record_count = $recordCount;
            return $farm;
        });

        $defaultLocation = Farms::first()?->location ?? null;

        $calamityReports = CalamityReport::selectRaw('YEAR(date_reported) as year, MONTH(date_reported) as month, crop_type, animal_type, COUNT(*) as count')
            ->where(function ($query) {
                $query->whereNotNull('crop_type')
                    ->where('crop_type', '!=', '')
                    ->orWhereNotNull('animal_type')
                    ->where('animal_type', '!=', '');
            })
            ->groupBy('year', 'month', 'crop_type', 'animal_type')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $groupedData = $calamityReports->groupBy(function ($report) {
            return date('F Y', mktime(0, 0, 0, $report->month, 1, $report->year));
        })->map(function ($group) {
            return [
                'crop' => $group->where('crop_type', '!=', null)->sum('count'),
                'animal' => $group->where('animal_type', '!=', null)->sum('count'),
            ];
        });

        $groupedLabels = $groupedData->keys();
        $groupedCrops = $groupedData->pluck('crop');
        $groupedAnimals = $groupedData->pluck('animal');

        $totalCrops = $calamityReports->whereNotNull('crop_type')->sum('count');
        $totalAnimals = $calamityReports->whereNotNull('animal_type')->sum('count');

        $commodityData = [
            'labels' => ['Crops', 'Animals'],
            'data' => [$totalCrops, $totalAnimals],
        ];
        /////////////////////////////////////////////
        
        $calamityReports = CalamityReport::selectRaw('barangay, COUNT(*) as report_count')
            ->whereBetween('date_reported', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('barangay', 'municipality')
            ->orderBy('report_count', 'DESC')
            ->get();
        
        $mostAffectedLocations = collect();
        $mostAffectedMunicipalityIdCount = 0;
        $completedAssistanceCount = 0;
        $totalFarmsCount = 0;
        
        $mostAffectedMunicipality = $calamityReports->first();
        
        if ($mostAffectedMunicipality) {
            $threshold = $mostAffectedMunicipality->report_count;
        
            $secondHighestCount = $calamityReports->skip(1)->first()->report_count ?? 0;
        
            $gap = $threshold - $secondHighestCount;
        
            if ($gap <= 2) {
                $filteredMunicipalities = $calamityReports->filter(function ($item) use ($threshold, $secondHighestCount) {
                    return $item->report_count >= $secondHighestCount;
                })->pluck('barangay');
            } else {
                $filteredMunicipalities = $calamityReports->where('report_count', $threshold)->pluck('barangay');
            }
        
            $mostAffectedLocations = Farms::whereIn('barangay', $filteredMunicipalities)->get();
        
            foreach ($filteredMunicipalities as $municipality) {
                $municipalityReportCount = CalamityReport::where('barangay', $municipality)
                    ->whereMonth('date_reported', Carbon::now()->month)
                    ->whereYear('date_reported', Carbon::now()->year)
                    ->count();
        
                $municipalityCompletedCount = CalamityReport::where('barangay', $municipality)
                    ->where('status', 'Completed')
                    ->whereMonth('date_reported', Carbon::now()->month)
                    ->whereYear('date_reported', Carbon::now()->year)
                    ->count();
        
                $municipalityFarmsCount = Farms::where('barangay', $municipality)->count();
        
                $mostAffectedMunicipalityIdCount += $municipalityReportCount;
                $completedAssistanceCount += $municipalityCompletedCount;
                $totalFarmsCount += $municipalityFarmsCount;
            }
        }
        
        $groupedMostAffectedLocations = $mostAffectedLocations->groupBy('barangay');
        /////////////////////////////////////////////////////
        $currentYear = Carbon::now()->year;
        $previousYear = Carbon::now()->subYear()->year; 
        $twoYearsAgo = Carbon::now()->subYears(2)->year;
        $currentMonth = Carbon::now()->month;
        
        $calamityStats = CalamityReport::selectRaw('
            MONTH(date_reported) as month, 
            YEAR(date_reported) as year,
            calamity_type, 
            barangay, 
            municipality, 
            COUNT(*) as count')
            ->where(function ($query) use ($currentYear, $previousYear) {
                
                $query->whereYear('date_reported', $currentYear)
                      
                      ->orWhere(function ($query) use ($previousYear) {
                          $query->whereYear('date_reported', $previousYear)
                                ->whereMonth('date_reported', Carbon::now()->addMonth()->month); 
                      });
            })
            ->groupBy('month', 'year', 'calamity_type', 'barangay', 'municipality')
            ->get();
        //////////////////////////////////////////////////////    
        $calamityStatsLine = CalamityReport::selectRaw('
                MONTH(date_reported) as month, 
                YEAR(date_reported) as year,
                calamity_type, 
                barangay, 
                municipality, 
                COUNT(*) as count
            ')
            ->whereYear('date_reported', '>=', $twoYearsAgo)
            ->where(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('date_reported', '<', $currentYear)
                      ->orWhere(function ($query) use ($currentYear, $currentMonth) {
                          $query->whereYear('date_reported', $currentYear)
                                ->whereMonth('date_reported', '<=', $currentMonth); 
                      });
            })
            ->groupBy('month', 'year', 'calamity_type', 'barangay', 'municipality')
            ->get();


        return view('admin/dashboard', compact(
            'unreadNotifications', 
            'farmCount', 
            'farmers', 
            'reports', 
            'completedReports', 
            'chartData', 
            'farms', 
            'defaultLocation', 
            'groupedLabels', 
            'groupedCrops', 
            'groupedAnimals',
            'commodityData',
            'mostAffectedMunicipality',
            'mostAffectedMunicipalityIdCount',
            'completedAssistanceCount',
            'totalFarmsCount',
            'mostAffectedLocations',
            'groupedMostAffectedLocations',
            'calamityStats',
            'calamityStatsLine'
        ));
    }

    public function farmers()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $accounts = Accounts::where('role', 'user')->get();
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;

        return view('admin/farmers', compact('accounts','unreadNotifications','farms','defaultLocation'));

    }

    public function announcement()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }

        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $announcement = Announcement::all();
        
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;

        return view('admin/announcement', [
            'announcement' => $announcement,
            'unreadNotifications' => $unreadNotifications,
            'farms' => $farms,
            'defaultLocation' => $defaultLocation
        ]);
    }

   
    public function add_announcement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $announcement = Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
    
        $users = Accounts::where('role', 'user')->get();
        $emailError = false;
    
        foreach ($users as $user) {
            AnnouncementUser::create([
                'user_id' => $user->id,
                'title' => $announcement->title,
                'content' => $announcement->content,
            ]);
    
            if (!empty($user->email)) {
                try {
                    Mail::to($user->email)->send(
                        new Announcements($announcement->title, $announcement->content)
                    );
                } catch (\Exception $e) {
                    $emailError = true;
                }
            }
        }
    
        if ($emailError) {
            return back()->with('alertify_error', 'Error occurred sending emails, try again after a day.');
        }
    
        return back()->with('success', 'Announcement added and emails sent successfully!');
    }


    public function delete_announcement($id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcement->delete();

        return back()->with('success', 'Deleted!');
    }

    public function add_farmer(Request $request)
    {
        $fullname = $request->input('firstname') . ' ' . $request->input('middlename') . ' ' . $request->input('lastname') . ' ' . $request->input('suffix');
        
        $status = $request->input('email') ? 'verified' : 'not_verified';

        $hashedPassword = Hash::make($request->input('password'));
        Accounts::create([
            'rsbsa' => $request->input('rsbsa'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'suffix' => $request->input('suffix'),
            'fullname' => $fullname,  // Add the fullname here
            'contact' => $request->input('contact'),
            'birthdate' => $request->input('birthdate'),
            'sex' => $request->input('sex'),
            'fourps' => $request->input('fourps'),
            'pwd' => $request->input('pwd'),
            'indigenous' => $request->input('indigenous'),
            'arb' => $request->input('arb'),
            'region' => $request->input('region'),
            'province' => $request->input('province'),
            'municipality' => $request->input('municipality'),
            'barangay' => $request->input('barangay'),
            'org_name' => $request->input('org_name'),
            'tot_male' => $request->input('tot_male'),
            'tot_female' => $request->input('tot_female'),
            'tribe_name' => $request->input('tribe_name'),
            'email' => $request->input('email'),
            'farmer_type' => $request->input('farmer_type'),
            'status' => $status, 
        ]);
        return back()->with('success', 'Farmer Added');
    }

    public function checkRsbsa(Request $request)
    {
        $rsbsa = $request->input('rsbsa');
        
        $exists = Accounts::where('rsbsa', $rsbsa)->exists();
        
        return response()->json([
            'exists' => $exists
        ]);
    }
    public function checkRsbsaEdit(Request $request)
    {
        $rsbsa = $request->query('rsbsa');
        $excludeId = $request->query('excludeId');

        $exists = Accounts::where('rsbsa', $rsbsa)
            ->where('id', '!=', $excludeId)
            ->exists();

        return response()->json(['exists' => $exists]);
    }


    public function farmers_farm()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;

        $farmers = Farms::with('farmImages')->get(); 
        return view('admin/farmer_farm', compact('farmers','unreadNotifications','farms','defaultLocation'));
    }


    public function edit_farmer(Request $request, $id)
    {
        $accounts = Accounts::findOrFail($id);

        $fullname = $request->input('firstname') . ' ' . $request->input('middlename') . ' ' . $request->input('lastname') . ' ' . $request->input('suffix');
        $status = $request->input('email') ? 'verified' : 'not_verified';

        $data = [
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'suffix' => $request->input('suffix'),
            'fullname' => $fullname,
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
            'rsbsa' => $request->input('rsbsa'),
            'fourps' => $request->input('fourps'),
            'indigenous' => $request->input('indigenous'),
            'tribe_name' => $request->input('tribe_name'),
            'pwd' => $request->input('pwd'),
            'sex' => $request->input('sex'),
            'arb' => $request->input('arb'),
            'region' => $request->input('region'),
            'province' => $request->input('province'),
            'municipality' => $request->input('municipality'),
            'barangay' => $request->input('barangay'),
            'org_name' => $request->input('org_name'),
            'tot_male' => $request->input('tot_male'),
            'tot_female' => $request->input('tot_female'),
            'farmer_type' => $request->input('farmer_type'),
            'status' => $status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $accounts->update($data);

        return redirect()->back()->with('success', 'Success.');
    }


    public function delete_farmer($id)
    {
        $accounts = Accounts::findOrFail($id);

        $accounts->delete();

        return back()->with('success', 'Deleted!');
    }

    public function calamity_reports()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
    
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();
    
        $calamities = CalamityReport::with('calamityImages')
                                     ->where('status', 'Pending')
                                     ->get();
    
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
    
        $startDate = now()->subDays(30);

        $municipalityReportCounts = CalamityReport::select('barangay', 'municipality', 'calamity_type', \DB::raw('count(*) as report_count'))
                                                   ->where('date_reported', '>=', $startDate) 
                                                   ->groupBy('barangay', 'municipality', 'calamity_type')
                                                   ->orderByDesc('report_count')
                                                   ->get();
        
        if ($municipalityReportCounts->isNotEmpty()) {
          
            $mostReported = $municipalityReportCounts->first();
            $threshold = 2; 
        
            $matchingReports = $municipalityReportCounts->filter(function ($report) use ($mostReported, $threshold) {
                return $report->calamity_type == $mostReported->calamity_type &&
                       abs($mostReported->report_count - $report->report_count) <= $threshold;
            });
        
            $nextHighest = $municipalityReportCounts->skip(1)->first(); 
        } else {
            $matchingReports = collect();
            $nextHighest = null;
        }

        return view('admin/calamity_report', compact('calamities', 'unreadNotifications', 'farms', 'defaultLocation', 'matchingReports','nextHighest'));
    }

    public function archive_farmer($id)
    {
        $archive = Accounts::findOrFail($id);

        $archive->active_not = 'Inactive';
        $archive->save();

        return redirect()->back()->with('success', 'Success!');
    }
    
    public function active_farmer($id)
    {
        $archive = Accounts::findOrFail($id);

        $archive->active_not = 'Active';
        $archive->save();

        return redirect()->back()->with('success', 'Success!');
    }


    public function updateToShorlisted($id)
    {
        $calamity = CalamityReport::findOrFail($id);

        $calamity->status = 'Shortlisted';
        $calamity->save();

        return redirect()->back()->with('success', 'Success!');
    }

    public function updateToDisregarded($id)
    {
        $calamity = CalamityReport::findOrFail($id);

        $calamity->status = 'Disregarded';
        $calamity->save();

        return redirect()->back()->with('success', 'Success!');
    }

    public function updateToPending($id)
    {
        $calamity = CalamityReport::findOrFail($id);

        $calamity->status = 'Pending';
        $calamity->save();

        return redirect()->back()->with('success', 'Success!');
    }


    public function multipleUpdateToShorlisted(Request $request)
    {
        $ids = $request->input('ids');
    
        if (is_array($ids) && count($ids) > 0) {
            CalamityReport::whereIn('id', $ids)->update(['status' => 'Shortlisted']);
            return redirect()->back()->with('success', 'Success!');
        }
    
        return redirect()->back()->with('error', 'No calamities were selected.');
    }

    public function disregarded_reports()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $calamities = CalamityReport::with('calamityImages')
                                    ->where('status', 'Disregarded')
                                    ->get(); 

        $assistanceTypes = Assistance::all();  
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
        
    
        return view('admin/disregarded_reports', compact('calamities', 'assistanceTypes','unreadNotifications','farms','defaultLocation'));
    }

    public function shortlisted_reports()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $calamities = CalamityReport::with('calamityImages')
                                    ->where('status', 'Shortlisted')
                                    ->get(); 

        $assistanceTypes = Assistance::all();
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
        
        $startDate = now()->subDays(30);

        $municipalityReportCounts = CalamityReport::select('barangay', 'municipality', 'calamity_type', \DB::raw('count(*) as report_count'))
                                                   ->where('date_reported', '>=', $startDate) 
                                                   ->groupBy('barangay', 'municipality', 'calamity_type')
                                                   ->orderByDesc('report_count')
                                                   ->get();
        
        if ($municipalityReportCounts->isNotEmpty()) {
          
            $mostReported = $municipalityReportCounts->first();
            $threshold = 2; 
        
            $matchingReports = $municipalityReportCounts->filter(function ($report) use ($mostReported, $threshold) {
                return $report->calamity_type == $mostReported->calamity_type &&
                       abs($mostReported->report_count - $report->report_count) <= $threshold;
            });
        
            $nextHighest = $municipalityReportCounts->skip(1)->first(); 
        } else {
            $matchingReports = collect();
            $nextHighest = null;
        }
        
    
        return view('admin/shortlisted_reports', compact('calamities', 'assistanceTypes','unreadNotifications','farms','defaultLocation','matchingReports','nextHighest'));
    }

    public function multipleUpdateToOngoing(Request $request)
    {
        $ids = $request->input('ids');
        $assistanceType = $request->input('assistance_type');
        $otherAssistances = $request->input('other_assistances');
    
        if (is_array($ids) && count($ids) > 0) {
            CalamityReport::whereIn('id', $ids)
                ->update([
                    'status' => 'Ongoing',
                    'assistance_type' => $assistanceType,
                    'other_assistances' => $otherAssistances ?: null, // Store null if empty
                ]);
    
            return redirect()->back()->with('success', 'Success!');
        }
    
        return redirect()->back()->with('error', 'No calamities were selected or assistance details not provided.');
    }


    

    public function updateToOngoing($id, Request $request)
    {
        $calamity = CalamityReport::findOrFail($id);
    
        $calamity->status = 'Ongoing';  
        if ($request->has('assistance_type')) {
            $calamity->assistance_type = $request->input('assistance_type');
        }
    
        if ($request->has('other_assistances')) {
            $calamity->other_assistances = $request->input('other_assistances');
        }
    
        $calamity->save();
    
        return redirect()->back()->with('success', 'Calamity report updated successfully!');
    }

    



    public function ongoing_reports()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $calamities = CalamityReport::with('calamityImages')
                                    ->where('status', 'Ongoing')
                                    ->get(); 
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
    
        return view('admin/ongoing_reports', compact('calamities','unreadNotifications','farms','defaultLocation'));
    }


    public function multipleUpdateToCompleted(Request $request)
    {
        $ids = $request->input('ids');
    
        if (is_array($ids) && count($ids) > 0) {
            CalamityReport::whereIn('id', $ids)->update([
                'status' => 'Completed',
                'date_provided' => Carbon::now('Asia/Manila'), 
            ]);
            return redirect()->back()->with('success', 'Success!');
        }
    
        return redirect()->back()->with('error', 'No calamities were selected.');
    }

    public function updateToCompleted($id, Request $request)
    {
        $calamity = CalamityReport::findOrFail($id);
    
        $validated = $request->validate([
            'remarks' => 'required|string|max:255', 
        ]);
    
        $calamity->status = 'Completed';
        $calamity->date_provided = Carbon::now('Asia/Manila');
        $calamity->remarks = $validated['remarks']; 
        $calamity->save();
    
        return redirect()->back()->with('success', 'Success!');
    }



    public function completed_reports()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $calamities = CalamityReport::with('calamityImages')
                                    ->where('status', 'Completed')
                                    ->get(); 
    
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
        
        return view('admin/completed_reports', compact('calamities','unreadNotifications','farms','defaultLocation'));
    }

    public function assistances()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $assistance = Assistance::all();

        return view('admin/assistances', compact('assistance','unreadNotifications'));

    }


    public function add_assistance(Request $request)
    {
        Assistance::create([
            'assistance_type' => $request->input('assistance_type'),
        ]);
    
        return redirect()->back()->with('success', 'Added!');
    }

    public function delete_assistance($id)
    {
        $assistance = Assistance::findOrFail($id);

        $assistance->delete();

        return back()->with('success', 'Deleted!');
    }
    
    public function fetchCalamityReports(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $reports = CalamityReport::whereBetween('date_reported', [
            Carbon::parse($request->from_date)->startOfDay(),
            Carbon::parse($request->to_date)->endOfDay()
        ])->get([
                'rsbsa', 'calamity_type', 'farmer_type', 'birthdate', 'region', 'province', 'municipality', 'barangay', 
                'org_name', 'tot_male', 'tot_female', 'sex', 'indigenous', 'tribe_name', 'pwd', 'arb', 'fourps', 'crop_type',
                'partially_damage', 'totally_damage', 'total_area', 'livestock_type', 'animal_type', 'age_class', 'no_heads', 
                'remarks', 'lastname', 'firstname', 'middlename', 'suffix', 'fullname', 'location', 'assistance_type', 
                'date_provided', 'status', 'email', 'date_reported'
            ]);

        return response()->json(['data' => $reports]);
    }

    public function updateStatus(Request $request)
    {

        $request->validate([
            'notification_id' => 'required|exists:calamity_report,id',
        ]);

        $notification = CalamityReport::findOrFail($request->notification_id);

        $notification->update(['notification_status' => 'viewed']);
        
        return response()->json(['success' => true]);
    }
    
    public function weather_alert(Request $request)
    {
        $existingAlert = WeatherAlert::where('farm_fk_id', $request->id)
                                    ->where('date_checked', Carbon::now('Asia/Manila')->toDateString()) // Only consider the date part
                                    ->first();

        if (!$existingAlert) {
            $alert = WeatherAlert::create([
                'farm_fk_id' => $request->id,
                'email' => $request->email,
                'commodity' => $request->commodity,
                'farm_type' => $request->farm_type,
                'livestock_type' => $request->livestock_type,
                'user_id' => $request->user_id,
                'temperature' => $request->temperature,
                'date_checked' => Carbon::now('Asia/Manila')
            ]);

            Mail::send('email.weather_alert', [
                'commodity' => $alert->commodity,
                'farm_type' => $alert->farm_type,
                'livestock_type' => $alert->livestock_type,
                'temperature' => $alert->temperature,
            ], function ($message) use ($alert) {
                $message->to($alert->email)
                        ->subject('Weather Alert Notification');
            });

            return response()->json(['success' => true, 'alert' => $alert]);
        }

        return response()->json(['success' => false, 'message' => 'Alert already exists for this farm and date.']);
    }

    
}
