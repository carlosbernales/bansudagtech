<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Farms;


class AdminController extends Controller
{

    public function landingpage()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        return view('landing_page');
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }


    public function farmers()
    {
        $accounts = Accounts::all();

        return view('admin/farmers', ['accounts' => $accounts]);
    }

    public function announcement()
    {
        $announcement = Announcement::all();

        return view('admin/announcement', ['announcement' => $announcement]);
    }

    public function add_announcement(Request $request)
    {
        $announcement = Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $userIds = Accounts::all()->pluck('id');

        foreach ($userIds as $userId) {
            AnnouncementUser::create([
                'user_id' => $userId,
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);
        }

        return back()->with('success', 'Announcement added successfully!');
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
        $farmers = Farms::with('farmImages')->get(); 
        return view('admin/farmer_farm', compact('farmers'));
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

}
