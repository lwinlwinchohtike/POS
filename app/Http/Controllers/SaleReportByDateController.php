<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sale,App\SaleProduct;
use App\Payment,App\User,App\Customer;
use DB;
use Datatables;
use Carbon\Carbon;

class SaleReportByDateController extends Controller
{

    public function __construct() {
        $this->middleware("auth");       
    }

     public function index()
    {
        if(Auth::user()->hasPermission("view-sales-report"))
        {
            return view ('adminlte::report.salereport');
        }else
        {
            return redirect()->route('home');
        }
    }

    public function data(Request $request)
    {
         $profit = 0;
         $grand_profit = 0;
         $grand_total = 0;         
         $start_date = Carbon::parse($request->start_date)->startOfDay();
         $end_date = Carbon::parse($request->end_date)->endOfDay();

         $sales_data = Sale::select()->whereBetween('created_at',[$start_date,$end_date])->orderby('created_at','desc')->get();       

         $salesReport = array();  
         $i = 0;                     
           foreach($sales_data as $sales)
         { 
            $i++;
            $total_qty =DB::table('sale_products')->where('sale_id', $sales->id)->sum('quantity');
            $total_retail = DB::table('sale_products')->where('sale_id', $sales->id)->sum('total_retail');
            $total_purchase =  DB::table('sale_products')->where('sale_id', $sales->id)->sum('total_purchase');
            $profit =  $total_retail - $total_purchase ;
            $payment = Payment::select('name')->where('id', $sales->payment_id)->first();  
            $sold_by = User::select('name')->where('id', $sales->user_id)->first();
            $sold_to = Customer::select('name')->where('id', $sales->customer_id)->first();

            $grand_profit += $profit;
            $grand_total  += $total_retail;

            $salesReport[] = array($i,$sales->created_at->toDateTimeString(),$total_qty,$total_retail,$profit,$payment['name'],$sold_by['name'],$sold_to['name'],"<a href='".url('/backend/salesreportbydate/show/'.$sales->id)."' class='btn btn-primary _detail' data-rowid='$sales->id'><span class='glyphicon glyphicon-list'></span> Detail</a>",
                $grand_profit,$grand_total
                );      
       }  

        return json_encode($salesReport);       
        

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
        $sales = Sale::findOrFail($id);
        $sales_product = SaleProduct::where('sale_id', $sales->id)->get();
        //echo $sales_product;exit;
        return view("adminlte::report.saleshow",compact('sales','sales_product'));
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
