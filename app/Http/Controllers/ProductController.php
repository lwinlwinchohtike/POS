<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Inventory;
use App\Category;
use Illuminate\Http\Request;
use Datatables;
use App\Http\Requests\StoreProduct;
use DB;
use Session;
use Alert;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware("auth");       
    }

    public function index()
    {
        if(Auth::user()->hasPermission("view-product")){        
            $categories = Category::select('name', 'id')->where('is_delete',0)->get(); 
           // echo $categories;exit;
            return view("adminlte::product.index",compact('categories'));
        }else{
            return redirect()->route('home');
        }
       
    }

    public function data()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $queryproduct = Product::select([
                             DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                             'id',
                             'name', 
                             'code', 
                             'purchase_price', 
                             'retail_price',
                             'quantity',
                             'description',                             
                             'category_id'])->where('is_delete',0)->orderby('code')->get();        
        return Datatables::of($queryproduct)
        ->addColumn('category', function ($queryproduct) {
                 $data = Category::select('name')->where('id', $queryproduct->category_id)->first();
                 return $data['name'];
            })
        ->addColumn('photo', function ($queryproduct) {
      
            $images = Product::find($queryproduct->id)->getMedia('products');

                if(count($images)>0)
                {
                    $image_url = $images[0]->getUrl();
                    return "<img height=70 width=70 src='$image_url'/>"; 
                }
                else
                {
                    return "<img height=70 width=70 src='../img/no-photo.png'/>"; 
                }          
            })

        ->addColumn('inout', function ($queryproduct) {
                
            $data = '<a href="inventories/show/'.$queryproduct->id.'" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list"></i></a>';
               return $data;    
               })

        ->addColumn('option', function ($queryproduct) {
           if(Auth::user()->hasPermission("update-product") || Auth::user()->hasPermission("delete-product"))
          {
            if(Auth::user()->hasPermission("update-product") && Auth::user()->hasPermission("delete-product"))
              {
                $data = '<div class="btn-group">             
                <a href="#" class="btn btn-default">Option</a>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>           
                <ul class="dropdown-menu">
                    <li><a href="products/'.$queryproduct->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                    <li><a href="#" class="_delete" data-rowid='.$queryproduct->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    
                </ul>
                </div>';
              }
           else if(Auth::user()->hasPermission("update-product"))
            {
               $data = '<div class="btn-group">             
                <a href="#" class="btn btn-default">Option</a>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>           
                <ul class="dropdown-menu">
                    <li><a href="products/'.$queryproduct->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li> 
                </ul>
                </div>';
            }
          else if(Auth::user()->hasPermission("delete-product"))
            {
               $data = '<div class="btn-group">             
                <a href="#" class="btn btn-default">Option</a>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>           
                <ul class="dropdown-menu">
                    <li><a href="#" class="_delete" data-rowid='.$queryproduct->id.' data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash delete-btn"></i> Delete</a></li>
                    
                </ul>
                </div>';
            }

          return $data;
        }               
               
            })
        
        ->rawColumns(['photo','inout','option'])        
        ->make(true); 
    }

    public function create()
    {
         if(Auth::user()->hasPermission("create-product")){
            $categories = Category::select('name', 'id')->where('is_delete',0)->get(); 
            return view('adminlte::product.create', compact('categories'));
        }else
        {
             return redirect()->route('home');
        }
    }

    public function store(StoreProduct $request)
    {
        $product = Product::create($request->input());
        $photoName = 'product' . $product->id ; 
        $photo = $request->file('photo');
            if(!empty($photo))
            {
                $product ->addMedia($photo)
                         ->usingName($photoName)
                         ->toMediaCollection('products'); 
             }

              //Inventory Process
            if(!empty($request->input('quantity')))
            {  
                 $inventory_data = [
                                    'product_id'  => $product->id,
                                    'user_id'     => Auth::user()->id,
                                    'in_out_qty'  => $request->input('quantity'),
                                    'remarks'     => 'Add Qty from Product',
                                    ];
             Inventory::create($inventory_data);
            }

        Session::flash('message', 'You have successfully added Product.');
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
         if(Auth::user()->hasPermission("update-product"))
         {
             $product = Product::FindOrFail($id);

             $categories = Category::select('name', 'id')->where('is_delete',0)->get(); 
             return view('adminlte::product.edit',compact('product','categories'));
         }else
         {
            return redirect()->route('home');
         }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'           => 'required',
            // 'code'           => 'required',
            'purchase_price' => 'numeric|min:0',
            'retail_price'   => 'numeric|min:0',
            'quantity'       => 'numeric|min:1',            
            'category_id'    => 'required'
      ]);
        
        $product = Product::find($id);

        //Update photo
        $photoName = 'product' . $product->id ; 
        $photo = $request->file('photo');
            if(!empty($photo))
            {
                DB::table('media')->where('name', $photoName)->delete();
                $product ->addMedia($photo)
                         ->usingName($photoName)
                         ->toMediaCollection('products'); 
             }

        //Inventory Process       
        $inventory_data = [
                            'product_id'  => $product->id,
                            'user_id'     => Auth::user()->id,
                            'in_out_qty'  => $request->input('quantity') - $product->quantity,
                            'remarks'     => 'Edit Qty from Product',
                            ];
        Inventory::create($inventory_data);

        Product::findOrFail($id)->update($request->all());       
        
        Session::flash('message', 'You have successfully updated Product.');       
        return redirect()->route('products.index'); 
    }

    public function destroy()
    {
        if(Auth::user()->hasPermission("delete-product"))
         {
            // try
            // {
                // $id = $_POST["data-rowid"];        
                // Product::destroy($id);
                // Session::flash('message', 'You have successfully deleted Product.');
                // return redirect()->route('products.index');
            // }
            // catch(\Illuminate\Database\QueryException $e)
            // {
            //     Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            //     Session::flash('alert-class', 'alert-danger');
            //     return redirect()->route("products.index");
            // }

             $id = $_POST["data-rowid"];        
             $product = Product::findOrFail($id);
                if($product) {
                $product->is_delete = 1;
                $product->save();
                }
                Session::flash('message', 'You have successfully deleted Product.');
                return redirect()->route('products.index');
        }
        else
        {
            //Session::flash('message', 'Unauthorized Access!');   
            return redirect()->route('home');
        }
        
    }
}
