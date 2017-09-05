@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- Author: Nwe Ni Ei Kyaw -->

<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Supplier</h3>

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
      <form  action="{{ route('suppliers.update', $supplier->id) }}" enctype="multipart/form-data"  method="POST">
        {{ csrf_field() }}       
        <div class="form-group">
          <label for="name">Supplier Name *</label>
          <input type="text" class='form-control' value="{{$supplier->suppliername}}" name="suppliername" placeholder="Supplier Name">
        </div>
         <div class="form-group">
          <label for="name">Email *</label>
          <input type="email" class='form-control' value="{{$supplier->email}}" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="name">Phone *</label>
          <input type="text" class='form-control' value="{{$supplier->phoneno}}" name="phoneno" placeholder="Mobile">
        </div>
         <div class="form-group">
         <label for="name">Supplier Photo</label>
         <input type="file" name="photo" id="photo">
         <p class="help-block">Please upload your Supplier photo</p>
       </div> 
        <div class="form-group">
        <label for="name">Address</label>
        <textarea class="form-control"  name="address" placeholder="Address" rows="3">{{$supplier->address}}</textarea>
      </div> 
        <div class="form-group">
          <label for="name">Company Name</label>
          <input type="text" class='form-control' name="company_name" value="{{$supplier->company_name}}" placeholder="Company Name">
        </div> 
   
     <!--  <div class="form-group">
        <label for="name">Tax</label>
        <input type="number" class='form-control' value="{{$supplier->tax}}" name="tax" placeholder="Tax">
      </div> -->
      <a href="{{ route('suppliers.index') }}" class="btn btn-default">Cancel</a>
      <form action="{{ route('suppliers.store', $supplier->id) }}"
        >
        {{ csrf_field() }}
        {{ method_field("patch") }}
        <button type="submit" class="btn btn-primary">Update Supplier</button>
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


<!-- /.row -->

@endsection