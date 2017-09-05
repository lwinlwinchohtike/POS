@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Add New Role</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
       @if (count($errors) > 0)
       <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{route('roles.store')}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Role Name *</label>
          <input type="text" class='form-control' name="name" value="{{ old('name') }}" placeholder="Role Name">
        </div>
        <div class="form-group">
          <label for="name">Role Slug *</label>
          <input type="text" class='form-control' name="slug" value="{{ old('slug') }}" placeholder="Role Slug">
        </div>
        
        @foreach($permissions as $key => $per)
        <h5>{{ ucfirst($key) }}</h5>
        @foreach($per as $p)
        <label class="checkbox-inline">
          <input type="checkbox" name="permissions[{{ $p }}]" id="inlineCheckbox1" value="true"> {{ $p }}
        </label>
        
        @endforeach
        <hr/>
        
        @endforeach
        <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <!-- /.row -->
</div>
<!-- /.box-body -->
<div class="box-footer">
  
</div>
</div>
<!-- /.box -->


<!-- /.row -->

@endsection


@push('scripts')
<script>
  $(function() {
    $('#roles-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('roles.data') !!}',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'slug', name: 'slug' },
      { data: 'permissions', name: 'permissions' }
      ]
    });
  });
</script>
@endpush