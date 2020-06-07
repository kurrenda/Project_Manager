<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\TaskLogs;
use App\TimerRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class TimerRegisterController extends Controller
{
    public function index() {

        $query = TaskLogs::where('user_id', Auth::id())->with('task')->groupBy('task_id')
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
            ->groupBy('task_id','tasks.name', 'tasks.status', 'tasks.user_id')
            ->selectRaw('sum(hours_worked) as sum, tasks.name as name, tasks.status as status, tasks.user_id as user')
            ->get();


        return view('pages/dashboard/stats', ["userTask" => $stats , "userAdmin" => $statsA]);
    }

    public function registerTime(Request $request)
    {
        if(Auth::Check())
        {


            return redirect()->route('tasks');

        }else
        {
            return redirect()->to('/');
        }
    }


}
