<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subtask;

class SubtaskController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        $task = Subtask::create([
            'task' => $data['task'], 
            'name' => $data['name'], 
            'description' => $data['description'],
            'done' => $data['done']
        ]);

        if($task){
            return 'se creo correctamente';
        }else{
            return 'no se creo el registro';
        }
        
    }

    public function update(Request $request, $id)
    {
        $task = Subtask::findOrFail($id);

        $data = $request->all();

        $task->update([
            'task' => $data['task'], 
            'name' => $data['name'], 
            'description' => $data['description'],
            'done' => $data['done']
        ]);

        if($task){
            return 'se actualizo correctamente';
        }else{
            return 'no se actualizo el registro';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loteria = Subtask::findOrFail($id);

        $loteria->delete();

        return 'se elimino correctamente';
    }
}
