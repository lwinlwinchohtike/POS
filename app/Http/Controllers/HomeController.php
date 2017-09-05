<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */
# llchtike #
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User, App\Role;
use App\Product, App\Customer, App\Supplier, App\Sale, App\Purchase, App\Payment;
use DB;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::where('is_delete',0)->count();       
        $customers = Customer::where('is_delete',0)->count();
        $sales = Sale::count();
        $purchase = Purchase::count();
        $suppliers = Supplier::where('is_delete',0)->count();
        $roles = Role::count();
        $users = User::where('is_delete',0)->count();
        $payments = Payment::where('is_delete',0)->count();
        return view('adminlte::home',compact('products','roles','users','customers','sales','purchase','suppliers','payments'));
    }


}