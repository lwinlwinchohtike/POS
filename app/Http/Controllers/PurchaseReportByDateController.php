<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Purchase,App\PurchaseProduct;
use App\Payment,App\User,App\Supplier;
use DB;
use Datatables;
use Carbon\Carbon;

class PurchaseReportByDateController extends Controller
{
   public function __construct() {
        $this->middleware("auth");       
    }

    public function index()
    {
        if(Auth::user()->hasPermission("view-purchase-report"))
        {
            return view ('adminlte::report.purchasereport');
        }else
        {
            return redirect()->route('home');
        }
    }

    public function data(Request $request)
    {         
         $grand_total = 0;         
         $start_date = Carbon::parse($request->start_date)->startOfDay();
         $end_date = Carbon::parse($request->end_date)->endOfDay();

         $purchase_data = Purchase::select()->whereBetween('created_at',[$start_date,$end_date])->orderby('created_at','desc')->get();

         $purchaseReport = array();  
         $i = 0;                     
           foreach($purchase_data as $purchase)
         { 
            $i++;
            $total_qty =DB::table('purchase_products')->where('purchase_id', $purchase->id)->sum('quantity');
            $total_purchase =  DB::table('purchase_products')->where('purchase_id', $purchase->id)->sum('total_purchase');

             $grand_total  += $total_purchase;

            $payment = Payment::select('name')->where('id', $purchase->payment_id)->first();  
            $sold_by = User::select('name')->where('id', $purchase->user_id)->first();
            $sold_to = Supplier::select('suppliername')->where('id', $purchase->supplier_id)->first();
            
            $purchaseReport[] = array($i,$purchase->created_at->toDateTimeString(),$total_qty,$total_purchase,$payment['name'],$sold_by['name'],$sold_to['suppliername'],"<a href='".url('/backend/purchasereportbydate/show/'.$purchase->id)."' class='btn btn-success _detail' data-rowid='$purchase->id'><span class='glyphicon glyphicon-list'></span> Detail</a>",$grand_total
                ); 
       } 

        return json_encode($purchaseReport);
    }  

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase_product = PurchaseProduct::where('purchase_id', $purchase->id)->get();        
        return view("adminlte::report.purchaseshow",compact('purchase','purchase_product'));
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
