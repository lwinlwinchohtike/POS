@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">  
					<div class="panel panel-default">
						<div class="panel-heading"><span class="glyphicon glyphicon-check"></span> Product Tracking </div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<input type='hidden' name='product-id' id='product-id' value=" {{ $products->id }} "/>
									<table class="table">
										<tr><td class="col-lg-3"><b> Code </b></td><td> [ {{ $products->code }} ] </td></tr>
										<tr><td class="col-lg-3"><b> Product </b></td><td>{{ $products->name }}</td></tr>
										<tr><td class="col-lg-3"><b> Purchase Price </b></td><td>{{ $products->purchase_price }} Ks</td></tr>
										<tr><td class="col-lg-3"><b> Retail Price </b></td><td>{{ $products->retail_price }} Ks</td></tr>
										<tr><td class="col-lg-3"><b> Quantity </b></td><td>{{ $products->quantity }}</td></tr>
										<tr><td class="col-lg-3"><b> Description </b></td><td>{{ $products->description }}</td></tr>
									</table> 
									<hr>
									 @if(Auth::user()->hasPermission("view-product-tracking"))								
									<table class="table table-hover" id="dt_products">                                  
                 					 </table>
                 					 @endif

                 					 <a href="{{ route('products.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>


									
								</div><!--col-md-12-->

							</div><!--row -->
						</div><!--panel-body -->
					</div><!--panel-default -->
				</div>      
			</div>
		</div>
	</div>
</div>



@endsection

@push('scripts')
<script>
   $(document).ready(function(){  

      	var product_id =  $('#product-id').val();   
      	//alert(product_id);

        $.get("{{ url('/backend/inventories/databyproductID') }}",
        {
        	p_id : product_id
        },
        function(data, status){
           //alert("Data: " + data + "\nStatus: " + status);

           var dataSet = $.parseJSON(data);
           
           $('#dt_products').DataTable( {
                       
                        data: dataSet,
                        columns: [                       
                        { title: "No." },
                        { title: "Event Date" }, 
                        { title: "Product" },
                        { title: "Qty(In/Out)" },
                        { title: "User" },
                        { title: "Remarks" },                          
                       
                        ]
                    });
           });
    });
</script>
@endpush