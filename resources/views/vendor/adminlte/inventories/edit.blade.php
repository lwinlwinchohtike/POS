@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- Author: Nwe Ni Ei Kyaw -->

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Inventory</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
      </button>
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
      <form method="post" enctype="multipart/form-data" action="{{route('inventories.update', $products->id)}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Product Name </label>
          <input type="label" class='form-control' name="name" value="{{$products->name}}" disabled="">
        </div>
        <div class="form-group">
          <label for="quantity">Current Quantity</label>
          <input type="label" class='form-control' name="quantity" value="{{$products->quantity}}" disabled="">
        </div>
        <div class="form-group">
          <label for="name">User Name</label>
          <input type="label" class="form-control" name="name" value="{{$users}}" disabled="">
        </div>
        <div class="form-group">
            <label for="name">Inventory to add/subtract *</label>
            <input type="number" class='form-control' name="in_out_qty" value="{{ old('in_out_qty') }}" placeholder="Quantity">                       
          </div>
        <div class="form-group">
          <label for="remark">Comments</label>
          <textarea class="form-control"  name="remarks" placeholder="Remarks" rows="3">{{ old('remarks') }}
          </textarea>
        </div>      
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
