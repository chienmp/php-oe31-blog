<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cates = Category::all();

        return view('admin.category.index', compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $filename = config('image.default');
        $cate = new Category;
        $cate->name = $request->name;
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
        }
        $cate->image = $filename;
        $request->image->storeAs('public/image', $filename);
        $cate->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Category::findOrFail($id);

        return view('admin.category.edit', compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $cate = Category::findOrFail($id);
        $cate->name = $request->name;
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $cate->image = $filename;
            $request->image->storeAs('public/image', $filename);
        }
        $cate->save();
        Alert::success(trans('success'), trans('updated'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id);
        Category::destroy($id);
        Alert::success(trans('success'), trans('deleted'));

        return back();
    }
}
