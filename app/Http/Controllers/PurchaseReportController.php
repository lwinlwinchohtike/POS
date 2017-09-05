<?php
# llchtike #
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{

    public function __construct() {
        $this->middleware("auth");       
    }
   
    public function index()
    {        
           return view ('adminlte::report.purchase');
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
