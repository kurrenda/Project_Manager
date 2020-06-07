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

class AddUserController extends Controller
{

    public function index() {

        return view('pages/dashboard/addUser', ["roles" => Role::all()]);
    }

    public function addTask(Request $request)
    {
        if(Auth::Check())
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            // if fails redirects back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = new User();
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->assignRole($request->role);

            $user->save();

            return redirect()->to('/');

        }else
        {
            return redirect()->to('/');
        }
    }

}
