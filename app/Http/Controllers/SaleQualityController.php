<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use DB;
use Session;

class SaleQualityController extends Controller
{
    public function __construct() {
        $this->middleware("auth");       
    }
    
     public function data(Request $request)
    {
        $change_qty = $request->qty;
        $code       = $request->code;

         $product = Product::select()->where('code', $code)->first(); 
        
        if($product->quantity >= $change_qty)

        {
            $data = $request->session()->get('sales_table');

        if(empty($data))
         {
            $session_data = array();
         }
         else
         {
            if(is_array($data))
            {               
                $session_data = $data;                
            }
            else
            {
               $session_data = array();                         
            }
        }

        foreach($session_data as $key => $sd){
                if($sd['code'] == $code){
                    $session_data[$key]['quantity'] = $change_qty;
                    $session_data[$key]['total']    = $change_qty * $sd['price'];
                    break;
                }
            }

        $grand_total = 0;
         foreach($session_data as $sd)
         {                    
            $grand_total +=  $sd['total'];
         }
            $request->session()->put('sales_table', $session_data);
            return json_encode(array('sales_table'=>$session_data,'msg'=>'',
                                    'grand_total'=>$grand_total));  
        }
        else
        {
            return json_encode(array('sales_table'=>array(),'msg'=>'Out of stock!'));
        }

             
    }

    public function index()
    {
        //
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
        //
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
