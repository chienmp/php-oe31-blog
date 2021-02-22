<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile', compact('user'));
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

        return redirect()->route('dashboard');
    }
}
