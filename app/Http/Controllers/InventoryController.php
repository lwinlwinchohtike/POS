<?php 
namespace App\Http\Controllers;

use App\Product;
use App\Inventory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInventory;
use DB;
use Session;
use \Auth;
use Datatables;

class InventoryController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
   
    public function index()
    {
        //view-product-tracking
        if(Auth::user()->hasPermission("view-product-tracking")){ 
            return view("adminlte::inventories.index");
        }else
        {
            return redirect()->route('home');
        }
    }

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $queryinventory = Inventory::select([
                             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                             'id',
                             'updated_at',
                             'product_id', 
                             'user_id', 
                             'in_out_qty', 
                             'remarks'])->where('in_out_qty','!=',0)->orderby('created_at','desc')->get();        
        return Datatables::of($queryinventory) 
       
        ->addColumn('product', function ($queryinventory) {
                 $data = Product::select('name')->where('id', $queryinventory->product_id)->first();     
                 return $data['name'];
            })
        ->addColumn('user', function ($queryinventory) {
                 $data = User::select('name')->where('id', $queryinventory->user_id)->first();     
                 return $data['name'];
            })
        ->addColumn('option', function ($queryinventory) {
                
            $data = '<div class="btn-group">
            <a href="inventories/show/'.$queryinventory->product_id.'" class="btn btn-primary"><i class="glyphicon glyphicon-list"></i> Check Product</a></div>';

        return $data;                              
        })        
        ->rawColumns(['option'])
        ->make(true);
    }

    public function databyproductID(Request $request)
    {
         
        $inventories = Inventory::where('product_id',$request->p_id)->where('in_out_qty','!=',0)->orderby('created_at','desc')->get(); 
        $product_list = array();  

         $i = 0;                     
           foreach($inventories as $in)
         { 
            $i++;
            $date = $in->updated_at;
            $product = Product::select('name')->where('id', $in->product_id)->first();
            $qty = $in->in_out_qty; 
            $user = User::select('name')->where('id', $in->user_id)->first(); 
            $remarks = $in->remarks;

            $product_list[] = array($i,$date->toDateTimeString(),$product['name'],$qty,$user['name'],$remarks);      
       }  

        return json_encode($product_list);  
    }
   
    public function create()
    {
        //
      
    }

   
    public function store(StoreInventory $request)
    {
       
    }

    
    public function show($id)
    {
        $products = Product::findOrFail($id);
        $inventories = Inventory::where('product_id', $id)->where('in_out_qty','!=',0)->orderby('created_at','desc')->get();
        //echo $inventories;exit;
        return view("adminlte::inventories.show",compact('products','inventories'));
    }

   
    public function edit($id)
    {
        //
        $products = Product::FindOrFail($id);
        $users = \Auth::user()->name;
        $inventories = Inventory::all();
        
        return view('adminlte::inventories.edit',compact('products', 'inventories', 'users'));
    }

    public function update(StoreInventory $request, $id)
    {
        //
        $products = Product::find($id);
        $products->quantity = $products->quantity + $request->input("in_out_qty");
        $products->save();

        $inventories = new Inventory();
        $inventories->product_id = $id;
        $inventories->user_id = Auth::user()->id;
        $inventories->in_out_qty = $request->input("in_out_qty");
        $inventories->remarks = $request->input("remarks");

        $inventories->save();
        Session::flash('message', 'You have successfully Inventory data.');
        return redirect()->route('products.index');
    }

    
    public function destroy($id)
    {
        //
    }
}
