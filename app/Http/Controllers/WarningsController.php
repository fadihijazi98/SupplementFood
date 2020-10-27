<?php

namespace App\Http\Controllers;

use App\Models\warning;
use Illuminate\Http\Request;

class WarningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!request()->has('supplement_id'))
            abort(404);

        return warning::all()->where('supplement_id', request('supplement_id'))->values();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $this->validation($request);
        warning::create($validated);
        return "تمت اضافة التحذير بنجاح";
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\warning $warning
     * @return \Illuminate\Http\Response
     */
    public function show(warning $warning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\warning $warning
     * @return \Illuminate\Http\Response
     */
    public function edit(warning $warning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\warning $warning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, warning $warning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\warning $warning
     * @return \Illuminate\Http\Response
     */
    public function destroy(warning $warning)
    {
        $warning->delete();
        return  "تم حذف التحذر بنجاح";
    }

    public function validation(Request $request)
    {
        return $request->validate(['supplement_id' => 'required', 'content' => 'required']);
    }
}
