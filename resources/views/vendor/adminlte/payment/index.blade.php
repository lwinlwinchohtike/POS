@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
<!-- Author: Nwe Ni Ei Kyaw -->

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div id="page-wrapper">
         <div class="row">
          <div class="col-lg-12">        
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-money"></span> Payment</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        @if(Auth::user()->hasPermission("create-payment-method"))
                            <a href="payments/create" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Create Payment</a>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('message'))
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                            <table class="table table-bordered table-hover table-striped" id="payments-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                         @if(Auth::user()->hasPermission("update-payment-method") OR Auth::user()->hasPermission("delete-payment-method"))
                                        <th>Option</th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

    <!-- Modal For Delete -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    
    <div class="modal-content">
      <div class="modal-header"> 
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>             
            <h4 class="modal-title" id="myModalLabel"> Delete Payment Method</h4>
        </div>
        <form action="{{ route('payments.delete') }}" method="POST"> 
        {{ csrf_field() }}       
         <input type='hidden' name='data-rowid' id="del_id"/>   
          <div class="modal-body">   
                Are you sure you want to delete?            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" value='Delete'/>
          </div>
     </form>
    </div>
  </div>
</div>
@endsection


@push('scripts')
<script>
    $(function() {
        $('#payments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('payments.data') }}',
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                @if(Auth::user()->hasPermission("update-payment-method") OR Auth::user()->hasPermission("delete-payment-method"))
                { data: 'option', name: 'option', orderable: false, searchable: false} 
                @endif     
            ]
        });

         $('#payments-table').dataTable().on('click','._delete',function(){
            var id=$(this).attr('data-rowid');  
            //alert (id);    
            $('#del_id').val(id);          

        });
    });
</script>
@endpush