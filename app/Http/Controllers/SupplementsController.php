<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementsController extends Controller
{

    public function index()
    {
        return view('home', ['supplements' => Auth::user()->supplements()->get()]);
    }

    public function create()
    {
        return view('supplement.create');
    }

    public function store(Request $request)
    {
        $validated = $this->supplementValidation($request);
        $supplement = \auth()->user()->supplements()->create($validated);
        return redirect('/supplement/'.$supplement->id)->with("message", "تم اضافة المكمل الغذائي بنجاح");
    }

    public function show(Supplement $supplement)
    {
        return view('/supplement.show', compact('supplement'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Supplement $supplement)
    {
        $validated = $this->supplementValidation($request);
        $supplement->update($validated);
        return redirect('/supplement/'.$supplement->id)->with('message', 'تم التحديث بنجاح');
    }

    public function destroy(Supplement $supplement)
    {
        $supplement->delete();
        return back();
    }

    public function supplementValidation(Request  $request) {
        return $request->validate(['name'=>'required', 'dose_size'=>'required', 'dose_for_each_package' => 'required|integer']);
    }

}
