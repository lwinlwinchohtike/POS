@extends('adminlte::layouts.auth')

@section('content')
<div class="container-fluid">
  <div class="text-center">
    <h2 id='pd'>Purchase Detail Information</h2>
  </div>
  <div class="row">
    <div class="col-sm-2">    
    </div>
    <div class="col-sm-8">
      <div class="panel panel-default text-center">
	       <br/> 
         <!-- <form class="form-horizontal">
         <fieldset> -->
	       <table class="table">
	       <tr class="text-left"><td><b> Purchase Date </b></td><td>{{ $purchase->created_at }}</td></tr>
	       <tr class="text-left"><td><b> Employee    </b></td><td>{{ $purchase->user->name }}</td></tr>
	       <tr class="text-left"><td><b> Customer </b></td><td>{{ $purchase->supplier->suppliername }}</td></tr>
	       <tr class="text-left"><td><b> Payment </b></td><td>{{ $purchase->payment->name }}</td></tr>
	       <tr class="text-left"><td><b> Comment </b></td><td>{{ $purchase->comments }}</td></tr>	      
	       </table>       
	     
	        
	        <table class="table">
                    <tr>                    
                     <th class="text-center">Product</th>
                     <th class="text-center">Qty</th>
                     <th class="text-center">Price</th>
                     <th class="text-center">Total</th>
                   </tr>
                   <tbody> 
                                                       
                    @foreach($purchase_product as $pp)
                    <tr> 
                     <td>{{ $pp->product->name }}</td>
                     <td>{{ $pp['quantity'] }}</td>
                     <td>{{ $pp['purchase_price'] }}</td>
                     <td>{{ $pp['total_purchase'] }}</td>
                     </tr>
                   @endforeach
                            
                 </tbody>
                 <tfoot>
                 	<tr>
                 	<td><b>{{DB::table('purchase_products')->where('purchase_id', $purchase->id)->count('product_id')}} product(s)</b></td>
                 	<td><b>{{DB::table('purchase_products')->where('purchase_id', $purchase->id)->sum('quantity')}}</b></td>
                 	<td><b>Total Purchase </b></td>
                 	<td><b> ( {{DB::table('purchase_products')->where('purchase_id', $purchase->id)->sum('total_purchase')}} ) Ks</b></td>
                  </tr>
                 </tfoot> 
            </table>           
	       <hr> 
        <!--  </fieldset>
         </form>    -->  
        
      </div>
       <div class="col-md-4"><a href="{{ route('purchasereportbydate.index') }}" class="btn btn-success btn-block" id='go_purchase'><span class="glyphicon glyphicon-chevron-left"></span>Go Back to Purchase Report</a></div>
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
#pd { visibility: hidden; }
#go_purchase { visibility: hidden; }
#print_report { visibility: hidden; }
}
</style>
@endsection