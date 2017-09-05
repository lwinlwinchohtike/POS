@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- Author: Nwe Ni Ei Kyaw -->

<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Add New Supplier</h3>

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
        <form method="post" enctype="multipart/form-data" action="{{route('suppliers.store')}}">
          {{ csrf_field() }}         
          <div class="form-group">
            <label for="name">Supplier Name *</label>
            <input type="text" class='form-control' name="suppliername" value="{{ old('suppliername') }}" placeholder="Supplier Name">
          </div> 
          <div class="form-group">
            <label for="email">Email *</label>
            <input type="text" class='form-control' name="email" value="{{ old('email') }}" placeholder="Email">
          </div> 
          <div class="form-group">
            <label for="name">Phone *</label>
            <input type="text" class='form-control' name="phoneno" value="{{ old('phoneno') }}" placeholder="Phone No.">
          </div>
          <div class="form-group">
           <label for="name">Supplier Photo</label>
           <input type="file" name="photo" id="photo">
           <p class="help-block">Please upload your Supplier photo</p>
         </div>   
          <div class="form-group">
          <label for="name">Address</label>
          <textarea class="form-control"  name="address"  placeholder="Address" rows="3">{{ old('address') }}</textarea>
          </div>        
          <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" class='form-control' name="company_name" value="{{ old('company_name') }}" placeholder="Supplier Name">
          </div> 
          
        <!-- <div class="form-group">
          <label for="name">Tax</label>
          <input type="number" class='form-control' name="tax" value="{{ old('tax') }}" placeholder="Tax">
        </div>  -->
        <a href="{{ route('suppliers.index') }}" class="btn btn-default">Cancel</a>                
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
    $('#suppliers-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('suppliers.data') !!}',
      columns: [
      { data: 'id', name: 'id' },
      { data: 'suppliername', name: 'suppliername' },
      { data: 'phoneno', name: 'email' },
      { data: 'email', name: 'email' },
      { data: 'address', name: 'address' },
      { data: 'tax', name: 'tax' }
      ]
    });
  });
</script>
@endpush