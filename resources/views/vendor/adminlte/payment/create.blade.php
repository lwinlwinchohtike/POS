@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- Author: Nwe Ni Ei Kyaw -->

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Add Payment</h3>

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
        <form method="post" action="{{route('payments.store')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Payment Name *</label>
            <input type="text" class='form-control' name="name" value="{{ old('name') }}" placeholder="Payment Name">
          </div> 
           <a href="{{ route('payments.index') }}" class="btn btn-default">Cancel</a>                 
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
        $('#payments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('payments.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' }
            ]
        });
    });
</script>
@endpush