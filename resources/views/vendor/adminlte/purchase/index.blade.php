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
          <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span> Purchase </div>
          <div class="panel-body">
            <div class="row">
             <div class="col-md-6">
               <div class="panel panel-default">              
                <div class="panel-body">                

                   <table class="table table-hover" id="dt_products">                                   
                  </table>

                </div><!--panel-body-->
              </div>
            </div><!--col-md-6-->
            <div class="col-md-6">             
              <div class="panel panel-default">
                <div class="panel-body">
              
                  <table class="table table-bordered table-hover table-striped">
                    <tr>
                     <!--  <th>No.</th> -->
                     <th>Bar Code</th>
                     <th>Product</th>
                     <th>Qty</th>
                     <th>Price</th>
                     <th>Total</th>                           
                     <th>&nbsp;</th>
                   </tr>
                   <tbody id="purchase_table"> 
                   
                    @if(is_array($session_data))                                                        
                    @foreach($session_data as $key => $value)
                    <tr>
                    
                     @foreach($value as $k => $v)
                     <td>{{$v}}</td> 
                     @endforeach 
                   
                     <td>
                       <a class="btn btn-danger btn-xs _delete" data-rowid="{{ $value['code'] }}" data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash"></i>
                       </a>
                     </td>                     
                   </tr>
                   @endforeach

                   @endif

                 </tbody> 
               </table>

               <label for="name" class="col-sm-6 control-label">Grand-Total </label>
               <div class="col-sm-6">                  
                 <div class="input-group">
                  <span class="input-group-addon">Ks</span>
                  <input type="text" class='form-control' name="grand_total" id="grand_total" readonly>
                </div>
              </div><!--GrandTotal --><br/><br/>

             <!--  <label for="name" class="col-sm-6 control-label">Commercial Tax:</label>
              <div class="col-sm-6">                  
               <div class="input-group">
                <span class="input-group-addon">Ks</span>
                <input type="text" class='form-control' value="0" name="tax" id="tax" readonly>
              </div>
            </div>
            <br/><br/> -->

            <label for="name" class="col-sm-6 control-label">Paid Amount</label>
            <div class="col-sm-6">                  
             <div class="input-group">
              <span class="input-group-addon">Ks</span>
              <input type="number" class="form-control" value="0" name="paid" id="paid">
            </div>
          </div><!--Paid --><br/><br/>

          <!-- <label for="name" class="col-sm-6 control-label">Return Change</label>
          <div class="col-sm-6">                  
           <div class="input-group">
             <span class="input-group-addon">Ks</span>
             <input type="text" class='form-control' name="change_amount" id="change_amount" readonly>
           </div>
         </div><br/><br/>
 -->
         <hr>

         <div class="col-md-6">
          <div class="form-group">
            <div class="col-sm-12">
              <!-- <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#myModalDelete">Discard Purchase</a> -->
              <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#myModalDelete"><span class="glyphicon glyphicon-remove"></span> Discard Purchase</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
         <div class="form-group">
          <div class="col-sm-12">
            <a class="btn btn-success pull-right _modalstore" data-toggle="modal" data-target="#myModalStore"><span class="fa fa-money"></span> Complete Purchase</a>
          </div>
        </div>

      </div><!--panel-body -->
    </div>            
  </div><!--col-md-6-->
</div><!--row -->
</div><!--panel-body -->
</div><!--panel-default -->
</div>      
</div>
</div>
</div>
</div>

