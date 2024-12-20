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


class HomeController extends Controller
{

    public function home()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        
    
        return view('user/home');
    }

    public function farms()
    {
        // Eager load the farmImages relationship to prevent null errors
        $farmers = Farms::with('farmImages')->get(); // Use `farmImages` (note plural) for multiple images
        return view('user.farms', compact('farmers'));
    }
    
    

    public function test()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        
    
        return view('user/test');
    }

    public function add_farms(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'commodity' => 'required|string',
            'farm_type' => 'required|string',
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

        $farm = Farms::create([
            'location' => $request->input('location'),
            'commodity' => $request->input('commodity'),
            'farm_type' => $request->input('farm_type'),
            'user_id' => $userId, 
            'fullname' => $userFullname, 
            'rsbsa' => $rsbsa,
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




    
}
