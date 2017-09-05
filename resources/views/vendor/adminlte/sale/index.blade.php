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
          <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span> Sales </div>
          <div class="panel-body">
            <div class="row">
             <div class="col-md-6">
               <div class="panel panel-default">              
                <div class="panel-body"> 
                  <div id="gridview" class="row">   

                  </div>
                </div><!--panel-body-->
              </div>
            </div><!--col-md-6-->
            <div class="col-md-6">             
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group">
                  <div class="input-group">  
                  <div class="input-group-addon">
                    <i class="fa fa-barcode"></i>
                  </div>               
                    <input type="text" class="form-control" id="productcode" placeholder="Please Scan the Product Bar code" />                     
                    </div>
                  </div>
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
                   <tbody id="sales_table"> 
                    <!-- <?php $i=1;?> -->
                    @if(is_array($session_data))                                                        
                    @foreach($session_data as $key => $value)
                    <tr>
                     <!--  <td><?= $i++?></td>   -->
                     @foreach($value as $k => $v)
                     <td>{{$v}}</td> 
                     @endforeach 
                    <!--  <td>{{ $value['code'] }}</td>
                     <td>{{ $value['name'] }}</td>
                    <td>
                    <input type='button' value='-' class='qtyminus' field='quantity' />
                    <input type='text' name='quantity' value="{{ $value['quantity'] }}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='quantity' />
                    </td>
                     <td>{{ $value['price'] }}</td>
                     <td>{{ $value['total'] }}</td> -->
                     <td>
                       <a class="btn btn-danger btn-xs _delete" data-rowid="{{ $value['code'] }}" data-toggle="modal" data-target="#myModalDelete"><i class="glyphicon glyphicon-trash"></i>
                       </a>
                     </td>                     
                   </tr>
                   @endforeach

                   @endif

                 </tbody> 
               </table>

               <label for="name" class="col-sm-6 control-label">Grand-Total (Inclusive Tax)</label>
               <div class="col-sm-6">                  
                 <div class="input-group">
                  <span class="input-group-addon">Ks</span>
                  <input type="text" class='form-control' name="grand_total" id="grand_total" readonly>
                </div>
              </div><!--GrandTotal --><br/><br/>

              <label for="name" class="col-sm-6 control-label">Commercial Tax:</label>
              <div class="col-sm-6">                  
               <div class="input-group">
                <span class="input-group-addon">Ks</span>
                <input type="text" class='form-control' value="0" name="tax" id="tax" readonly>
              </div>
            </div><!--Tax --><br/><br/>

            <label for="name" class="col-sm-6 control-label">Paid</label>
            <div class="col-sm-6">                  
             <div class="input-group">
              <span class="input-group-addon">Ks</span>
              <input type="number" class="form-control" value="0" name="paid" id="paid">
            </div>
          </div><!--Paid --><br/><br/>

          <label for="name" class="col-sm-6 control-label">Return Change</label>
          <div class="col-sm-6">                  
           <div class="input-group">
             <span class="input-group-addon">Ks</span>
             <input type="text" class='form-control' name="change_amount" id="change_amount" readonly>
           </div>
         </div><!--Return --><br/><br/><hr>

         <div class="col-md-6">
          <div class="form-group">
            <div class="col-sm-12">
              <!-- <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#myModalDelete">Discard Sales</a> -->
              <a href="#" class="btn btn-danger pull-left" data-toggle="modal" data-target="#myModalDelete"><span class="glyphicon glyphicon-remove"></span> Discard Sales</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
         <div class="form-group">
          <div class="col-sm-12">
            <a class="btn btn-primary pull-right _modalstore" data-toggle="modal" data-target="#myModalStore"><span class="fa fa-money"></span> Complete Sales</a>
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

