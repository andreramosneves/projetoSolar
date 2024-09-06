<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\Uf;

use App\Http\Requests\UfPostRequest;

class UfController extends Controller
{
    //
    public function list()
    {
        return Answer::json(Uf::all(), 'Uf listed successfully');
    }


    public function save(UfPostRequest $request)
    {
        return Answer::json(Uf::create($request->all()), 'Uf saved successfully');
    }
    public  function update(Request $request, $id)
    {
        $uf = Uf::findOrFail($id);
        $data = array_merge($request->all());
        $uf->update($data);
        return Answer::json($data, 'Uf updated successfully');
    }

    public function destroy($id)
    {
        Uf::findOrFail($id)->delete();
        return Answer::json([], 'Uf deleted successfully');
    }

}
