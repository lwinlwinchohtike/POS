<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SaleLoadController extends Controller
{
    public function __construct() {
        $this->middleware("auth");       
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
            }
            else
            {
               $session_data = array();                         
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
