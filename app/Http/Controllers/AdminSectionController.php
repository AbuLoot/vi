<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section;
use App\Http\Requests\SectionRequest;
use Storage;

class AdminSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $section = Section::orderBy('service_id')->get();

        return view('admin.section.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SectionRequest $request)
    {
        $section = new Section;

        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img/section/', $image);
        }
        else
        {
            $image = 'no-image';
        }

        $count = $section->count();

        if ($request->sort_id > 0)
            $section->sort_id = $request->sort_id;
        else
            $section->sort_id = ++$count;
        $section->service_id = $request->service_id;
        $section->title = $request->title;
        $section->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        $section->image = $image;
        $section->title_description = $request->title_description;
        $section->meta_description = $request->meta_description;
        $section->text = $request->text;
        if ($request->status == 'on')
            $section->status = 1;
        else
            $section->status = 0;
        $section->save();

        return redirect('/admin/section')->with('status', 'Рубрика добавлена!');
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
        $item = Section::findOrFail($id);

        return view('admin.section.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SectionRequest $request, $id)
    {
        $section = Section::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img/section/', $image);

            if (Storage::exists('img/section/'.$section->image))
            {
                Storage::delete('img/section/'.$section->image);
            }
        }

        $count = $section->count();

        if ($request->sort_id > 0)
            $section->sort_id = $request->sort_id;
        else
            $section->sort_id = ++$count;
        $section->service_id = $request->service_id;
        $section->title = $request->title;
        $section->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        if (isset($image))
            $section->image = $image;
        $section->title_description = $request->title_description;
        $section->meta_description = $request->meta_description;
        $section->text = $request->text;
        if ($request->status == 'on')
            $section->status = 1;
        else
            $section->status = 0;
        $section->save();

        return redirect('/admin/section')->with('status', 'Рубрика обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);

        if (Storage::exists('img/section/'.$section->image))
        {
            Storage::delete('img/section/'.$section->image);
        }

        $section->delete();

        return redirect('/admin/section')->with('status', 'Рубрика удалена!');
    }
}