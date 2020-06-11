<?php

namespace App\Http\Controllers;

use App\TaskLogs;
use App\Task;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class RaportsController extends Controller
{

    public function index() {


        $invoices = DB::table('task_logs')->where('user_id', Auth::id())->where('accepted', 1)
            ->select(
                DB::raw('user_id as user'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(hours_worked) as sum')
            )
            ->groupBy('year', 'month',"user")
            ->get()->groupBy('user');

        $invoicesAll = DB::table('task_logs')->where('accepted', 1)->join('users', 'task_logs.user_id', '=', 'users.id')
            ->select(
                DB::raw('users.name as user'),
                DB::raw('YEAR(task_logs.created_at) as year'),
                DB::raw('MONTH(task_logs.created_at) as month'),
                DB::raw('SUM(task_logs.hours_worked) as sum')
            )
            ->groupBy('year', 'month',"user")
            ->get()->groupBy('user');

        return view('pages/dashboard/raports', ["raports" => $invoices, "raportsAll" => $invoicesAll]);
    }


}
