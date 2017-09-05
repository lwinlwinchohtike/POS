@extends('adminlte::layouts.auth')

@section('content')
<div class="container-fluid">
  <div class="text-center">
    <h2 id='sd'>Sales Detail Information</h2>
  </div>
  <div class="row">
    <div class="col-sm-2">    
    </div>
    <div class="col-sm-8">
      <div class="panel panel-default text-center">
	       <br/> 
	       <table class="table">
	       <tr class="text-left"><td><b> Sales Date </b></td><td>{{ $sales->created_at }}</td></tr>
	       <tr class="text-left"><td><b> Cashier    </b></td><td>{{ $sales->user->name }}</td></tr>
	       <tr class="text-left"><td><b> Customer </b></td><td>{{ $sales->customer->name }}</td></tr>
	       <tr class="text-left"><td><b> Payment </b></td><td>{{ $sales->payment->name }}</td></tr>
	       <tr class="text-left"><td><b> Comment </b></td><td>{{ $sales->comments }}</td></tr>
	       <tr class="text-left"><td><b> Profit </b></td><td><b>( {{DB::table('sale_products')->where('sale_id', $sales->id)->sum('total_retail') - DB::table('sale_products')->where('sale_id', $sales->id)->sum('total_purchase')}} ) Ks</b></td></tr>
	       </table>       
	     
	        
	        <table class="table">
                    <tr>                    
                     <th class="text-center">Product</th>
                     <th class="text-center">Qty</th>
                     <th class="text-center">Price</th>
                     <th class="text-center">Total</th>
                   </tr>
                   <tbody> 
                                                       
                    @foreach($sales_product as $sp)
                    <tr> 
                     <td>{{ $sp->product->name }}</td>
                     <td>{{ $sp['quantity'] }}</td>
                     <td>{{ $sp['retail_price'] }}</td>
                     <td>{{ $sp['total_retail'] }}</td>
                     </tr>
                   @endforeach
                            
                 </tbody>
                 <tfoot>
                 	<tr>
                 	<td><b>{{DB::table('sale_products')->where('sale_id', $sales->id)->count('product_id')}} product(s)</b></td>
                 	<td><b>{{DB::table('sale_products')->where('sale_id', $sales->id)->sum('quantity')}}</b></td>
                 	<td><b>Grand Total </b></td>
                 	<td><b> ( {{DB::table('sale_products')->where('sale_id', $sales->id)->sum('total_retail')}} ) Ks</b></td></tr>
                 </tfoot> 
            </table>           
	       <hr>      
        
      </div>
       <div class="col-md-4"><a href="{{ route('salesreportbydate.index') }}" class="btn btn-primary btn-block" id='go_sales'><span class="glyphicon glyphicon-chevron-left"></span>Go Back to Sales Report</a></div>
        <div class="col-md-4"></div>
         <div class="col-md-4"><a class="btn btn-warning btn-block" id='print_report'><span class="glyphicon glyphicon-print"></span> Print Report</a></div>
       
    </div>

   <div class="col-sm-2">
      
    </div>
  </div>
</div>


@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show
<script>
  $(document).ready(function(){

  	$('#print_report').click(function(){
         window.print();
		});
  });
</script>

<style type="text/css">
@media print
{
#sd { visibility: hidden; }
#go_sales { visibility: hidden; }
#print_report { visibility: hidden; }
}
</style>
@endsection