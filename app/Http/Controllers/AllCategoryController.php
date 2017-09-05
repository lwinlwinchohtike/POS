<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class AllCategoryController extends Controller
{

    public function __construct() {
        $this->middleware("auth");       
    }
    
    public function data()
    {
       $category_list = Category::select('name', 'id')->where('is_delete',0)->get();
       //echo"<pre>";print($category_list);exit;         
        return json_encode(array('category_list'=>$category_list,'msg'=>''));   
        
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
