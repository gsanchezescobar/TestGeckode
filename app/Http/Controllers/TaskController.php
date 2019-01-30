<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Subtask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::with('subtask')->get()->toarray();

        return $task;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $task = Task::create([
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
        $task = Task::findOrFail($id);

        $data = $request->all();

        $task->update([
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
        $loteria = Task::findOrFail($id);

        $loteria->delete();

        return 'se elimino correctamente';
    }

    
}
