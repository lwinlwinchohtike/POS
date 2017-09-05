@extends('adminlte::layouts.auth')

@section('content')
<div class="container-fluid">
  <div class="text-center">
    <h2 id='pv'>Purchase Voucher</h2>
  </div>
  <div class="row">
    <div class="col-sm-2">    
    </div>
    <div class="col-sm-8">
      <div class="panel panel-default text-center">

     <!--  compact('purchase','session_data','purchase_product','purchase_data') -->
       <br/>
         <p>GTwo SuperCenter</p>
         <p>Phone: 01-123456 , 651240</p>
         <p>Open Daily : 9:00 AM to 9:00 PM</p><hr>
       
		 <table class="table">
	       <tr class="text-left"><td><b> Sales Date </b></td><td>{{ $purchase->created_at }}</td></tr>
	       <tr class="text-left"><td><b> Employee    </b></td><td>{{ $purchase->user->name }}</td></tr>
	       <tr class="text-left"><td><b> Supplier </b></td><td>{{ $purchase->supplier->suppliername }}</td></tr>
	       <tr class="text-left"><td><b> Payment </b></td><td>{{ $purchase->payment->name }}</td></tr>	      
	       </table> 
          <table class="table">
                    <tr>                    
                     <th class="text-center">Product</th>
                     <th class="text-center">Qty</th>
                     <th class="text-center">Price</th>
                     <th class="text-center">Total</th>
                   </tr>
                   <tbody> 
                  @if(is_array($session_data))                                                        
                    @foreach($session_data as $key => $value)
                    <tr> 
                     <td>{{ $value['name'] }}</td>
                     <td>{{ $value['quantity'] }}</td>
                     <td>{{ $value['price'] }}</td>
                     <td> {{ $value['total'] }} </td>
                     </tr>
                   @endforeach
                   @endif              
                 </tbody>
                 <tfoot>
                  @if(is_array($purchase_data[0])) 
                 	<tr> 
                 		<td></td>   
                 		<td></td>                	     
                 		<td><b>Grand-Total</b></td>
                 		<td>( {{ $purchase_data[0]['grand_total'] }} ) Ks</td>
                 		<td></td>                 	
                 	</tr>
                 	<tr> 
                 		<td></td> 
                 		<td></td>                	     
                 		<td><b>Paid Amount</b></td>
                 		<td>( {{ $purchase_data[0]['paid'] }} ) Ks</td>
                 		<td></td>                 	
                 	</tr>
                 	@endif 
                 </tfoot> 
            </table>  
      </div>
        <div class="col-md-4"><a href="{{ route('purchase.index') }}" class="btn btn-success btn-block" id='go_purchase'><span class="glyphicon glyphicon-chevron-left"></span>Go Back to New Purchase</a></div>
        <div class="col-md-4"></div>
         <div class="col-md-4"><a class="btn btn-warning btn-block" id='print_pr'><span class="glyphicon glyphicon-print"></span> Print Purchase Voucher</a></div>
    </div>

   <div class="col-sm-8">
      
    </div>
  </div>
</div>



@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show
<script>
  $(document).ready(function(){
    $('#print_pr').click(function(){
         window.print();
		});
  });
</script>

<style type="text/css">
@media print
{
#pv { visibility: hidden; }
#go_purchase { visibility: hidden; }
#print_pr { visibility: hidden; }
}
</style>
@endsection