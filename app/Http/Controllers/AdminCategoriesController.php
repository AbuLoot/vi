<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Storage;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::orderBy('section_id')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;

        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img/categories/', $image);
        }
        else
        {
            $image = 'no-image';
        }

        $count = $category->count();

        if ($request->sort_id > 0)
            $category->sort_id = $request->sort_id;
        else
            $category->sort_id = ++$count;
        $category->service_id = $request->service_id;
        $category->title = $request->title;
        $category->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        $category->image = $image;
        $category->title_description = $request->title_description;
        $category->meta_description = $request->meta_description;
        $category->text = $request->text;
        if ($request->status == 'on')
            $category->status = 1;
        else
            $category->status = 0;
        $category->save();

        return redirect('/admin/categories')->with('status', 'Категория добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $section = Section::orderBy('sort_id')->get();

        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('section', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img/categories/', $image);

            if ($category->image != '')
            {
                if (Storage::exists('img/categories/'.$category->image))
                {
                    Storage::delete('img/categories/'.$category->image);
                }
            }
        }

        $count = $category->count();

        if ($request->sort_id > 0)
            $category->sort_id = $request->sort_id;
        else
            $category->sort_id = ++$count;
        $category->section_id = $request->section_id;
        $category->title = $request->title;
        $category->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        if (isset($image))
            $category->image = $image;
        $category->title_description = $request->title_description;
        $category->meta_description = $request->meta_description;
        $category->text = $request->text;
        if ($request->status == 'on')
            $category->status = 1;
        else
            $category->status = 0;
        $category->save();

        return redirect('/admin/categories')->with('status', 'Рубрика обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (Storage::exists('img/categories/'.$category->image))
        {
            Storage::delete('img/categories/'.$category->image);
        }

        $category->delete();

        return redirect('/admin/categories')->with('status', 'Рубрика удалена!');
    }
}
