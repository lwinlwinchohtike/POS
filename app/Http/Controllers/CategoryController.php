<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\Http\Requests\StoreCategory;
use App\Category;
use DB;
use Session;

class CategoryController extends Controller
{
     public function __construct() {
        $this->middleware("auth");
        //$this->middleware("superauth");
    }
   
    public function index()
    {
        if(Auth::user()->hasPermission("view-category")){ 
            return view ('adminlte::categories.index');
        }else
        {
            return redirect()->route('home');
        }
    }

    public function data()
        {
            DB::statement(DB::raw('set @rownum=0'));
            $querycat = Category::select([
                                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                    'id', 
                                    'name'])->where('is_delete',0)->orderby('id')->get();
            return Datatables::of($querycat)
            
            ->addColumn('option', function ($querycat) {
                if(Auth::user()->hasPermission("update-category") || Auth::user()->hasPermission("delete-category"))
                {

                    if(Auth::user()->hasPermission("update-category") && Auth::user()->hasPermission("delete-category"))
                    {
                         $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="categories/'.$querycat->id.'/edit" 
                            ><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                            <li><a href="#" class="_delete" data-rowid='.$querycat->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                        </ul>
                        </div>';
                    }

                    else if(Auth::user()->hasPermission("update-category"))
                    {
                        $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="categories/'.$querycat->id.'/edit" 
                            ><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                           
                        </ul>
                        </div>';
                    }
                    else if(Auth::user()->hasPermission("delete-category"))
                    {
                         $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          
                            <li><a href="#" class="_delete" data-rowid='.$querycat->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
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
       if(Auth::user()->hasPermission("create-category")){ 
            return view('adminlte::categories.create');
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function store(StoreCategory $request)
    {
        //
        Category::create($request->input());
        Session::flash('message', 'You have successfully added Category.');
        return redirect()->route('categories.index');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
       if(Auth::user()->hasPermission("update-category")){ 
            $category = Category::FindOrFail($id);
            return view('adminlte::categories.edit',compact('category'));
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function update(Request $request, $id)
    {        
            $this->validate($request, [
                 'name'  => 'required',           
          ]);
            Category::findOrFail($id)->update($request->all());
            Session::flash('message', 'You have successfully updated Category.');
            return redirect()->route('categories.index');       
    }

    
    public function destroy()
    {
         if(Auth::user()->hasPermission("delete-category"))
         {
            $id = $_POST["data-rowid"];
            // Category::destroy($id);
            $category = Category::findOrFail($id);
                if($category) {
                $category->is_delete = 1;
                $category->save();
                }
            Session::flash('message', 'You have successfully deleted Category.');
            return redirect()->route("categories.index");
        }else
        {
            return redirect()->route('home');
        }
    }
}
