<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\Equipament;

use App\Http\Requests\EquipamentPostRequest;


class EquipamentController extends Controller
{
    //

    public function list()
    {
        return Answer::json(Equipament::all(), 'Equipament listed successfully');
    }


    public function save(EquipamentPostRequest $request)
    {
        return Answer::json(Equipament::create($request->all()), 'Equipament saved successfully');
    }
    public  function update(Request $request, $id)
    {
        $equipament = Equipament::findOrFail($id);
        $data = array_merge($request->all());
        $equipament->update($data);

        return Answer::json($data, 'Equipament updated successfully');
    }

    public function destroy($id)
    {
        Equipament::findOrFail($id)->delete();
        return Answer::json([], 'Equipament deleted successfully');
    }    
}
