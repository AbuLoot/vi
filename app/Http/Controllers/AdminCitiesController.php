<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\City;
use Validator;

class AdminCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:60|unique:cities',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city = new City;

        if ($request->sort_id > 0) $city->sort_id = $request->sort_id;
        else $city->sort_id = $city->count() + 1;
        $city->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        $city->title = $request->title;
        if ($request->status == 'on') $city->status = 1;
        else $city->status = 0;
        $city->save();

        return redirect('/admin/cities')->with('status', 'Город добавлен!');
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
     * @return Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        if ($request->sort_id > 0) $city->sort_id = $request->sort_id;
        else $city->sort_id = $city->count() + 1;
        $city->slug = ( ! empty($request->slug)) ? $request->slug : str_slug($request->title);
        $city->title = $request->title;
        if ($request->status == 'on') $city->status = 1;
        else $city->status = 0;
        $city->save();

        return redirect('/admin/cities')->with('status', 'Город обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        City::destroy($id);

        return redirect('/admin/cities')->with('status', 'Город удален!');
    }
}
