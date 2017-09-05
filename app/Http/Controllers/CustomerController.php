<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\Customer;
use DB;
use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use Session;


class CustomerController extends Controller
{
   
    public function __construct() {
        $this->middleware("auth");
        //$this->middleware("superauth");
    }

    public function index()
    {
       if(Auth::user()->hasPermission("view-customer")){  
            return view("adminlte::customer.index");
        }else
        {
             return redirect()->route('home');
        }
    }

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $querycustomer = Customer::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id', 
            'name', 
            'email',
            'phonenumber',
            'company_name',
            'address'
            ])->where('is_delete',0)->orderby('id')->get();
        return Datatables::of($querycustomer)
        ->addColumn('photo', function ($querycustomer) {    

            $images = Customer::find($querycustomer->id)->getMedia('customers');

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

        ->addColumn('option', function ($querycustomer) {

             if(Auth::user()->hasPermission("update-customer") || Auth::user()->hasPermission("delete-customer"))
                {
                    if(Auth::user()->hasPermission("update-customer") && Auth::user()->hasPermission("delete-customer"))
                    {
          
                     $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="customers/'.$querycustomer->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                            <li><a href="#" class="_delete" data-rowid='.$querycustomer->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                        </ul>
                     </div>';
                    }
                    else if(Auth::user()->hasPermission("update-customer"))
                    {
                          $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="customers/'.$querycustomer->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>                           
                        </ul>
                     </div>';
                    }
                     else if(Auth::user()->hasPermission("delete-customer"))
                    {
                          $data = '<div class="btn-group">
                        <a href="#" class="btn btn-default">Option</a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="_delete" data-rowid='.$querycustomer->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
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
        //
        //
       //$customers = Customer::select('name', 'id','email','address')->get();
       if(Auth::user()->hasPermission("create-customer")){         
           return view('adminlte::customer.create');
       }else
       {
        return redirect()->route('home');
       }
   }

   
    public function store(StoreCustomer $request)
    {
    
     $customer = Customer::create($request->input()); 
     $photoName = 'customer' . $customer->id ; 
     $photo = $request->file('photo');
            if(!empty($photo))
            {
                $customer->addMedia($photo)
                        ->usingName($photoName)
                        ->toMediaCollection('customers'); 
             }  
     Session::flash('message', 'You have successfully added Customer.');
     return redirect()->route('customers.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-customer")){
            $customer = Customer::FindOrFail($id);
            return view('adminlte::customer.edit',compact('customer'));
        }else
        {
            return redirect()->route('home');
        }
    }

   
    public function update(UpdateCustomer $request, $id)
    { 
        //Update photo
         $customer = Customer::find($id); 
         $photoName = 'customer' . $customer->id ; 
         $photo = $request->file('photo');
            if(!empty($photo))
            {
                DB::table('media')->where('name', $photoName)->delete();
                $customer->addMedia($photo)
                        ->usingName($photoName)
                        ->toMediaCollection('customers'); 
             } 
              
        Customer::findOrFail($id)->update($request->all()); 
        Session::flash('message', 'You have successfully updated Customer.');       
        return redirect()->route('customers.index');
    }

   
    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-customer")){
            // try
            // {
            //     $id = $_POST["data-rowid"];
            //     Customer::destroy($id);
            //     Session::flash('message', 'You have successfully deleted Customer.');
            //     return redirect()->route("customers.index");
            // }
            // catch(\Illuminate\Database\QueryException $e)
            // {
            //     Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            //     Session::flash('alert-class', 'alert-danger');
            //     return redirect()->route("customers.index");
            // }

            $id = $_POST["data-rowid"];        
             $customer = Customer::findOrFail($id);
                if($customer) {
                $customer->is_delete = 1;
                $customer->save();
                }
                Session::flash('message', 'You have successfully deleted Customer.');
                return redirect()->route("customers.index");
        }else
        {
            return redirect()->route('home');
        }
    }
}


