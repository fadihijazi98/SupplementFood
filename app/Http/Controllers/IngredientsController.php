<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Supplement;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{

    public function index()
    {

        if(!\request()->has('supplement_id'))
            abort(404);

        return Ingredient::all()->where("supplement_id", \request("supplement_id"))->values();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $this->validation($request);
        Ingredient::create($validated);
        return "تم الاضافة بنجاح";
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return "تم الحذف";
    }

    public function validation(Request $request)
    {
        return $request
            ->validate(
                [
                    'supplement_id' => 'required|integer',
                    'daily_ratio' => 'required|integer',
                    'amount_for_each_dose' => 'required'
                ]
            );
    }
}
