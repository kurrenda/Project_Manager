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

class EditAuthController extends Controller
{

    public function index() {

        return view('pages/dashboard/users', ["users" => User::with('roles')->get()]);
    }

    public function indexAuth($id){

        return view('pages/dashboard/editAuth', ["users" => User::find($id), "roles" => Role::all()]);
    }

    public function editAuth(Request $request, $id)
    {
        if(Auth::Check())
        {
            if($request->password)
            {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $id],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                // if fails redirects back with errors
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $user = User::find($id);
                $user->password = Hash::make($request->password);
                $user->email = $request->email;
                $user->name = $request->name;

                $user->roles()->detach();
                $user->assignRole($request->role);

                $user->save();

                return redirect()->route('editAuth');
            }else
            {
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $id],
                ]);

                // if fails redirects back with errors
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $user = User::find($id);
                $user->email = $request->email;
                $user->name = $request->name;

                $user->roles()->detach();
                $user->assignRole($request->role);

                $user->save();

                return redirect()->route('editAuth');


            }


        }else
        {
            return redirect()->to('/');
        }
    }

    public function deleteUser(Request $request)
    {
        if(Auth::Check())
        {
            $user = User::find($request->id);
            $user->delete();
            return redirect()->route('editAuth');
        }else
        {
            return redirect()->to('/');
        }

    }

}
