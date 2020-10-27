<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $supplement_id = $request->supplement_id;

        $baseFromJavascript = $request->dataUrl;

        $base_to_php = explode(',', $baseFromJavascript);

        $data = base64_decode($base_to_php[1]);

        $filepath = "uploads/images/supplements_" . $supplement_id . ".jpg";

        file_put_contents($filepath, $data);

        if ($image = Image::where("supplement_id", $supplement_id)->get()->first())
            $image->update();
        else
            Image::create(['supplement_id' => $supplement_id, 'path' => $filepath]);

        return "تم حفظ الصورة بنجاح";

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

    public function destroy($id)
    {
        //
    }
}
