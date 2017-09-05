<?php
#llchtike
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sale,App\SaleProduct;
use App\Customer,App\Payment,App\Product,App\Inventory;
use App\User;
use App\Http\Requests\StoreSale;
use Session;
use DB;

class SaleController extends Controller
{
  
    public function __construct() {
        $this->middleware("auth");       
    }

    public function index(Request $request)
    {
        if(Auth::user()->hasPermission("view-sales"))
        {         
            $data = session()->get('session_data');
           
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

            $sales = Sale::orderBy('id', 'desc')->first();
            $products    = Product::select('name', 'id')->where('is_delete',0)->get();
            $customers   = Customer::select('name', 'id')->where('is_delete',0)->get();
            $payments    = Payment::select('name','id')->where('is_delete',0)->get(); 

            return view("adminlte::sale.index",compact('session_data','sales','products','customers','payments')); 
        }else
        {
            return redirect()->route('home');
        }      
    }

    public function complete()
    {
         return view("adminlte::sale.complete");
    }

    public function data(Request $request)
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
                //print_r($session_data);exit;
            }
            else
            {
               $session_data = array();                         
            }
        }

         $product = Product::select()->where('is_delete',0)->where('code', $request->code)->first(); 
        
        //return json_encode(array('product_code'=>$product,'msg'=>'found'));        
        if($product != null)
        {
            $product_id = $product->id;
            $purchase_price = $product->purchase_price;
            $code = $product->code;
            $name = $product->name;
            $quantity = $product->quantity;
            $price = $product->retail_price;
            //$total = $quantity * $price;

            if($quantity > 0)
            {  
                 $found = false;
                 foreach($session_data as $sd)
                 {
                    if($sd['code']==$request->code)
                    {
                        $found = true;break;
                    }                    
                 }
                 if($found){                    
                 //Do Yes --> if item already in buying list,update Qty in sessiondata
                    // for($i = 0; $i < count($session_data) ; $i++)
                    //  {
                        foreach($session_data as $key => $sd){
                        if($sd['code'] == $request->code){
                            $session_data[$key]['quantity'] =  $sd['quantity'] +1;
                            $session_data[$key]['total']    = $session_data[$key]['quantity'] * $sd['price'];
                            break;
                            }
                        }
                        // if($session_data[$i]['code'] == $request->code)
                        // {
                        //     $session_data[$i]['quantity'] = $session_data[$i]['quantity'] + 1;
                        //     $session_data[$i]['total'] = $session_data[$i]['quantity'] * $session_data[$i]['price'];                            
                        //     break;
                        // }                                     
                     //}
                 }
                 else{
                    //Do No                    
                    $session_data[] = array('product_id'=>$product_id,'purchase_price'=>$purchase_price,'code'=>$code,'name'=>$name,'quantity'=>1,'price'=>$price, 'total'=>1*$price);
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
        else
        {
            return json_encode(array('sales_table'=>array(),'msg'=>'Please check your code and try again!'));
        }
        
    }

    public function remove(Request $request)
    {
        $code = $request->pcode;         
        //return json_encode(array('product_code'=>$code,'msg'=>'found')); 

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
        //echo "<pre>";print_r($session_data);exit;
         // for($i = 0; $i < count($session_data) ; $i++)
         // {
            /*
            if(array_key_exists('code', $session_data[$i]))
            {
                if($session_data[$i]['code'] == $code)
              {
                 unset($session_data[$i]);  
                //dd($session_data[$i]["code"]);                       
                break;
              }      
            }
            */

         //} 
            foreach($session_data as $key => $sd){
                if($sd['code'] == $code){
                    unset($session_data[$key]);
                    break;
                }
            }
        //echo "<pre>";print_r($session_data);exit;
         $grand_total = 0;
         foreach($session_data as $sd)
         {                    
            $grand_total +=  $sd['total'];
         }
            $request->session()->put('sales_table', $session_data);
            return json_encode(array('sales_table'=>$session_data,'msg'=>'',
                                    'grand_total'=>$grand_total));               
       
    }

    public function create()
    {
        //
    }

    public function store(StoreSale $request)
    { 
        $data = session()->get('sales_table');
         //print_r($session_data);exit;
        if(empty($data))
         {
            $session_data = array();
         }
         else
         {
            if(is_array($data))
            {               
                $session_data = $data;
                //print_r($session_data);exit;
            }
            else
            {
               $session_data = array();                         
            }
        }
             
             if(!empty($session_data))
         {
            $info_data = [
            'customer_id'      => $request->input('customer_id'),
            'user_id'     => Auth::user()->id,
            'payment_id'  => $request->input('payment_id'),
            'comments'  => $request->input('comments'),
            ];
            $sales = Sale::create($info_data);

            foreach($session_data as $sd){         
                 $sale_data = [
                'sale_id'        => $sales->id,
                'product_id'     => $sd['product_id'],
                'purchase_price' => $sd['purchase_price'],
                'retail_price'   => $sd['price'],
                'quantity'       => $sd['quantity'],
                'total_purchase' => $sd['purchase_price'] * $sd['quantity'],
                'total_retail'   => $sd['total'],
                ]; 
                $sale_product = SaleProduct::create($sale_data); 

                $inventory_data = [
                                'product_id'  => $sd['product_id'],
                                'user_id'     => Auth::user()->id,
                                'in_out_qty'  => -($sd['quantity']),
                                'remarks'     => 'SALE'.$sales->id,
                                ];
                Inventory::create($inventory_data);

                $products = Product::find($sd['product_id']);
                $products->quantity = $products->quantity - $sd['quantity'];
                $products->update();
             }
         }        

         $sale_data[] = array('grand_total' => $request->input('modal_total'),
                              'paid'      =>$request->input('modal_paid'),
                              'return_change'  => $request->input('modal_change'),
                              'tax'           =>$request->input('modal_tax'));
            
            //echo "<pre>";print_r($sale_data);exit;
          $request->session()->put('sales_table',array());
          return view("adminlte::sale.complete",compact('sales','session_data','sale_product','sale_data')); 

    }

    public function discard(Request $request)
    {
        $request->session()->put('sales_table',array());
         return redirect('backend/sales');
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