<!-- Modal For Store Purchase -->
<div class="modal fade" id="myModalStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>             
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-money"></span> Payment</h4>
      </div>
      <form action="{{ route('purchase.store') }}" method="POST"> 
        {{ csrf_field() }}    

         <div class="modal-body"> 
           <div class="form-group">
              <label for="name" class="col-md-4 control-label">Supplier</label>
              <div class="col-md-8">
                      <select class="form-control" name="supplier_id" required>
                          @if($suppliers!=null)
                          @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->suppliername}}</option>
                          @endforeach 
                          @endif
                        </select>
              </div>
            </div><br/><br/>

            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Payment</label>
              <div class="col-md-8">
                      <select class="form-control" name="payment_id" required>
                             @if($payments!=null)
                             @foreach($payments as $payment)
                             <option value="{{$payment->id}}">{{$payment->name}}</option>
                             @endforeach 
                             @endif
                           </select>
              </div>
            </div><br/><br/>

             <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Grand Total</label>
            <div class="col-lg-8">
            <div class="input-group">  
              <input type="text" class='form-control' name="modal_total" id="modal_total" readonly>
              <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>


           <!--  <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Commercial Tax</label>
            <div class="col-lg-8">
            <div class="input-group">  
              <input type="text" class='form-control' name="modal_tax" id="modal_tax" readonly>
              <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>
 -->
           <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Paid Amount</label>
            <div class="col-lg-8">
              <div class="input-group">             
              <input type="text" class='form-control' name="modal_paid" id="modal_paid" readonly 
              >
               <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>

          <!--   <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Change Return</label>
            <div class="col-lg-8">
             <div class="input-group">  
              <input type="text" class='form-control' name="modal_change" id="modal_change" readonly>
              <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/> -->

          <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Comments</label>
            <div class="col-lg-8">
               <textarea class="form-control" name="comments" id="comments" rows="2"></textarea>
            </div>
          </div><br/><br/>  
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value='Confirm'/>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal For Remove purchase -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form action="{{ route('purchase.discard') }}" method="POST"> 
    {{ csrf_field() }}       
    <!-- <input type='hidden' name='data-rowid' value="1" id="del_id"/>  -->
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>             
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Discard Purchase</h4>
      </div>

      <div class="modal-body">   
        Are you sure you want to discard?            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-danger" value='Discard'/>
      </div>
    </form>
  </div>
</div>
</div>

@endsection

