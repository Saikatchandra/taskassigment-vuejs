<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $taskList = Task::with('user')->get();
        // dd()     
        return response()->json(['taskList' => $taskList],200);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->formValidation($request);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->save();

        return response()->json(['success' => true]);

    }

    public function edit($id){
        $task = Task::find($id);
        return response()->json(['taskById' => $task]);
    }

    public function update(Request $request, Task $task, $id){
        // dd($request->all());
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function delete($id){
        $task = Task::find($id);
        $task->delete();
        if(isset($task)){
                return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=> true]);
        }
    }

    public function formValidation(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable',
        ]);
    }

    public function assignTask($id){

        $task = Task::find($id);
        $users = User::all();
        return response()->json(['task' => $task, 'users' => $users ],200);

    }

    public function assignTaskToUser(Request $request, Task $task, $id){
        
        $task = Task::find($id);
        $user = User::where('id',$request->user)->first();
        $user->task_id = $task->id;
        $user->save();
         
        try {
            $data = array('user' => $user, 'body' => 'assigned a task', 'task'=> $task);
            \Mail::send('emails.mail', $data, function ($message) use ($user, $task){
    
                $message->to($user->email)
                    ->subject('Task Assigned');
            });
          } catch (Exception $e) {
            return $e->getMessage();
          }

        return response()->json(['success' => true]);
    }
}
