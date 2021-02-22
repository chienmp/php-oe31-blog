<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Category;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('profile', compact('user', 'categories'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();
        $filename = '';
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $user->image = $filename;
            $request->image->storeAs('public/avatar', $filename);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $filename,
        ]);
        toast(trans('updated'), trans('success'));

        return redirect()->route('home');
    }
}
