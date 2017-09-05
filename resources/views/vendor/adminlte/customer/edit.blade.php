@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Customer</h3>

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
      <form method="post" enctype="multipart/form-data" action="{{route('customers.update',$customer->id)}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Customer Name *</label>
          <input type="text" class='form-control' name="name" value="{{$customer->name}}" placeholder="User Name">
        </div>
        <div class="form-group">
          <label for="name">Email *</label>
          <input type="email" class='form-control' name="email" value="{{$customer->email}}" placeholder="Customer Email">
        </div>
        <div class="form-group">
          <label for="name">Phone Number *</label>
          <input type="text" class='form-control' name="phonenumber" value="{{$customer->phonenumber}}" placeholder="User Email">
        </div>
        <div class="form-group">
         <label for="name">Customer Photo</label>
         <input type="file" name="photo" id="photo">
         <p class="help-block">Please upload your Customer photo</p>
       </div>
       <div class="form-group">
        <label for="name">Address</label>
        <textarea class="form-control"  name="address" placeholder="Customer Address" rows="3">{{$customer->address}}</textarea>
        
      </div>
      
      <div class="form-group">
        <label for="name">Company Name</label>
        <input type="text" class='form-control' name="company_name" value="{{ $customer->company_name }}"  placeholder="Customer's Company Name">
      </div>                       
      
      <form action="{{ route('customers.store', $customer->id) }}">
        {{ csrf_field() }}
        {{ method_field("patch") }}
        <a href="{{ route('customers.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Customer</button>
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
