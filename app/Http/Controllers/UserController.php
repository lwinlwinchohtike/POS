<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\User;
use App\Role;
use DB;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Session;

class UserController extends Controller
{
   
     public function __construct() {
        $this->middleware("auth");
        //$this->middleware("superauth");
    }
    public function index()
    {
        if(Auth::user()->hasPermission("view-user"))
        {
            return view("adminlte::user.index");
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        if(Auth::user()->hasPermission("create-user") || Auth::user()->hasPermission("update-user"))
        {
        $queryuser = User::select([
                             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                             'id',
                             'name',
                             'email'])->where('is_delete',0)->orderby('id')->get();   
        }
        else{
           $queryuser = User::select([
                             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                             'id',
                             'name',
                             'email'])->where('is_delete',0)->where('id',Auth::user()->id)->orderby('id')->get(); 
        }
                
        return Datatables::of($queryuser)

        ->addColumn('role', function ($queryuser) {
          
            $data = '<b>'.$queryuser->roles->first()->name.'</b>';
            return $data;
               })

        ->addColumn('option', function ($queryuser) {
        
        if(Auth::user()->hasPermission("update-user") || Auth::user()->hasPermission("delete-user"))
        {
             if(Auth::user()->hasPermission("update-user") && Auth::user()->hasPermission("delete-user"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="users/'.$queryuser->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                        <li><a href="#" class="_delete" data-rowid='.$queryuser->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    </ul>
                    </div>';
                } 
            else if(Auth::user()->hasPermission("update-user"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="users/'.$queryuser->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                    </ul>
                    </div>';
                }  
            else if(Auth::user()->hasPermission("delete-user"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="_delete" data-rowid='.$queryuser->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    </ul>
                    </div>';
                }   

       

                return $data;
            }
        })
        ->rawColumns(['role','option'])
        ->make(true);
    }


    public function create()
    {
        if(Auth::user()->hasPermission("create-user"))
        {
             $roles = Role::select('name', 'id')->get();
            return view('adminlte::user.create', compact('roles'));
        }else
        {
            return redirect()->route('home');
        }
    }
    
    public function store(StoreUser $request)
    {
        //
       $data = [
        'name'      => $request->input("name"),
        'email'     => $request->input('email'),
        'password'  => bcrypt($request->input('password')),
        'is_admin' => 0,
        'is_super' => 0
        ];

        $user = User::create($data);
        $user->roles()->attach($request->get("roles"));
        Session::flash('message', 'You have successfully added User.');
        return redirect()->route('users.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {       
        if(Auth::user()->hasPermission("update-user") || Auth::user()->id == $id)
        {       
            $userole  = DB::select('select role_id from role_users where user_id = :id', ['id' => $id]); 
           // print_r ($userole);exit;      
            $user = User::FindOrFail($id);
            $roles = Role::select('name', 'id')->get();
            return view('adminlte::user.edit',compact('roles','user','userole'));
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function update(UpdateUser $request, $id)
    {        
        try
        {
            $roleuser = $request->input('roles');
            $name  = $request->input("name");
            $email     = $request->input('email');
            $password  = $request->input('password');
            
            if(isset($password) && !empty($password)){
                $userupdate = ['name' => $name,'email' => $email,'password'=>bcrypt($password)];

            }else{
                 $userupdate = ['name' => $name,'email' => $email];
            }

            DB::table('users')
                ->where('id', $id)
                ->update($userupdate);

            if(Auth::user()->hasPermission("create-role") || Auth::user()->hasPermission("update-role"))
            {
                
            DB::table('role_users')
                ->where('user_id', $id)
                ->update(['role_id' => $roleuser]);
            }
            Session::flash('message', 'You have successfully updated User.');

            if(Auth::user()->id == $id)
            {
                return redirect()->back();
            }
                
            else
            {
                return redirect()->route("users.index"); 
            } 
        }catch(\Illuminate\Database\QueryException $e)
        {
                Session::flash('message', 'The email has already been taken.');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
        }
             
    }

   
    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-user"))
        { 
            // $id = $_POST["data-rowid"];
            // User::destroy($id);
            // DB::table('role_users')->where('user_id',$id)->delete();
            $id = $_POST["data-rowid"];        
             $user = User::findOrFail($id);
                if($user) {
                $user->is_delete = 1;
                $user->save();
                } 
            Session::flash('message', 'You have successfully deleted User.');
            return redirect()->route("users.index"); 

        } 
        else
        {
            return redirect()->route('home');
        }    
    }
}
