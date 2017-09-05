@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Category</h3>

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
      <form  action="{{ route('categories.update', $category->id) }}"  method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Category Name *</label>
          <input type="text" class='form-control' value="{{$category->name}}" name="name" placeholder="Category Name">
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Category</button>
      </form>
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

@endsection


