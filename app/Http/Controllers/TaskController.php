<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Subtask;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::where('done',0)->with('subtask')->get()->toarray();
// select('name', 'description','done',"date_format('created_at', '%d/%m/%Y')")->
        return $task;
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

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
            return 'ok';
        }else{
            return 'error';
        }
        
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $data = $request->all();

        if($data['done'] == 1){
            $this->updatesubtask($id);
        }

        if(isset($data['name']) && isset($data['description'])){
            $task->update([
                'name' => $data['name'], 
                'description' => $data['description'],
                'done' => $data['done']
            ]);
        }else{
            $task->update([
                'done' => $data['done']
            ]);
        }
        

        if($task){
            return 'ok';
        }else{
            return 'error';
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
        $this->destroysubtask($id);

        $task = Task::findOrFail($id);

        $task->delete();

        return 'ok';
    }

    function destroysubtask($id)
    {
        $sub = DB::delete('DELETE FROM subtask WHERE task=?', [$id]);
    }

    function updatesubtask($id)
    {
        $subs = Subtask::where('task',$id)->get();
        if(count($subs)>0){
            $sub = DB::update('UPDATE subtask SET done=1 WHERE task=?', [$id]);
        }
    }

    
}
