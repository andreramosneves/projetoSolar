<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Answer;
use App\Models\User;

use App\Http\Requests\ClientPostRequest;

class ClientController extends Controller
{
    //
    public function list()
    {
        return Answer::json(User::all(), 'Client listed successfully');
    }


    public function save(ClientPostRequest $request)
    {
        
        return Answer::json(User::create($request->all()), 'Client saved successfully');
    }
    public  function update(ClientPostRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = array_merge($request->all());
        $u = $user->update($data);
        return Answer::json($u, 'Client updated successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return Answer::json([], 'Client deleted successfully');
    }

}
