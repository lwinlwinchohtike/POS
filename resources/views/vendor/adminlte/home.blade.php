@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<!-- 	<div class="container-fluid spark-screen">
		<div class="row">
		<div id="page-wrapper">
         <div class="row">
          <div class="col-lg-12">        
            <div class="panel panel-">
              <div class="panel-heading"><i class="fa fa-dashboard"></i> Dashboard Statistics Overview</div>
              <div class="panel-body"> -->

 <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
 
      <h1>
        Dashboard
        <small>Statistics Overview</small>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
     <section class="content">

        <div class="row">                 
     <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <i><h4>POS</h4></i>
              <p>sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="sales" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

         <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <i><h4>{{ $customers }}</h4></i>
              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="customers" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <i><h4>Order</h4></i>

              <p>Purchase</p>
            </div>
            <div class="icon">
              <i class="fa fa-sign-in"></i>
            </div>
            <a href="purchase" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <i><h4>{{ $suppliers }}</h4></i>
              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-o"></i>
            </div>
            <a href="suppliers" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        </div>   <!-- ./row -->

   <div class="row">                 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <h3>{{ $products }}</h3>

              <p>Products</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="products" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-5 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3>{{ $sales }}</h3>
              <p>Sales Report</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="salesreportbydate" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3>{{ $purchase }}</h3>
              <p>Purchase Report</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="purchasereportbydate" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
       
        </div>

         <div class="row">                 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <i><h4>In/Out</h4></i>
              <p>Products</p>
            </div>
            <div class="icon">
            <i class="fa fa-check-square-o"></i>
            </div>
            <a href="inventories" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <i><h4>{{ $roles }}</h4></i>
              <p>Roles</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="roles" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <i><h4>{{ $users }}</h4></i>
              <p>Employee</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="users" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
             <i><h4>{{ $payments }}</h4></i>

              <p>Payments</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="payments" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
   
        </div>  

       
        </section>
        





       
@endsection

@push('scripts')

@endpush
