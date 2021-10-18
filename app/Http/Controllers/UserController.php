<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(){
    
        $users = User::all();
        return view('admin.users.index', compact('users'));
    
    }
    public function show(User $user){
        
        return view('admin.users.profile', ['user'=>$user,'roles'=>Role::all()]);
    
    }
    public function update(User $user){
    
        $inputs = request()->validate([
            'username'=>['required','string','max:255','alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file']
        ]);
        
         if(request('avatar')){
             $inputs['avatar'] = request('avatar')->store('images');
         }

         $user->update($inputs);

         return back();
    }
    public function destroy(User $user){
    

        $path = parse_url($user->avatar);
        File::delete(public_path($path['path']));
        $user->delete();

        session()->flash('user-deleted-message','User was Deleted');
    
        return redirect()->route('users.index');
        
    
    }

    public function attach(User $user){

        $user->roles()->attach(request('role'));

        return back();

    }

    
    public function detach(User $user){

        $user->roles()->detach(request('role'));
        
        return back(); 

    }
}
