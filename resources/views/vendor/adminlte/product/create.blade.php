@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')


<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Add New Product</h3>

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
        <form method="post" enctype="multipart/form-data" action="{{ route('products.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Product Name *</label>
            <input type="text" class='form-control' name="name" value="{{ old('name') }}" placeholder="Product Name">
          </div>
          <div class="form-group">
            <label for="name">Bar Code *</label>
            <input type="text" class='form-control' name="code" value="{{ old('code') }}"  placeholder="Product Code">
          </div>
          <div class="form-group">
            <label for="name">Purchase Price *</label>
            <input type="text" class='form-control' name="purchase_price" value="{{ old('purchase_price') }}" placeholder="Purchase Price">                        
          </div>
          <div class="form-group">
            <label for="name">Retail Price *</label>
            <input type="text" class='form-control' name="retail_price" value="{{ old('retail_price') }}" placeholder="Retail Price">                       
          </div>
          <div class="form-group">
            <label for="name">Quantity *</label>
            <input type="number" class='form-control' name="quantity" value="{{ old('quantity') }}" placeholder="Quantity">                       
          </div>
          <div class="form-group">
            <label for="name">Description</label>
            <textarea class="form-control"  name="description" placeholder="Product Description" rows="3">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
           <label for="name">Product Photo</label>
           <input type="file" name="photo" id="photo">
           <p class="help-block">Please upload your Product photo</p>
         </div> 


         <div class="form-group">         
          <label for="name">Choose Category *</label>
         
          <div class="form-group">
            <select class="form-control" name="category_id" required> 
              <option value="" selected="selected"> -- Select Category Type --</option>
              @if($categories!=null)
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach 
              @endif
            </select>            
           <!--  <button class='btn btn-primary btn-sm _plist' type='button' id='$code' ><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>   -->       
          </div>
        </div> 
        <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>                                       
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
