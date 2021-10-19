<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Str;
class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    
    
    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Role::create(['name'=>Str::ucfirst(request('name')),'slug'=>Str::of(Str::lower(request('name')))->slug('-')]);
        return back();
    
    }

    public function destroy(Role $role){
    
        $role->delete();
        
        session()->flash('role-deleted','Deleted Role'.$role->name);

        return back();
    }
}