@push('scripts')
<script>
	$(document).ready(function(){ 

  	//PageLoad
  	$.get("{{ url('/backend/purchaseload/data') }}",
  	{

  	},
  	function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                var json = $.parseJSON(data);
                 //alert(json);
                 if(json.msg=="")
                 {
                 	$('#paid').val(0);
                 	$('#change_amount').val("");
                 	$("#purchase_table").html();
                 	var html = "";
                 	$.each(json.purchase_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];


                      html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="text-align:center" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                  });
                 	$("#purchase_table").html(html);

                 	var grand_total = json.grand_total;
                 	$('#grand_total').val(grand_total); 

                 	// $('#paid').keyup(function(){
                 	// 	var paid = $('#paid').val();
                 	// 	var change_amount = paid - grand_total;
                 	// 	$('#change_amount').val(change_amount);

                 	// });


                 	$('._modalstore').click(function(){

                 		var grand_total = $('#grand_total').val();
                 		var paid_amount = $('#paid').val();

                 		if(grand_total == 0 || grand_total == "")
                 		{                       
                 			swal({
                 				title: "",
                 				text: "Please add products to the List!!!",
                 				type: "warning"

                 			});  
                 		$("._modalstore").attr('data-toggle','');                   
                       		                 
                   		}
	                   if(paid_amount == "" || paid_amount == 0 || paid_amount < 0)
	                   {
		                   	swal({
		                   		title: "",
		                   		text: "Please check Paid Amount!",
		                   		type: "warning"

		                   		});
		                   	$("._modalstore").attr('data-toggle','');
	                    }
                    else{
                    	$("._modalstore").attr('data-toggle','modal');
                    	}
                });                

                 }
                 else
                 {
                  //alert(json.msg);
                  swal({
                  	title: "",
                  	text: json.msg,
                  	type: "warning"

                  });
              }

          }); 

 	//Quantity KeyUp 

 	$('#purchase_table').on('keyup','._qty',function(){            
 		var productcode=$(this).attr('data-code');
 		var qty =$(this).val();
                    //alert(qty);

                    if(isNaN(qty) || qty <= 0)
                    {
                    	swal({
                    		title: "",
                    		text: "Quantity must have an correct Amount!",
                    		type: "warning"

                    	});
                    	var qty =$(this).val(1);
                    }

                    $.get("{{ url('/backend/purchasequaltity/data') }}",
                    {
                    	code: productcode ,
                    	qty : qty              
                    },
                    function(data, status){
                    //alert("Data: " + data + "\nStatus: " + status);
                    var json = $.parseJSON(data);
                     //alert(json);
                     if(json.msg=="")
                     {
                     	$('#paid').val(0);
                     	$('#change_amount').val("");
                     	$("#purchase_table").html();
                     	var html = "";
                     	$.each(json.purchase_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];


                      html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="text-align:center" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                  });
                     	$("#purchase_table").html(html);

                     	var grand_total = json.grand_total;
                     	$('#grand_total').val(grand_total); 

                     	$('#paid').keyup(function(){
                     		var paid = $('#paid').val();
                     		var change_amount = paid - grand_total;
                     		$('#change_amount').val(change_amount);

                     	});


                     	$('._modalstore').click(function(){

                 		var grand_total = $('#grand_total').val();
                 		var paid_amount = $('#paid').val();

                 		if(grand_total == 0 || grand_total == "")
                 		{                       
                 			swal({
                 				title: "",
                 				text: "Please add products to the List!",
                 				type: "warning"

                 			});  
                 			$("._modalstore").attr('data-toggle','');                   
                       		//alert("Please add products to the List!");                      
                   		}
	                   if(paid_amount == "" || paid_amount == 0 || paid_amount < 0)
	                   {
		                   	swal({
		                   		title: "",
		                   		text: "Please check Paid Amount!",
		                   		type: "warning"

		                   		});
		                   	$("._modalstore").attr('data-toggle','');  
		                        //alert("Please check Change Amount!");
	                    }
                    else{
                    	$("._modalstore").attr('data-toggle','modal');
                    	}
                });                

                     }else
                     {
                    //alert(json.msg);
                    swal({
                    	title: "",
                    	text: json.msg,
                    	type: "warning"

                    });
                }
            }); 
                }); 

  	//add to list
  	$("#productcode").keyup(function(e){        
  		if(e.keyCode == 13)
  		{
  			var productcode = $('#productcode').val();
            //alert (productcode);
            $.get("{{ url('/backend/purchase/data') }}",
            {
            	code: productcode               
            },
            function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                var json = $.parseJSON(data);
                 //alert(json);
                 if(json.msg=="")
                 {
                 	$('#paid').val(0);
                 	$('#change_amount').val("");
                 	$("#purchase_table").html();
                 	var html = "";
                 	$.each(json.purchase_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];

                      html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="text-align:center"  class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                  });
                 	$("#purchase_table").html(html);

                 	var grand_total = json.grand_total;
                 	$('#grand_total').val(grand_total); 



                 	$('#paid').keyup(function(){
                 		var paid = $('#paid').val();
                 		var change_amount = paid - grand_total;
                 		$('#change_amount').val(change_amount);
                 	});


                 	$('._modalstore').click(function(){

                 		var grand_total = $('#grand_total').val();
                 		var paid_amount = $('#paid').val();

                 		if(grand_total == 0 || grand_total == "")
                 		{                       
                 			swal({
                 				title: "",
                 				text: "Please add products to the List!",
                 				type: "warning"

                 			});  
                 			$("._modalstore").attr('data-toggle','');                   
                       		//alert("Please add products to the List!");                      
                   		}
	                   if(paid_amount == "" || paid_amount == 0 || paid_amount < 0)
	                   {
		                   	swal({
		                   		title: "",
		                   		text: "Please check Paid Amount!",
		                   		type: "warning"

		                   		});
		                   	$("._modalstore").attr('data-toggle','');  
		                        //alert("Please check Change Amount!");
	                    }
                    else{
                    	$("._modalstore").attr('data-toggle','modal');
                    	}
                });                

                 }
                 else
                 {
                  //alert(json.msg);
                  swal({
                  	title: "",
                  	text: json.msg,
                  	type: "warning"

                  });
              }


          });
        }
    }); 

        //delete from List
        $('#purchase_table').on('click','._delete',function(){            
        	var removecode=$(this).attr('data-rowid');

        	$.get("{{ url('/backend/purchase/remove') }}",
        	{
        		pcode: removecode               
        	},
        	function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                var json = $.parseJSON(data);                 
                if(json.msg=="")
                {
                	$('#paid').val(0);
                	$('#change_amount').val("");
                	$("#purchase_table").html();
                	var html = "";

                	$.each(json.purchase_table,function(index,value){

                		var code = value['code'];
                		var name = value['name'];
                		var quantity = value['quantity'];
                		var price = value['price'];
                		var total = value['total'];


                		html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="text-align:center" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                	});


                	$("#purchase_table").html(html);

                	var grand_total = json.grand_total;
                	$('#grand_total').val(grand_total); 

                	$('#paid').keyup(function(){
                		var paid = $('#paid').val();
                		var change_amount = paid - grand_total;
                		$('#change_amount').val(change_amount);

                	});


                	$('._modalstore').click(function(){

                 		var grand_total = $('#grand_total').val();
                 		var paid_amount = $('#paid').val();

                 		if(grand_total == 0 || grand_total == "")
                 		{                       
                 			swal({
                 				title: "",
                 				text: "Please add products to the List!",
                 				type: "warning"

                 			});  
                 			$("._modalstore").attr('data-toggle','');                   
                       		//alert("Please add products to the List!");                      
                   		}
	                   if(paid_amount == "" || paid_amount == 0 || paid_amount < 0)
	                   {
		                   	swal({
		                   		title: "",
		                   		text: "Please check Paid Amount!",
		                   		type: "warning"

		                   		});
		                   	$("._modalstore").attr('data-toggle','');  
		                        //alert("Please check Change Amount!");
	                    }
                    else{
                    	$("._modalstore").attr('data-toggle','modal');
                    	}
                });                
                }
                else
                {
                //alert(json.msg);
                swal({
                	title: "",
                	text: json.msg,
                	type: "warning"

                });
            }
        });
        });

         $('._modalstore').click(function(){       

        var grand_total = $('#grand_total').val();
        var paid = $('#paid').val();
       
        $('#modal_total').val(grand_total); 
        $('#modal_paid').val(paid); 
       
      });


        //Select all products
        $.get("{{ url('/backend/purchase/allproducts') }}",
        {

        },
        function(data, status){
           //alert("Data: " + data + "\nStatus: " + status);

           var dataSet = $.parseJSON(data);

           if($.fn.DataTable.isDataTable("#dt_products")) 
           {
           	$('#dt_products').DataTable().clear().destroy();               
           }
           $('#dt_products').DataTable( {
                        //"bDestroy" :true ,
                        data: dataSet,
                        columns: [                       
                        { title: "Code" },
                        { title: "Name" },                           
                        { title: "" , orderable: false, searchable: false }
                        ]
                    });

           $('#dt_products').dataTable().on('click','._plist',function(){
           	var productcode=$(this).attr('id');
           	$.get("{{ url('/backend/purchase/data') }}",
           	{
           		code: productcode                
           	},
           	function(data, status){
           		var json = $.parseJSON(data);

           		if(json.msg=="")
           		{
           			$('#paid').val(0);
           			$('#change_amount').val("");
           			$("#purchase_table").html();
           			var html = "";
           			$.each(json.purchase_table,function(index,value){

                                                //alert(value['code']);
                                                var code = value['code'];
                                                var name = value['name'];
                                                var quantity = value['quantity'];
                                                var price = value['price'];
                                                var total = value['total'];


                                                html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="text-align:center" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                                            });
           			$("#purchase_table").html(html);

           			var grand_total = json.grand_total;
           			$('#grand_total').val(grand_total); 

           			$('#paid').keyup(function(){
           				var paid = $('#paid').val();
           				var change_amount = paid - grand_total;
           				$('#change_amount').val(change_amount);


           			});


           			$('._modalstore').click(function(){

                 		var grand_total = $('#grand_total').val();
                 		var paid_amount = $('#paid').val();

                 		if(grand_total == 0 || grand_total == "")
                 		{                       
                 			swal({
                 				title: "",
                 				text: "Please add products to the List!",
                 				type: "warning"

                 			});  
                 			$("._modalstore").attr('data-toggle','');                   
                       		//alert("Please add products to the List!");                      
                   		}
	                   if(paid_amount == "" || paid_amount == 0 || paid_amount < 0)
	                   {
		                   	swal({
		                   		title: "",
		                   		text: "Please check Paid Amount!",
		                   		type: "warning"

		                   		});
		                   	$("._modalstore").attr('data-toggle','');  
		                        //alert("Please check Change Amount!");
	                    }
                    else{
                    	$("._modalstore").attr('data-toggle','modal');
                    	}
                });                

           		}
           		else
           		{
                      //alert(json.msg);
                      swal({
                      	title: "",
                      	text: json.msg,
                      	type: "warning"

                      });
                  }

              });


           });  


       });

});
</script>
@endpush