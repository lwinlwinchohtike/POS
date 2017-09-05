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
                <div class="panel-heading"><span class="fa fa-users"></span> Role List</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        @if(Auth::user()->hasPermission("create-role"))
                            <a href="roles/create" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Creat New Role</a>
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
                            <table class="table table-bordered table-hover table-striped" id="roles-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permissions</th>
                                          @if(Auth::user()->hasPermission("update-role") OR Auth::user()->hasPermission("delete-role"))
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
            <h4 class="modal-title" id="myModalLabel"> Delete Role</h4>
        </div>
        <form action="{{ route('roles.delete') }}" method="POST"> 
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
        $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('roles.data') }}',
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false,"width": "5%" },
                { data: 'name', name: 'name',"width": "5%" },
                { data: 'slug', name: 'slug',"width": "5%" },
                { data: 'permissions', name: 'permissions',"width": "20%" },
                @if(Auth::user()->hasPermission("update-role") OR Auth::user()->hasPermission("delete-role"))
                { data: 'option', name: 'option', orderable: false, searchable: false,"width": "5%"}
                @endif

            ]
        });
          $('#roles-table').dataTable().on('click','._delete',function(){
            var id=$(this).attr('data-rowid');  
            //alert (id);    
            $('#del_id').val(id);          

        });
    });
</script>
@endpush