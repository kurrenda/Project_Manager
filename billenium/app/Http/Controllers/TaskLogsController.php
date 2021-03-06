<?php

namespace App\Http\Controllers;

use App\TaskLogs;
use App\Task;
use App\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskLogsController extends Controller
{

    public function index() {

        return view('pages/dashboard/index', ["tasks" => Task::where('user_id',Auth::id())->where('status', "0")->with('project')->get()]);
    }

    public function registerTime(Request $request)
    {
        if(Auth::Check())
        {
            $userId = Auth::id();

            $validator = Validator::make($request->all(), [
                'task' => 'required',
                'status' => 'required',
                'time' => 'required',
            ]);

            // if fails redirects back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $task = new TaskLogs();

            $task->hours_worked = $request->time;
            $task->user_id = $userId;
            $task->task_id = $request->task;
            $task->comment = $request->comment;

            $task->save();

            $globalTask = Task::find($request->task);
            $globalTask->status = $request->status;
            $globalTask->save();


            return redirect()->route('stats');

        }else
        {
            return redirect()->to('/');
        }
    }

}
