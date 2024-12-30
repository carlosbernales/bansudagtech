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

class AdminController extends Controller
{

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }

        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();
        $farmCount = Farms::count();
        $farmers = Accounts::count();
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

        $farmLocations = Farms::pluck('location');
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

        return view('admin/dashboard', compact(
            'unreadNotifications', 
            'farmCount', 
            'farmers', 
            'reports', 
            'completedReports', 
            'chartData', 
            'farmLocations', 
            'defaultLocation', 
            'groupedLabels', 
            'groupedCrops', 
            'groupedAnimals',
            'commodityData'
        ));
    }



    public function farmers()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }
        $accounts = Accounts::where('role', 'user')->get();
        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        return view('admin/farmers', compact('accounts','unreadNotifications'));

    }

    public function announcement()
    {
        if (!session()->has('admin_id')) {
            return redirect('/');
        }

        $unreadNotifications = CalamityReport::where('notification_status', 'unread')->get();

        $announcement = Announcement::all();

        return view('admin/announcement', [
            'announcement' => $announcement,
            'unreadNotifications' => $unreadNotifications
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

        foreach ($users as $user) {
            AnnouncementUser::create([
                'user_id' => $user->id,
                'title' => $announcement->title,
                'content' => $announcement->content,
            ]);

            Mail::send('email.announcement_mail', [
                'title' => $announcement->title,
                'content' => $announcement->content,
            ], function ($message) use ($user) {
                $message->to($user->email)->subject('Announcement');
            });
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

        $farmers = Farms::with('farmImages')->get(); 
        return view('admin/farmer_farm', compact('farmers','unreadNotifications'));
    }


    public function edit_farmer(Request $request, $id)
    {
        $accounts = Accounts::findOrFail($id);

        $fullname = $request->input('firstname') . ' ' . $request->input('middlename') . ' ' . $request->input('lastname') . ' ' . $request->input('suffix');

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
    
        return view('admin/calamity_report', compact('calamities','unreadNotifications'));
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
        
    
        return view('admin/disregarded_reports', compact('calamities', 'assistanceTypes','unreadNotifications'));
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
        
    
        return view('admin/shortlisted_reports', compact('calamities', 'assistanceTypes','unreadNotifications'));
    }

    public function multipleUpdateToOngoing(Request $request)
    {
        $ids = $request->input('ids');
        $assistanceType = $request->input('assistance_type');  
    
        if (is_array($ids) && count($ids) > 0 && $assistanceType) {
            CalamityReport::whereIn('id', $ids)
                          ->update([
                              'status' => 'Ongoing',
                              'assistance_type' => $assistanceType  
                          ]);
    
            return redirect()->back()->with('success', 'Success!');
        }
    
        return redirect()->back()->with('error', 'No calamities were selected or assistance type not provided.');
    }
    

    public function updateToOngoing($id, Request $request)
    {
        $calamity = CalamityReport::findOrFail($id);
    
        $calamity->status = 'Ongoing';  
        if ($request->has('assistance_type')) {
            $calamity->assistance_type = $request->input('assistance_type');
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
    
        return view('admin/ongoing_reports', compact('calamities','unreadNotifications'));
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

    public function updateToCompleted($id)
    {
        $calamity = CalamityReport::findOrFail($id);

        $calamity->status = 'Completed';
        $calamity->date_provided = Carbon::now('Asia/Manila'); 
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
    
        return view('admin/completed_reports', compact('calamities','unreadNotifications'));
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

    
}
