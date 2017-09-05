<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\Role;
use App\Http\Requests\StoreRole;
use DB;
use Session;

class RoleController extends Controller
{
   
    public function __construct() {
        $this->middleware("auth");
        //$this->middleware("superauth");
        
    }
    public function index()
    {
        if(Auth::user()->hasPermission("view-role"))
        {
            return view("adminlte::role.index");
        }else
        {
            return redirect()->route('home');
        }
    }
   

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $queryrole = Role::select([
                             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                             'id',
                             'name', 
                             'slug', 
                             'permissions']);
        return Datatables::of($queryrole)
        ->addColumn('permissions', function ($queryrole) {
                foreach ($queryrole->permissions as $key => $value) {
                    # code...
                    $data[] = $key;
                }
                return $data;
            })
        ->addColumn('option', function ($queryrole) {

             if(Auth::user()->hasPermission("update-role") || Auth::user()->hasPermission("delete-role"))
                {
                    if(Auth::user()->hasPermission("update-role") && Auth::user()->hasPermission("delete-role"))
                    {   
                        $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="roles/'.$queryrole->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                            <li><a href="#" class="_delete" data-rowid='.$queryrole->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                        </ul>
                        </div>';
                    }
                    else if(Auth::user()->hasPermission("update-role"))
                    {   
                        $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="roles/'.$queryrole->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>                            
                        </ul>
                        </div>';
                    }
                     else if(Auth::user()->hasPermission("delete-role"))
                    {   
                        $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="_delete" data-rowid='.$queryrole->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                        </ul>
                        </div>';
                    }

                  return $data;
                }
            })
        ->rawColumns(['option'])
        ->make(true);
    }

    public function create()
    {
        if(Auth::user()->hasPermission("create-role"))
        {
            $permissions = config('role-permissions');
            return view('adminlte::role.create', compact('permissions'));
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function store(StoreRole $request)
    {
       Role::create($request->input());
       Session::flash('message', 'You have successfully added Role.');
       return redirect()->route('roles.index');
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-role"))
        {
            $role = Role::FindOrFail($id);
            $permissions = config('role-permissions');       
            return view('adminlte::role.edit',compact('permissions','role'));
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function update(Request $request,$id)
    {
       $this->validate($request, [
             'name'  => 'required|min:4',
             'slug'  => 'required|min:4',
             'permissions'   => 'required|array'
      ]);
        Role::findOrFail($id)->update($request->all());
        Session::flash('message', 'You have successfully updated Role.');
        return redirect()->route('roles.index');
        
    }

   
    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-role"))
        {
            $id = $_POST["data-rowid"];
            Role::destroy($id);
            Session::flash('message', 'You have successfully deleted Role.');
            return redirect()->route("roles.index");
        }else
        {
            return redirect()->route('home');
        }
    }
}