<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subtask;

class SubtaskController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        $subtask = Subtask::create([
            'task' => $data['task'], 
            'name' => $data['name'], 
            'description' => $data['description'],
            'done' => $data['done']
        ]);

        if($subtask){
            return 'ok';
        }else{
            return 'error';
        }
        
    }

    public function update(Request $request, $id)
    {
        $subtask = Subtask::findOrFail($id);

        $data = $request->all();


        if(isset($data['done']) && isset($data['name']) && isset($data['description'])){
            $subtask->update([
                'name' => $data['name'], 
                'description' => $data['description'],
                'done' => $data['done']
            ]);
        }else{
            $res = 0;
            if($subtask->done == 0){
                $res = 1;
            }else{
                $res = 0;
            }

            $subtask->update([
                'done' => $res
            ]);
        }

        if($subtask){
            return 'ok';
        }else{
            return 'error';
        }
    }

    public function destroy($id)
    {
        $sub = Subtask::findOrFail($id);

        $sub->delete();

        return 'ok';
    }
}
