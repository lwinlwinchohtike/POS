@extends('adminlte::layouts.auth')

@section('content')
<div class="container-fluid">
  <div class="text-center">
    <h2 id='sv'>Sales Voucher</h2>
  </div>
  <div class="row">
    <div class="col-sm-3">    
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default text-center">
       <br/>
         <p>GTwo SuperCenter</p>
         <p>Phone: 01-123456 , 651240</p>
         <p>Open Daily : 9:00 AM to 9:00 PM</p>
        <div class="col-md-6 text-left">Sale ID &nbsp; &nbsp;: SALE {{ $sale_product->sale_id }}</div>
        <div class="col-md-6 text-right"> {{ $sale_product->updated_at }}</div><br/>
        <div class="col-md-6 text-left">Customer: {{ $sales->customer->name }}</div>
        <div class="col-md-6 text-right">Cashier: {{ $sales->user->name }}</div><br/>
         <div class="col-md-6 text-left">Payment : {{ $sales->payment->name }}</div><br/>
        <div class="panel-body">
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
                     <td>{{ $value['total'] }}</td>
                     </tr>
                   @endforeach
                   @endif              
                 </tbody> 
            </table>
        </div>
       <hr>  
        @if(is_array($sale_data[0]))                                                    
                 
          <label for="name" class="col-lg-8 control-label text-left">Grand-Total(Inclusive Tax)</label>
          <label for="name" class="col-lg-4 control-label text-right">{{ $sale_data[0]['grand_total'] }} Ks</label> <br/>  
          <label for="name" class="col-lg-8 control-label text-left">Commercial Tax:</label>
          <label for="name" class="col-lg-4 control-label text-right">{{ $sale_data[0]['tax'] }} Ks</label> <br/> 
          <label for="name" class="col-lg-8 control-label text-left">Paid:</label>
          <label for="name" class="col-lg-4 control-label text-right">{{ $sale_data[0]['paid'] }} Ks</label> <br/>  
          <label for="name" class="col-lg-8 control-label text-left">Return Change:</label>
          <label for="name" class="col-lg-4 control-label text-right">{{ $sale_data[0]['return_change'] }} Ks</label> <br/>        
         
          @endif    
        <hr> 
         <p>"Thank You"</p>         
      </div>
       <a href="{{ route('sales.index') }}" class="btn btn-warning btn-block" id='go_sales'><span class="glyphicon glyphicon-chevron-left"></span>Go Back to New Sales</a><br/><br/>
    </div>

   <div class="col-sm-3">
      
    </div>
  </div>
</div>



@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show
<script>
  $(document).ready(function(){
    window.print();
  });
</script>

<style type="text/css">
@media print
{
#sv { visibility: hidden; }
#go_sales { visibility: hidden; }
}
</style>
@endsection