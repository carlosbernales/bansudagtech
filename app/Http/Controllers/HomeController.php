<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Farms;
use App\Models\FarmsImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\CalamityReport;
use App\Models\CalamityImages;
use Carbon\Carbon;


class HomeController extends Controller
{

    public function home()
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $userId = session('user_id'); 

        $notifications = AnnouncementUser::where('user_id', $userId)
            ->where('status', 'unread')
            ->get();

        $notificationCount = $notifications->count();

        $farms = Farms::where('user_id', $userId)->get(); 
        $tot_reports = CalamityReport::where('user_id', $userId)->get(); 
        $completed_reports = CalamityReport::where('user_id', $userId)
                         ->where('status', 'Completed')
                         ->get();


        $farmCount = $farms->count();
        $totReports = $tot_reports->count();
        $completedReports = $completed_reports->count();


        $account = Accounts::find($userId);

        $locations = $farms->map(function ($farm) {
            return [
                'address' => $farm->location, 
            ];
        });

        return view('user.home', compact('notificationCount', 'notifications', 'locations', 'account', 'farmCount','totReports','completedReports'));
    }   


    public function farms()
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }
        
        $userId = session('user_id'); 
    
        $notifications = AnnouncementUser::where('user_id', $userId)
                                        ->where('status', 'unread')
                                        ->get();
    
        $farmers = Farms::with('farmImages')
                        ->where('user_id', $userId) 
                        ->get(); 
        
        $notificationCount = $notifications->count();
        $account = Accounts::find($userId);
    
        $municipalities = config('municipalities');
    
        return view('user.farms', compact('farmers', 'notificationCount', 'notifications', 'account', 'municipalities'));
    }


    public function add_farms(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'commodity' => 'required|string',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user = Accounts::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userFullname = $user->fullname;
        $rsbsa = $user->rsbsa;
        $email = $user->email;

        $farm = Farms::create([
            'location' => $request->input('location'),
            'commodity' => $request->input('commodity'),
            'farm_type' => $request->input('farm_type'),
            'forms_farm' => $request->input('forms_farm'),
            'livestock_type' => $request->input('livestock_type'),
            'user_id' => $userId, 
            'fullname' => $userFullname, 
            'rsbsa' => $rsbsa,
            'email' => $email,
            'region' => $request->input('region'),
            'municipality' => $request->input('municipality'),
            'province' => $request->input('province'),
            'barangay' => $request->input('barangay'),
            'farm_area' => $request->input('farm_area'),
            'area_planted' => $request->input('area_planted'),
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'suffix' => $user->suffix,
            'sex' => $user->sex,
            'contact' => $user->contact,
            'fourps' => $user->fourps,
            'indigenous' => $user->indigenous,
            'pwd' => $user->pwd,
            'fourps' => $user->fourps,
            'birthdate' => $user->birthdate,
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = uniqid('farm_', true) . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('farms_images'), $imageName);

                FarmsImages::create([
                    'farms_fk_id' => $farm->id,  
                    'image' => $imageName,        
                ]);
            }
        }

        return redirect()->back()->with('success', 'Success!');
    }


    public function delete_farm($id)
    {
        $farmer = Farms::findOrFail($id); 

        $farmImages = FarmsImages::where('farms_fk_id', $id)->get();
        foreach ($farmImages as $image) {
            $imagePath = public_path('farms_images/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        FarmsImages::where('farms_fk_id', $id)->delete();

        $farmer->delete();

        return redirect()->back()->with('success', 'Deleted!');
    }


    public function calamity_report()
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $userId = session('user_id'); 
        
        $notifications = AnnouncementUser::where('user_id', $userId)
        ->where('status', 'unread')
        ->get();

        $farms = Farms::where('user_id', $userId)
                    ->get(['id', 'location', 'forms_farm', 'farm_type', 'livestock_type']);

        $calamities = CalamityReport::with('calamityImages')
                ->where('user_id', $userId)
                ->whereIn('status', ['Pending', 'Disregarded','Shortlisted'])
                ->get();
                
        $notificationCount = $notifications->count();
        $account = Accounts::find($userId);


        return view('user/calamityReport', compact('farms', 'calamities','notificationCount', 'notifications','account'));

    }

    public function ongoingreports()
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $userId = session('user_id'); 
        
        $notifications = AnnouncementUser::where('user_id', $userId)
        ->where('status', 'unread')
        ->get();

        $farms = Farms::where('user_id', $userId)
                    ->get(['id', 'location', 'forms_farm', 'farm_type', 'livestock_type']);

        $calamities = CalamityReport::with('calamityImages')
                ->where('user_id', $userId)
                ->whereIn('status', ['Ongoing'])
                ->get();
                
        $notificationCount = $notifications->count();
        $account = Accounts::find($userId);


        return view('user/ongoingreports', compact('farms', 'calamities','notificationCount', 'notifications','account'));

    }

    public function completedreports()
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $userId = session('user_id'); 
        
        $notifications = AnnouncementUser::where('user_id', $userId)
        ->where('status', 'unread')
        ->get();

        $farms = Farms::where('user_id', $userId)
                    ->get(['id', 'location', 'forms_farm', 'farm_type', 'livestock_type']);

        $calamities = CalamityReport::with('calamityImages')
                ->where('user_id', $userId)
                ->whereIn('status', ['Completed'])
                ->get();
                
        $notificationCount = $notifications->count();
        $account = Accounts::find($userId);


        return view('user/completedreports', compact('farms', 'calamities','notificationCount', 'notifications','account'));
    }



    public function submit_calamity_report(Request $request)
    {
        $userId = session('user_id');

        $account = Accounts::find($userId);

        if (!$account) {
            return redirect()->back()->with('error', 'User not found');
        }

        // $dateReported = Carbon::now('Asia/Manila');

        $calamityReport = CalamityReport::create([
            'calamity_type' => $request->input('calamity_type'),
            'location' => $request->input('location'),
            'crop_type' => $request->input('crop_type'),
            'partially_damage' => $request->input('partially_damage'),
            'totally_damage' => $request->input('totally_damage'),
            'total_area' => $request->input('total_area'),
            'livestock_type' => $request->input('livestock_type'),
            'animal_type' => $request->input('animal_type'),
            'age_class' => $request->input('age_class'),
            'no_heads' => $request->input('no_heads'),
            'firstname' => $account->firstname, 
            'middlename' => $account->middlename, 
            'lastname' => $account->lastname, 
            'suffix' => $account->suffix, 
            'fullname' => $account->fullname, 
            'contact' => $account->contact, 
            'email' => $account->email, 
            'birthdate' => $account->birthdate, 
            'rsbsa' => $account->rsbsa, 
            'fourps' => $account->fourps, 
            'indigenous' => $account->indigenous, 
            'tribe_name' => $account->tribe_name, 
            'pwd' => $account->pwd, 
            'sex' => $account->sex, 
            'arb' => $account->arb, 
            'region' => $account->region, 
            'province' => $account->province, 
            'municipality' => $account->municipality, 
            'barangay' => $account->barangay, 
            'org_name' => $account->org_name, 
            'tot_male' => $account->tot_male, 
            'tot_female' => $account->tot_female, 
            'farmer_type' => $account->farmer_type, 
            'user_id' => $userId, 

            // 'date_reported' => $dateReported, 
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = uniqid('calamity_') . '.' . $image->getClientOriginalExtension();
                
                $image->move(public_path('calamity_images'), $imageName);
    
                CalamityImages::create([
                    'cal_fk_id' => $calamityReport->id, 
                    'image' => $imageName, 
                ]);
            }
        }
        return back()->with('success', 'Report Submitted!');
    }

    public function delete_report($id)
    {
        $calReport = CalamityReport::findOrFail($id); 

        $calReportImage = CalamityImages::where('cal_fk_id', $id)->get();
        foreach ($calReportImage as $image) {
            $imagePath = public_path('calamity_images/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        CalamityImages::where('cal_fk_id', $id)->delete();

        $calReport->delete();

        return redirect()->back()->with('success', 'Deleted!');
    }

    public function updateNotifStatus(Request $request)
    {
        $id = $request->input('id');

        $notification = AnnouncementUser::find($id);

        if ($notification) {
            $notification->status = 'viewed';
            $notification->save();

            return response()->json(['success' => true, 'message' => 'Notification updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }

    public function updateMyProfile(Request $request)
    {
        $account = Accounts::findOrFail($request->input('id'));

        $account->update([
            'farmer_type' => $request->input('farmer_type'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'suffix' => $request->input('suffix'),
            'contact' => $request->input('contact'),
            'birthdate' => $request->input('birthdate'),
            'sex' => $request->input('sex'),
            'fourps' => $request->input('fourps'),
            'pwd' => $request->input('pwd'),
            'arb' => $request->input('arb'),
            'indigenous' => $request->input('indigenous'),
            'tribe_name' => $request->input('tribe_name'),
            'region' => $request->input('region'),
            'province' => $request->input('province'),
            'municipality' => $request->input('municipality'),
            'barangay' => $request->input('barangay'),
            'org_name' => $request->input('org_name'),
            'tot_male' => $request->input('tot_male'),
            'tot_female' => $request->input('tot_female'),
            'email' => $request->input('email'),
        ]);

        if ($request->filled('password')) {
            $account->password = bcrypt($request->input('password'));
            $account->save();
        }

        return redirect()->back()->with('success', 'Account updated successfully!');
    }





    

    



    
}
