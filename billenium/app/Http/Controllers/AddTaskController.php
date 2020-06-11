<?php

namespace App\Http\Controllers;

use App\TaskLogs;
use App\Task;
use App\User;
use App\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddTaskController extends Controller
{

    public function index() {

        return view('pages/dashboard/addTask', ["tasks" => Task::all(), "users" => User::all(), "projects" => Projects::where("status", "0")->get()]);
    }

    public function addTask(Request $request)
    {
        if(Auth::Check())
        {
            $userId = Auth::id();

            $validator = Validator::make($request->all(), [
                'project' => 'required',
                'name' => 'required',
                'description' => 'required',
                'user' => 'required'
            ]);

            // if fails redirects back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $task = new Task();

            $task->name = $request->name;
            $task->user_id = $request->user;
            $task->project_id = $request->project;
            $task->description = $request->description;
            $task->status = 0;

            $task->save();

            return redirect()->route('stats');

        }else
        {
            return redirect()->to('/');
        }
    }

}
