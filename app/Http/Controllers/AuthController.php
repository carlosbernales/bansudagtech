<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function landingpage()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        
    
        return view('landing_page');
    }

    public function login()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        
    
        return view('login');
    }
    

    // public function add_category(Request $request)
    // {
    //     if (!session()->has('admin_id') && !session()->has('it_id')) {
    //         return redirect('/');
    //     }

    //     $category = new Category();
    //     $category->cat_name = $request->input('cat_name');
    //     $category->save(); 

    //     return redirect()->back()->with('success', 'Category added successfully');
    // }

    // public function category_edit(Request $request, $id)
    // {
    //     if (!session()->has('admin_id') && !session()->has('it_id')) {
    //         return redirect('/');
    //     }

    //     $category = Category::findOrFail($id);

    //     $category->update([
    //         'cat_name' => $request->input('cat_name'),
    //     ]);

    //     return redirect()->back()->with('success', 'Category updated successfully.');
    // }

    // public function delete_category($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $category->delete();

    //     return redirect()->back()->with('success', 'Category deleted successfully.');
    // }
    //
}
