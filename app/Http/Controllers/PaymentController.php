<?php
// Author: Nwe Ni Ei Kyaw 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datatables;
use App\Payment;
use App\Http\Requests\StorePayment;
use DB;
use Session;

class PaymentController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
        //$this->middleware("is_super");
        
    }
   
    public function index()
    {
        if(Auth::user()->hasPermission("view-payment-method"))
        {
            return view("adminlte::payment.index");
        }else
        {
             return redirect()->route('home');
        }
    }

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $querypayment = Payment::select([
                                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                'id', 
                                'name'])->where('is_delete',0)->orderby('id')->get();
        return Datatables::of($querypayment)
        ->addColumn('option', function ($querypayment) {
            if(Auth::user()->hasPermission("update-payment-method") || Auth::user()->hasPermission("delete-payment-method"))
            {
             if(Auth::user()->hasPermission("update-payment-method") && Auth::user()->hasPermission("delete-payment-method"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="payments/'.$querypayment->id.'/edit" 
                        ><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                        <li><a href="#" class="_delete" data-rowid='.$querypayment->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    </ul>
                    </div>';
                }
                else if(Auth::user()->hasPermission("update-payment-method"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="payments/'.$querypayment->id.'/edit" 
                        ><i class="glyphicon glyphicon-edit"></i> Edit</a></li>                       
                    </ul>
                    </div>';
                }
                else if(Auth::user()->hasPermission("delete-payment-method"))
                {
                     $data = '<div class="btn-group">
                    <a href="#" class="btn btn-default">Option</a>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">                       
                        <li><a href="#" class="_delete" data-rowid='.$querypayment->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
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
        if(Auth::user()->hasPermission("create-payment-method"))
        {
            return view("adminlte::payment.create");
        }else
        {
             return redirect()->route('home');
        }
    }

    public function store(StorePayment $request)
    {
        //
        Payment::create($request->input());
        Session::flash('message', 'You have successfully added Payment.');
        return redirect()->route('payments.index');
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        
        if(Auth::user()->hasPermission("update-payment-method"))
        {
            $payment = Payment::FindOrFail($id);
            return view('adminlte::payment.edit',compact('payment'));
        }else
        {
            return redirect()->route('home');
        }
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'name'  => 'required|min:2',      
      ]);
        Payment::findOrFail($id)->update($request->all());
        Session::flash('message', 'You have successfully updated Payment.');
        return redirect()->route('payments.index');
    }

    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-payment-method"))
        {
            $id = $_POST["data-rowid"];
            // Payment::destroy($id);
            $payment = Payment::findOrFail($id);
                if($payment) {
                $payment->is_delete = 1;
                $payment->save();
                }
             Session::flash('message', 'You have successfully deleted Payment.');
            return redirect()->route("payments.index");
        }else
        {
            return redirect()->route('home');
        }
    }
}
