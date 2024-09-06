<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\TypeInstallation;

use App\Http\Requests\TypeInstallationPostRequest;


class TypeInstallationController extends Controller
{
    //

    
    public function list()
    {
        return Answer::json(TypeInstallation::all(), 'Type Installation listed successfully');
    }


    public function save(TypeInstallationPostRequest $request)
    {
        return Answer::json(TypeInstallation::create($request->all()), 'Type Installation  saved successfully');
    }
    public  function update(Request $request, $id)
    {
        $type = TypeInstallation::findOrFail($id);
        $data = array_merge($request->all());

        $type->update($data);

        return Answer::json($data, 'Type Installation listed successfully');
    }

    public function destroy($id)
    {
        TypeInstallation::findOrFail($id)->delete();
        return Answer::json([], 'Type Installation deleted successfully');
    }


}
