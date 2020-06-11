<?php

namespace App\Http\Controllers;

use App\TaskLogs;
use App\Task;
use App\User;
use App\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AcceptController extends Controller
{

    public function index() {

        return view('pages/dashboard/accept', ["tasks" => TaskLogs::where('accepted', 0)->with('user', 'task')->with('task.project')->get()]);
    }

    public function accept(Request $request)
    {
        if(Auth::Check())
        {
            $taskReg = TaskLogs::find($request->id);

            $taskReg->accepted = 1;
            $taskReg->save();

            $hours = Task::find($request->task_id)->project()->first();
            $time = $hours->hours;
            $hours->hours = $time + $request->time;
            $hours->save();

            return redirect()->route('accept');

        }else
        {
            return redirect()->to('/');
        }
    }

    public function delete(Request $request)
    {
        if(Auth::Check())
        {
            $taskReg = TaskLogs::find($request->id);
            $taskReg->delete();

            return redirect()->route('accept');

        }else
        {
            return redirect()->to('/');
        }
    }

}