<!-- Modal For Store Sales -->
<div class="modal fade" id="myModalStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>             
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-money"></span> Payment</h4>
      </div>
      <form action="{{ route('sales.store') }}" method="POST"> 
        {{ csrf_field() }}    

         <div class="modal-body"> 
           <div class="form-group">
              <label for="name" class="col-md-4 control-label">Customer</label>
              <div class="col-md-8">
                      <select class="form-control" name="customer_id" required>
                          @if($customers!=null)
                          @foreach($customers as $customer)
                          <option value="{{$customer->id}}">{{$customer->name}}</option>
                          @endforeach 
                          @endif
                        </select>
              </div>
            </div><br/><br/>

            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Payment</label>
              <div class="col-md-8">
               <!-- <div class="input-group"> -->
                      <select class="form-control" name="payment_id" required>
                             @if($payments!=null)
                             @foreach($payments as $payment)
                             <option value="{{$payment->id}}">{{$payment->name}}</option>
                             @endforeach 
                             @endif
                           </select>
             
                    <!--  <div class="input-group-addon">
                      <span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a> 
                    </div> 
                    </div>-->
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


            <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Commercial Tax</label>
            <div class="col-lg-8">
            <div class="input-group">  
              <input type="text" class='form-control' name="modal_tax" id="modal_tax" readonly>
              <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>

           <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Paid</label>
            <div class="col-lg-8">
              <div class="input-group">             
              <input type="text" class='form-control' name="modal_paid" id="modal_paid" readonly 
              >
               <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>

            <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Change Return</label>
            <div class="col-lg-8">
             <div class="input-group">  
              <input type="text" class='form-control' name="modal_change" id="modal_change" readonly>
              <span class="input-group-addon">Ks</span>
              </div>
            </div>
          </div><br/><br/>

          <div class="form-group">
            <label for="name" class="col-lg-4 control-label">Comments</label>
            <div class="col-lg-8">
               <textarea class="form-control" name="comments" id="comments" rows="2"></textarea>
            </div>
          </div><br/><br/>  
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value='Confirm'/>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal For Remove sales -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form action="{{ route('sales.discard') }}" method="POST"> 
    {{ csrf_field() }}       
    <!-- <input type='hidden' name='data-rowid' value="1" id="del_id"/>  -->
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>             
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Discard Sales</h4>
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
      $.get("{{ url('/backend/salesload/data') }}",
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
                   $("#sales_table").html();
                   var html = "";
                  $.each(json.sales_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];
                    //alert (name);
                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td>'+quantity+'</td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                    // alert(html);

                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="button" value="-" style="width:25px;height:25px;text-align: center;" class="qtyminus" field="quantity" /><input type="text" name="quantity" value="'+quantity+'" style="width:40px;height:25px;text-align: center;" class="qty" /><input type="button" value="+" style="width:25px;height:25px;text-align: center;" class="qtyplus" field="quantity" /></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                    html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align:center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                  });
                  $("#sales_table").html(html);

                  var grand_total = json.grand_total;
                  $('#grand_total').val(grand_total); 

                  $('#paid').keyup(function(){
                    var paid = $('#paid').val();
                    var change_amount = paid - grand_total;
                    $('#change_amount').val(change_amount);

                   });

                  
                  $('._modalstore').click(function(){

                    var grand_total = $('#grand_total').val();
                    var change_amount = $('#change_amount').val();

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
                     if(change_amount == "" || change_amount < 0)
                     {
                      swal({
                        title: "",
                        text: "Please check Change Amount!",
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

          //Quantity KeyUp 
          
          $('#sales_table').on('keyup','._qty',function(){            
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

                    $.get("{{ url('/backend/salesqualtity/data') }}",
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
                      $("#sales_table").html();
                     var html = "";
                    $.each(json.sales_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];
                    //alert (name);
                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td>'+quantity+'</td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                    // alert(html);

                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="button" value="-" style="width:25px;height:25px;text-align: center;" class="qtyminus" field="quantity" /><input type="text" name="quantity" value="'+quantity+'" style="width:40px;height:25px;text-align: center;" class="qty" /><input type="button" value="+" style="width:25px;height:25px;text-align: center;" class="qtyplus" field="quantity" /></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                    html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';

                  });
                  $("#sales_table").html(html);

                  var grand_total = json.grand_total;
                  $('#grand_total').val(grand_total); 

                  $('#paid').keyup(function(){
                    var paid = $('#paid').val();
                    var change_amount = paid - grand_total;
                    $('#change_amount').val(change_amount);

                   });

                  
                  $('._modalstore').click(function(){

                    var grand_total = $('#grand_total').val();
                    var change_amount = $('#change_amount').val();

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
                     if(change_amount == "" || change_amount < 0)
                     {
                      swal({
                        title: "",
                        text: "Please check Change Amount!",
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
            $.get("{{ url('/backend/sales/data') }}",
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
                  $("#sales_table").html();
                  var html = "";
                  $.each(json.sales_table,function(index,value){

                      //alert(value['code']);
                      var code = value['code'];
                      var name = value['name'];
                      var quantity = value['quantity'];
                      var price = value['price'];
                      var total = value['total'];
                    //alert (name);
                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td>'+quantity+'</td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                    // alert(html);

                      html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                  });
                  $("#sales_table").html(html);

                  var grand_total = json.grand_total;
                  $('#grand_total').val(grand_total); 



                  $('#paid').keyup(function(){
                    var paid = $('#paid').val();
                    var change_amount = paid - grand_total;
                    $('#change_amount').val(change_amount);
                  });
                 

                  $('._modalstore').click(function(){

                    var grand_total = $('#grand_total').val();
                    var change_amount = $('#change_amount').val();

                    if(grand_total == 0 || grand_total == "")
                    {                       
                      swal({
                        title: "",
                        text: "Please add products to the List!",
                        type: "warning"
                        
                      });                      
                       $("._modalstore").attr('data-toggle','');                 
                     }
                     if(change_amount == "" || change_amount < 0)
                     {
                      swal({
                        title: "",
                        text: "Please check Change Amount!",
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
          }
        });  



       //delete from List
       $('#sales_table').on('click','._delete',function(){            
        var removecode=$(this).attr('data-rowid');
        
        $.get("{{ url('/backend/sales/remove') }}",
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
                 $("#sales_table").html();
                 var html = "";

                 $.each(json.sales_table,function(index,value){

                  var code = value['code'];
                  var name = value['name'];
                  var quantity = value['quantity'];
                  var price = value['price'];
                  var total = value['total'];
                    //alert (name);
                    // html += '<tr><td>'+code+'</td><td>'+name+'</td><td>'+quantity+'</td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                    // alert(html); 

                      html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                  });

                 
                 $("#sales_table").html(html);

                 var grand_total = json.grand_total;
                 $('#grand_total').val(grand_total); 

                 $('#paid').keyup(function(){
                  var paid = $('#paid').val();
                  var change_amount = paid - grand_total;
                  $('#change_amount').val(change_amount);

                });
                

                 $('._modalstore').click(function(){

                  var grand_total = $('#grand_total').val();
                  var change_amount = $('#change_amount').val();

                  if(grand_total == 0 || grand_total == "")
                  {                       
                    swal({
                      title: "",
                      text: "Please add products to the List!",
                      type: "warning"
                      
                    });                      
                     $("._modalstore").attr('data-toggle','');                
                   }
                   if(change_amount == "" || change_amount < 0)
                   {
                    swal({
                      title: "",
                      text: "Please check Change Amount!",
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
      });

       $('._modalstore').click(function(){       

        var grand_total = $('#grand_total').val();
        var paid = $('#paid').val();
        var change_amount = $('#change_amount').val();
        var tax = $('#tax').val();

        $('#modal_total').val(grand_total); 
        $('#modal_paid').val(paid); 
        $('#modal_change').val(change_amount);
        $('#modal_tax').val(tax);
      });

      //Select all categories
      $.get("{{ url('/backend/sales/allcategories') }}",
      {

      },
      function(data, status){
           //alert("Data: " + data + "\nStatus: " + status);
           var json = $.parseJSON(data);                 
           if(json.msg=="")
           {
            $('#paid').val(0);
            $('#change_amount').val("");
            $("#gridview").html();
            var html = "";

             html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb"><button class="btn btn-default btn-block thumbnail _allproduct" style="height:100px" href="#">All</button></div>'; 

            $.each(json.category_list,function(index,value){
              var name = value['name'];
              var id   = value['id'];

              html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb"><button class="btn btn-default btn-block thumbnail _catlist" id='+id+' style="height:100px" href="#">'+name+'</button></div>';                                        
            });
            $("#gridview").html(html);

            //getAllProducts 
            $('._allproduct').click(function(){

               $.get("{{ url('/backend/sales/allproducts') }}",
            {

            },
            function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                 var json = $.parseJSON(data);                 
                 if(json.msg=="")
                 {
                   $("#gridview").html();
                   var html = "";


            html += '&nbsp; &nbsp; <a href="{{ route('sales.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a><br/><br/>';

              $.each(json.all_products,function(index,value){
                        var p_name = value['name'];
                        var p_id   = value['id'];
                        var p_code = value['code'];
                        var p_photo = value['photo'];
                        var p_price = value['retail_price'];

                         html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb" align="center"><a href="#"><img class="_plist" style="border:1px solid #EEEEEE" height=100 width=100 id='+p_code+' src='+p_photo+'></a><div class="caption">'+p_name+' ['+p_code+']<br/>'+p_price+' Ks</div></div>';
                      });

                  $("#gridview").html(html);

                  $('._plist').click(function(){
                        var productcode=$(this).attr('id'); 
                                   // alert(productcode);
                                   $.get("{{ url('/backend/sales/data') }}",
                                   {
                                     code: productcode                
                                   },
                                   function(data, status){
                                    var json = $.parseJSON(data);
                                    
                                    if(json.msg=="")
                                    {
                                      $('#paid').val(0);
                                      $('#change_amount').val("");
                                      $("#sales_table").html();
                                      var html = "";
                                      $.each(json.sales_table,function(index,value){

                                                //alert(value['code']);
                                                var code = value['code'];
                                                var name = value['name'];
                                                var quantity = value['quantity'];
                                                var price = value['price'];
                                                var total = value['total'];
                                           

                                               html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                                            });
                                      $("#sales_table").html(html);

                                      var grand_total = json.grand_total;
                                      $('#grand_total').val(grand_total); 

                                      $('#paid').keyup(function(){
                                        var paid = $('#paid').val();
                                        var change_amount = paid - grand_total;
                                        $('#change_amount').val(change_amount);


                                      });

                                      
                                      $('._modalstore').click(function(){

                                        var grand_total = $('#grand_total').val();
                                        var change_amount = $('#change_amount').val();

                                        if(grand_total == 0 || grand_total == "")
                                        {                       
                                          swal({
                                            title: "",
                                            text: "Please add products to the List!",
                                            type: "warning"
                                            
                                          });                      
                                                 $("._modalstore").attr('data-toggle','');                         
                                               }
                                               if(change_amount == "" || change_amount < 0)
                                               {
                                                swal({
                                                  title: "",
                                                  text: "Please check Change Amount!",
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
                                         });
           }else{
                swal({
                      title: "",
                      text: json.msg,
                      type: "warning"
                                              
                      });
           }
      });

            });//--endgetAllProducts

            $('._catlist').click(function(){
              var category_id=$(this).attr('id'); 
                      //alert(category_id);  
                      $.get("{{ url('/backend/sales/productbycategory') }}",
                      {
                        category_id: category_id   
                      },
                      function(data, status){
                      //alert("Data: " + data + "\nStatus: " + status);
                      var json = $.parseJSON(data); 
                      if(json.msg=="")
                      {
                       $("#gridview").html();
                       var html = "";

                       html += '&nbsp; &nbsp; <a href="{{ route('sales.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a><br/><br/>'; 

                       $.each(json.product_list,function(index,value){
                        var p_name = value['name'];
                        var p_id   = value['id'];
                        var p_code = value['code'];
                        var p_photo = value['photo'];
                        var p_price = value['retail_price'];


                        // html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb"><button class="btn btn-default btn-block thumbnail _plist" id='+p_code+' style="height:100px" href="#">'+p_name+'</button></div>';

                         html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb" align="center"><a href="#"><img class="_plist" style="border:1px solid #EEEEEE" height=100 width=100 id='+p_code+' src='+p_photo+'></a><div class="caption">'+p_name+' ['+p_code+']<br/>'+p_price+' Ks</div></div>';
                      });
                     
                       $("#gridview").html(html);

                       $('._plist').click(function(){
                        var productcode=$(this).attr('id'); 
                                   // alert(productcode);
                                   $.get("{{ url('/backend/sales/data') }}",
                                   {
                                     code: productcode                
                                   },
                                   function(data, status){
                                    var json = $.parseJSON(data);
                                    
                                    if(json.msg=="")
                                    {
                                      $('#paid').val(0);
                                      $('#change_amount').val("");
                                      $("#sales_table").html();
                                      var html = "";
                                      $.each(json.sales_table,function(index,value){

                                                //alert(value['code']);
                                                var code = value['code'];
                                                var name = value['name'];
                                                var quantity = value['quantity'];
                                                var price = value['price'];
                                                var total = value['total'];
                                              //alert (name);
                                              // html += '<tr><td>'+code+'</td><td>'+name+'</td><td>'+quantity+'</td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                                              // alert(html); 

                                               html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                                            });
                                      $("#sales_table").html(html);

                                      var grand_total = json.grand_total;
                                      $('#grand_total').val(grand_total); 

                                      $('#paid').keyup(function(){
                                        var paid = $('#paid').val();
                                        var change_amount = paid - grand_total;
                                        $('#change_amount').val(change_amount);


                                      });

                                      
                                      $('._modalstore').click(function(){

                                        var grand_total = $('#grand_total').val();
                                        var change_amount = $('#change_amount').val();

                                        if(grand_total == 0 || grand_total == "")
                                        {                       
                                          swal({
                                            title: "",
                                            text: "Please add products to the List!",
                                            type: "warning"
                                            
                                          });                      
                                                 $("._modalstore").attr('data-toggle','');                         
                                               }
                                               if(change_amount == "" || change_amount < 0)
                                               {
                                                swal({
                                                  title: "",
                                                  text: "Please check Change Amount!",
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
                                         });
                                      }else{
                                        //alert(json.msg);
                                         swal({
                                                title: "",
                                                text: json.msg,
                                                type: "warning"
                                                
                                              });
                                      }

                                      });                 
                                      });                         

                                  }else{
                                    //alert(json.msg);
                                    swal({
                                          title: "",
                                          text: json.msg,
                                          type: "warning"
                                          
                                        });
                                  }
                                  });

// Select all products
 //      $('._allproduct').click(function(){
 //        alert('hi');
 //      $.get("{{ url('/backend/sales/allproducts') }}",
 //      {

 //      },
 //      function(data, status){
 //          //alert("Data: " + data + "\nStatus: " + status);
 //           var json = $.parseJSON(data);                 
 //           if(json.msg=="")
 //           {
 //             $("#gridview").html();
 //             var html = "";
 //              $.each(json.all_products,function(index,value){
 //                        var p_name = value['name'];
 //                        var p_id   = value['id'];
 //                        var p_code = value['code'];
 //                        var p_photo = value['photo'];
 //                        var p_price = value['retail_price'];

 //                         html += '<div class="col-lg-4 col-md-4 col-xs-6 thumb" align="center"><a href="#"><img class="_plist" height=100 width=100 id='+p_code+' src='+p_photo+'></a><div class="caption">'+p_name+' ['+p_code+']<br/>'+p_price+' Ks</div></div>';
 //                      });

 //                  $("#gridview").html(html);

 //                  $('._plist').click(function(){
 //                        var productcode=$(this).attr('id'); 
 //                                   // alert(productcode);
 //                                   $.get("{{ url('/backend/sales/data') }}",
 //                                   {
 //                                     code: productcode                
 //                                   },
 //                                   function(data, status){
 //                                    var json = $.parseJSON(data);
                                    
 //                                    if(json.msg=="")
 //                                    {
 //                                      $('#paid').val(0);
 //                                      $('#change_amount').val("");
 //                                      $("#sales_table").html();
 //                                      var html = "";
 //                                      $.each(json.sales_table,function(index,value){

 //                                                //alert(value['code']);
 //                                                var code = value['code'];
 //                                                var name = value['name'];
 //                                                var quantity = value['quantity'];
 //                                                var price = value['price'];
 //                                                var total = value['total'];
                                           

 //                                               html += '<tr><td>'+code+'</td><td>'+name+'</td><td><input type="text" autocomplete="off" size="3" name="quantity" id="qty" value="'+quantity+'" style="width:50px;height:30px;text-align: center;" class="_qty" data-code="'+code+'"/></td><td>'+price+'</td><td>'+total+'</td><td><a class="btn btn-danger btn-xs _delete" data-rowid="'+code+'"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
 //                                            });
 //                                      $("#sales_table").html(html);

 //                                      var grand_total = json.grand_total;
 //                                      $('#grand_total').val(grand_total); 

 //                                      $('#paid').keyup(function(){
 //                                        var paid = $('#paid').val();
 //                                        var change_amount = paid - grand_total;
 //                                        $('#change_amount').val(change_amount);


 //                                      });

                                      
 //                                      $('._modalstore').click(function(){

 //                                        var grand_total = $('#grand_total').val();
 //                                        var change_amount = $('#change_amount').val();

 //                                        if(grand_total == 0 || grand_total == "")
 //                                        {                       
 //                                          swal({
 //                                            title: "",
 //                                            text: "Please add products to the List!",
 //                                            type: "warning"
                                            
 //                                          });                      
 //                                                 $("._modalstore").attr('data-toggle','');                         
 //                                               }
 //                                               if(change_amount == "" || change_amount < 0)
 //                                               {
 //                                                swal({
 //                                                  title: "",
 //                                                  text: "Please check Change Amount!",
 //                                                  type: "warning"
                                                  
 //                                                });
 //                                                  $("._modalstore").attr('data-toggle','');   
 //                                                }
 //                                                 else{
 //                                                        $("._modalstore").attr('data-toggle','modal');
 //                                                      }
 //                                              });

 //                                            }
 //                                            else
 //                                            {
 //                                              //alert(json.msg);
 //                                               swal({
 //                                                      title: "",
 //                                                      text: json.msg,
 //                                                      type: "warning"
                                                      
 //                                                    });
 //                                            }

 //                                          });
 //                                         });




 //           }else{
 //                swal({
 //                      title: "",
 //                      text: json.msg,
 //                      type: "warning"
                                              
 //                      });
 //           }
 //    });
 // });

});
</script>
@endpush