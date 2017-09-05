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
                <div class="panel-heading"><span class="glyphicon glyphicon-barcode"></span>  Product List</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        @if(Auth::user()->hasPermission("create-product"))
                            <a href="products/create" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Creat Products</a>
                        </div>
                        @endif
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                           @if (Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <table class="table table-bordered table-hover table-striped" id="products-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>                        
                                        <th>Product</th>
                                        <th>Bar Code</th>
                                        <th>Purchase Price</th>
                                        <th>Retail Price</th>
                                        <th>Quantity</th>                  
                                        <th>Category Type</th> 
                                        <th>Photo</th>  
                                         @if(Auth::user()->hasPermission("update-product") OR Auth::user()->hasPermission("delete-product"))
                                        <th>Option</th>
                                        @endif
                                        <th>Details</th>                                       
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
            <h4 class="modal-title" id="myModalLabel"> Delete Product</h4>
        </div>
        <form action="{{ route('products.delete') }}" method="POST"> 
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
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('products.data') }}',
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code' },
                { data: 'purchase_price', name: 'purchase_price' },
                { data: 'retail_price', name: 'retail_price' },
                { data: 'quantity', name: 'quantity' },                 
                { data: 'category', name: 'category' },
                { data: 'photo', name: 'photo' },
                 @if(Auth::user()->hasPermission("update-product") OR Auth::user()->hasPermission("delete-product"))                         
                { data: 'option', name: 'option', orderable: false, searchable: false},
                @endif
                { data: 'inout', name: 'inout'}
                
               
            ]
        });

        $('#products-table').dataTable().on('click','._delete',function(){
            var id=$(this).attr('data-rowid');  
            //alert (id);    
            $('#del_id').val(id);          

        });
    });
</script>
@endpush

