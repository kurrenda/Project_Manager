<?php

namespace App\Http\Controllers;

use App\TaskLogs;
use App\Task;
use App\User;
use App\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddProjectController extends Controller
{

    public function index() {

        return view('pages/dashboard/addProject', ["tasks" => Task::all(), "users" => User::all()]);
    }

    public function addProject(Request $request)
    {
        if(Auth::Check())
        {
            $userId = Auth::id();

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
            ]);

            // if fails redirects back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $task = new Projects();

            $task->name = $request->name;
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
