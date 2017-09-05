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
                <div class="panel-heading"><span class="glyphicon glyphicon-check"></span> All Product Tracking</div>
                <div class="panel-body">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('message'))
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                            <table class="table table-bordered table-hover table-striped" id="inventories-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Event Date</th>                        
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Qty(In/Out)</th>
                                        <th>Remarks</th>
                                        <!-- <th></th> -->
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
    
@endsection


@push('scripts')
<script>
    $(function() {
        $('#inventories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('inventories.data') }}',
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false },
                { data: 'updated_at', name: 'updated_at'},
                { data: 'product', name: 'product' },
                { data: 'user', name: 'user' },
                { data: 'in_out_qty', name: 'in_out_qty' },                 
                { data: 'remarks', name: 'remarks' },    
                // { data: 'option', name: 'option', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush