@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')


<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Product</h3>
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
      <form  action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"  method="POST">
        {{ csrf_field() }}
        
        <div class="form-group">
          <label for="name">Product Name *</label>
          <input type="text" class='form-control' name="name" value="{{$product->name}}" placeholder="Product Name" >
        </div>
        <div class="form-group">
          <label for="name">Bar Code *</label>
          <input type="text" class='form-control' name="code" value="{{$product->code}}"  placeholder="Product Code" disabled="">
        </div>
        <div class="form-group">
          <label for="name">Purchase Price *</label>
          <input type="text" class='form-control' name="purchase_price" value="{{$product->purchase_price}}"  placeholder="Purchase Price" >
        </div>
        <div class="form-group">
          <label for="name">Retail Price *</label>
          <input type="text" class='form-control' name="retail_price" value="{{$product->retail_price}}"  placeholder="Retail Price" >
        </div>
        <div class="form-group">
          <label for="name">Quantity *</label>
          <input type="number" class='form-control' name="quantity" value="{{ $product->quantity }}" placeholder="Quantity">                       
        </div>
        <div class="form-group">
          <label for="name">Description</label>
          <textarea class="form-control"  name="description" placeholder="Product Description" rows="3">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
         <label for="name">Product Photo</label>
         <input type="file" name="photo" id="photo">
         <p class="help-block">Please upload your product photo</p>
       </div>
       <div class="form-group">
        <label for="name">Choose Category *</label>
        <div class="form-group">                        
          <select class="form-control" name="category_id" required> 
            <option value="">-- Select Category Type --</option>
            @foreach($categories as $category)
            <option value='{{$category->id}}' 
              <?php if($product->category_id==$category->id):echo "selected";endif;?>>
              {{$category->name}}</option>
              @endforeach                            
            </select>
          </div>
        </div>  
        <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>               
        <button type="submit" class="btn btn-primary">Update Product</button>
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
    $('#products-table').DataTable().on('click','._edit',function(){
      var category_type = $(this).attr('edit_category_id');
      alert(category_type);
      $('#edit_category').val(category_type);   
    });
  });
</script>
@endpush

