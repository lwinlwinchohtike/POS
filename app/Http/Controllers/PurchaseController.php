<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Purchase,App\PurchaseProduct;
use App\Supplier,App\Payment,App\Product,App\Inventory;
use App\User;
use App\Http\Requests\StorePurchase;
use Session;

class PurchaseController extends Controller
{

    public function __construct() {
        $this->middleware("auth");       
    }
   
    public function index()
    {
        if(Auth::user()->hasPermission("view-purchase"))
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

            $products    = Product::select('name', 'id')->where('is_delete',0)->get();
            $suppliers   = Supplier::select('suppliername', 'id')->where('is_delete',0)->get();
            $payments    = Payment::select('name','id')->where('is_delete',0)->get(); 

            return view("adminlte::purchase.index",compact('session_data','products','suppliers','payments'));
        }else
        {
            return redirect()->route('home');
        }   
    }

    public function data(Request $request)
    {
        $data = $request->session()->get('purchase_table');

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

        $product = Product::select()->where('code', $request->code)->first();   
        
        //return json_encode(array('product_code'=>$product,'msg'=>'found'));        
        if($product != null)
        {
            $product_id = $product->id;
            $price = $product->purchase_price;
            $code = $product->code;
            $name = $product->name;
            $quantity = $product->quantity;
            
            // if($quantity > 0)
            // {  
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
                    
                        foreach($session_data as $key => $sd){
                        if($sd['code'] == $request->code){
                            $session_data[$key]['quantity'] =  $sd['quantity'] +1;
                            $session_data[$key]['total']    = $session_data[$key]['quantity'] * $sd['price'];
                            break;
                            }
                        }                       
                 }
                 else{
                    //Do No                    
                    $session_data[] = array('product_id'=>$product_id,'price'=>$price,'code'=>$code,'name'=>$name,'quantity'=>1,'total'=>1*$price);
                 }

                 $grand_total = 0;
                 foreach($session_data as $sd)
                 {                    
                    $grand_total +=  $sd['total'];
                 }
                    $request->session()->put('purchase_table', $session_data);
                    return json_encode(array('purchase_table'=>$session_data,'msg'=>'',
                                            'grand_total'=>$grand_total));               
            // }
            // else
            // {
            //     return json_encode(array('purchase_table'=>array(),'msg'=>'Out of stock!'));
            // }          
        }
        else
        {
            return json_encode(array('purchase_table'=>array(),'msg'=>'Please check your code and try again!'));
        }
        
    }

    public function remove(Request $request)
    {
        $code = $request->pcode;         
        //return json_encode(array('product_code'=>$code,'msg'=>'found')); 

         $data = $request->session()->get('purchase_table');

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
            $request->session()->put('purchase_table', $session_data);
            return json_encode(array('purchase_table'=>$session_data,'msg'=>'',
                                    'grand_total'=>$grand_total));               
       
    }

    public function discard(Request $request)
    {
        $request->session()->put('purchase_table',array());
         return redirect('backend/purchase');
    }

   
    public function create()
    {
        //
    }

   
    public function store(StorePurchase $request)
    {
        $data = session()->get('purchase_table');
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
            'supplier_id' => $request->input('supplier_id'),
            'user_id'     => Auth::user()->id,
            'payment_id'  => $request->input('payment_id'),
            'comments'    => $request->input('comments'),
            ];
            $purchase = Purchase::create($info_data);

            foreach($session_data as $sd){         
                 $purchase_data = [
                'purchase_id'        => $purchase->id,
                'product_id'     => $sd['product_id'],
                'purchase_price' => $sd['price'],                
                'quantity'       => $sd['quantity'],
                'total_purchase' => $sd['price'] * $sd['quantity'],               
                ]; 
                $purchase_product = PurchaseProduct::create($purchase_data); 

                $inventory_data = [
                                'product_id'  => $sd['product_id'],
                                'user_id'     => Auth::user()->id,
                                'in_out_qty'  => +($sd['quantity']),
                                'remarks'     => 'PURCHASE'.$purchase->id,
                                ];
                Inventory::create($inventory_data);

                $products = Product::find($sd['product_id']);
                $products->quantity = $products->quantity + $sd['quantity'];
                $products->update();
             }
         }        

         $purchase_data[] = array('grand_total' => $request->input('modal_total'),
                              'paid'      =>$request->input('modal_paid')
                             );
           
          $request->session()->put('purchase_table',array());
          return view("adminlte::purchase.complete",compact('purchase','session_data','purchase_product','purchase_data')); 

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
