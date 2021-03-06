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
                <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Sales Report </div>
                <div class="panel-body">
                    
                     <div class="row">                     
                        <div class="col-md-3">
                            <div class="form-group">
                                    <label for="name" class="control-label"><b>Start Date</b></label>
                                     <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="start_date" name="start_date" value="<?= date('Y/m/d');?>">
                                    </div>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                    <label for="name" class="control-label"><b>End Date</b></label>
                                     <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="end_date" name="end_date" value="<?= date('Y/m/d');?>">
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-3">

                        <div class="form-group">
                        <label for="name" class="control-label">&nbsp;</label>
                            <a href="#" id="btn_vr" class="btn btn-primary btn-block" >View Report</a>
                        </div>
                       
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="well well-sm"><b>
                        Grand-Total :  </b><label for="name" class="control-label" id="grand_total">0</label> Ks
                        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well well-sm" style="background-color: #CCE6FF;"><b>
                        Grand-Profit: </b><label for="name" class="control-label" id="grand_profit">0</label> Ks
                        
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                   <table class="table table-hover table-striped" id="dt_salesreport">
                               
                    </table>
               </div>
                    </div>
                    
                </div><!--panel-body-->
            </div>
        </div>
    </div>
</div>
</div>
</div>
    


@endsection


@push('scripts')
<script>
  $(document).ready(function(){ 

      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();
   $.get("{{ url('/backend/salesreportbydate/data') }}",
   {
    start_date: start_date ,
    end_date  : end_date
  },
  function(data, status){
               //alert("Data: " + data + "\nStatus: " + status);
               var dataSet = $.parseJSON(data);
               //alert(dataSet);
               var grand_total = 0;
               var grand_profit = 0;

               $.each(dataSet,function(index,value){
                //alert(value[9]);
                grand_total = value[10];
                grand_profit = value[9];                 

              });
               $('#grand_total').html(grand_total);
               $('#grand_profit').html(grand_profit);



               if($.fn.DataTable.isDataTable("#dt_salesreport")) 
               {
                $('#dt_salesreport').DataTable().clear().destroy();               
              }
              $('#dt_salesreport').DataTable( {
                        //"bDestroy" :true ,
                        data: dataSet,
                        columns: [
                        { title: "No." , orderable: false, searchable: false},
                            // { title: "Sale ID" },
                            { title: "Date" },
                            { title: "Total Qty" },
                            { title: "Total" },
                            { title: "Profit" },
                            { title: "Payment" },
                            { title: "Sold By" },
                            { title: "Sold To" },
                            { title: "" , orderable: false, searchable: false}
                            ]
                          });  


            });


   $('.input-group.date').datepicker({
     format: 'yyyy/mm/dd',         
     todayHighlight: true,
     autoclose: true
   });

  

   $('#btn_vr').click(function(){


    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
            //alert(end_date);
            $.get("{{ url('/backend/salesreportbydate/data') }}",
            {
              start_date: start_date ,
              end_date  : end_date

            },
            function(data, status){
               //alert("Data: " + data + "\nStatus: " + status);
               var dataSet = $.parseJSON(data);
               //alert(dataSet);
               var grand_total = 0;
               var grand_profit = 0;

               $.each(dataSet,function(index,value){
                //alert(value[10]);
                grand_total = value[10];
                grand_profit = value[9];                 

              });
               $('#grand_total').html(grand_total);
               $('#grand_profit').html(grand_profit);



               if($.fn.DataTable.isDataTable("#dt_salesreport")) 
               {
                $('#dt_salesreport').DataTable().clear().destroy();               
              }
              $('#dt_salesreport').DataTable( {
                        //"bDestroy" :true ,
                        data: dataSet,
                        columns: [
                        { title: "No." , orderable: false, searchable: false},
                            // { title: "Sale ID" },
                            { title: "Date" },
                            { title: "Total Qty" },
                            { title: "Total" },
                            { title: "Profit" },
                            { title: "Payment" },
                            { title: "Sold By" },
                            { title: "Sold To" },
                            { title: "" , orderable: false, searchable: false}
                            ]
                          });  
            });

          });   

   

 });
</script>
@endpush

