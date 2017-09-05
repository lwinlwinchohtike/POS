<?php
// Author: Nwe Ni Ei Kyaw 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\Supplier;
use App\Http\Requests\StoreSupplier;
use DB;
use Session;

class SupplierController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
        //$this->middleware("is_super");
        
    }
   
    public function index()
    { 
        if(Auth::user()->hasPermission("view-supplier")){       
            return view("adminlte::supplier.index");
        }else
        {
            return redirect()->route('home');
        }
    }

    
    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $querysupplier = Supplier::select([
                                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                     'id',
                                     'company_name',
                                     'suppliername',
                                     'email',
                                     'phoneno',
                                     'address', 
                                     //'tax'
                                     ])->where('is_delete',0)->orderby('id')->get();
        return Datatables::of($querysupplier)
         ->addColumn('photo', function ($querysupplier) {
      
            $images = Supplier::find($querysupplier->id)->getMedia('suppliers');

                if(count($images)>0)
                {
                    $image_url = $images[0]->getUrl();
                    return "<img height=100 src='$image_url'/>"; 
                }
                else
                {
                    return "<img height=100 src='../img/no-photo.png'/>"; 
                }          
            })
        ->addColumn('option', function ($querysupplier) { 

         if(Auth::user()->hasPermission("update-supplier") || Auth::user()->hasPermission("delete-supplier"))
            {
                if(Auth::user()->hasPermission("update-supplier") && Auth::user()->hasPermission("delete-supplier"))
                {
                        $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="suppliers/'.$querysupplier->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                        <li><a href="#" class="_delete" data-rowid='.$querysupplier->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    </ul>
                    </div>';
                }
                else if(Auth::user()->hasPermission("update-supplier"))
                {
                        $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="suppliers/'.$querysupplier->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                    </ul>
                    </div>';
                }
                else if(Auth::user()->hasPermission("delete-supplier"))
                {
                        $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="_delete" data-rowid='.$querysupplier->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    </ul>
                    </div>';
                }
                return $data;
            }

            })
        ->rawColumns(['photo','option'])   
        ->make(true);
    }

   
    public function create()
    {
        if(Auth::user()->hasPermission("create-supplier")){
            return view("adminlte::supplier.create");
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function store(StoreSupplier $request)
    {
        //
        $supplier = Supplier::create($request->input());
        $photoName = 'supplier' . $supplier->id ; 
        $photo = $request->file('photo');
            if(!empty($photo))
            {
                $supplier ->addMedia($photo)
                         ->usingName($photoName)
                         ->toMediaCollection('suppliers'); 
             } 
        Session::flash('message', 'You have successfully added Supplier.');
        return redirect()->route('suppliers.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-supplier")){
            $supplier = Supplier::FindOrFail($id);
            return view('adminlte::supplier.edit',compact('supplier'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                //'company_name'  => 'required',
                'suppliername'  => 'required|min:2',
                'email'   => 'required',
                'phoneno' => 'required|regex:/[0-9]{6}/',
               // 'address' => 'required',
                //'tax'     => 'numeric|min:0|max:100',
      ]);

        $supplier = Supplier::find($id);

        //Update photo
        $photoName = 'supplier' . $supplier->id ; 
        $photo = $request->file('photo');
            if(!empty($photo))
            {
                // DB::table('media')->where('model_id', $id)->delete();
                DB::table('media')->where('name', $photoName)->delete();
                $supplier ->addMedia($photo)
                         ->usingName($photoName)
                         ->toMediaCollection('suppliers');
             } 


        Supplier::findOrFail($id)->update($request->all());
        Session::flash('message', 'You have successfully updated Supplier.');
        return redirect()->route('suppliers.index');
    }

    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-supplier")){
            // try
            // {
            //     $id = $_POST["data-rowid"];
            //     Supplier::destroy($id);
            //     Session::flash('message', 'You have successfully deleted Supplier.');
            //     return redirect()->route("suppliers.index");  
            // }
            // catch(\Illuminate\Database\QueryException $e)
            // {
            //     Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            //     Session::flash('alert-class', 'alert-danger');
            //     return redirect()->route("suppliers.index");
            // }

            $id = $_POST["data-rowid"];        
             $supplier = Supplier::findOrFail($id);
                if($supplier) {
                $supplier->is_delete = 1;
                $supplier->save();
                }
                Session::flash('message', 'You have successfully deleted Supplier.');
                return redirect()->route("suppliers.index"); 
           
        }else
        {
            return redirect()->route('home');
        }
    }
}
