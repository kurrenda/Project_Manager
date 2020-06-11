<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\TaskLogs;
use App\TimerRegister;
use App\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class TimerRegisterController extends Controller
{
    public function index() {

/*        $query = TaskLogs::where('user_id', Auth::id())->with('task')->groupBy('task_id')
            ->selectRaw('sum(hours_worked) as sum, task_id')
            ->pluck('sum','task_id');

        $stats = DB::table('task_logs')
            ->where('task_logs.user_id',Auth::id())
            ->join('tasks', 'task_logs.task_id', '=', 'tasks.id')
            ->groupBy('task_id','tasks.name', 'tasks.status')
            ->selectRaw('sum(hours_worked) as sum, tasks.name as name, tasks.status as status')
            ->get();

        $statsA = DB::table('task_logs')
            ->join('tasks', 'task_logs.task_id', '=', 'tasks.id')
            ->join('users','task_logs.user_id','=', 'users.id')
            ->groupBy('task_id','tasks.name', 'tasks.status', 'users.name')
            ->selectRaw('sum(hours_worked) as sum, tasks.name as name, tasks.status as status, users.name as user')
            ->get();*/

        $test = Projects::with('tasks')->with('tasks.taskLogs')->with("tasks.taskLogs.user","tasks.taskLogs.task")->with("tasks.user")->get();

        $user = Projects::whereHas('tasks', function ($query) {
            return $query->where('user_id', Auth::id());
        })->with('tasks')->with('tasks.taskLogs')->with("tasks.taskLogs.user","tasks.taskLogs.task")->with("tasks.user")->get();

        return view('pages/dashboard/stats', ["projects" => $test->reverse(), "projectsUser" => $user->reverse()]);
    }

    public function closeProject(Request $request){

        if(Auth::Check())
        {
            $user = Projects::find($request->id);
            $user->status = "1";
            $user->save();

            return redirect()->route('stats');
        }else
        {
            return redirect()->to('/');
        }



    }


}
