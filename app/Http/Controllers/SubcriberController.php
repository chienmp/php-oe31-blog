<?php

namespace App\Http\Controllers;

use App\Models\Subcriber;

class SubcriberController extends Controller
{
    public function store(SubcribeRequest $request)
    {
        Subcriber::create([
            'email' => $request->email,
        ]);
        toast(trans('subcribe_submit'), trans('success'));

        return redirect()->back();
    }
}
