<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use DB;

class AllProductController extends Controller
{

    public function __construct() {
        $this->middleware("auth");       
    }
    
    public function data(Request $request)
    {
        $product_list = Product::select()->where('is_delete',0)->where('category_id', $request->category_id)->orderby('code')->get(); 

        foreach($product_list as &$pl)
        {
            $images = Product::find($pl->id)->getMedia('products');
            if(count($images)>0)
            {
                $image_url = $images[0]->getUrl();
                $pl->photo =  $image_url;
            }
            else
            {
                $pl->photo = '../img/no-photo.png';
            }

        }

        return json_encode(array('product_list'=>$product_list,'msg'=>''));    
    }

    public function selectdata(Request $request)
    {       
        $products = Product::select()->where('is_delete',0)->orderby('code')->get();  

        $product_list = array();  

         //$i = 0;                     
           foreach($products as $p)
         { 
            //$i++;
            $code = $p->code;
            $name = $p->name;

            $product_list[] = array($code,$name,"<button class='btn btn-success btn-sm _plist' type='button' id='$code' ><span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span></button>"
                );      
       }  

        return json_encode($product_list);  
    }

    public function allproductsdata()
    {
       $all_products = Product::select()->where('is_delete',0)->orderby('code')->get();
       
        foreach($all_products as &$pl)
        {
            $images = Product::find($pl->id)->getMedia('products');
            if(count($images)>0)
            {
                $image_url = $images[0]->getUrl();
                $pl->photo =  $image_url;
            }
            else
            {
                $pl->photo = '../img/no-photo.png';
            }

        }     
         return json_encode(array('all_products'=>$all_products,'msg'=>''));   
        
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
