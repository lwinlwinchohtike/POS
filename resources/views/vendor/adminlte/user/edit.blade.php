@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
 
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Edit user</h3>

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
                @if (Session::has('message'))
                  <div class="alert {{ Session::get('alert-class', 'alert-success') }}">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      {{ Session::get('message') }}
                  </div>
                  @endif

                <form method="post" action="{{route('users.update',$user->id)}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">User Name *</label>
                        <input type="text" class='form-control' name="name" value="{{$user->name}}" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Email *</label>
                        <input type="email" class='form-control' name="email" value="{{$user->email}}" placeholder="User Email">
                    </div>
                    <div class="form-group">
                        <label for="name">Password *</label>
                        <input type="password" class='form-control' name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm Password *</label>
                        <input type="password" class='form-control' name="password_confirmation" placeholder="Confirm Password">
                    </div>
                   

                       @if(Auth::user()->hasPermission("create-role") OR Auth::user()->hasPermission("update-role"))
                         <div class="form-group">
                        <label for="">Role *</label>
                         @foreach($userole as $u)
                          <?php $userole = $u->role_id; ?>
                        @endforeach
                     
                        <select class="form-control" name="roles" required>
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                          @if($role->id == $userole)
                            <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
                           @else
                            <option value="{{$role->id}}">{{$role->name}}</option>
                           @endif
                        @endforeach 
                         </select>
                        </div>
                        @endif
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                    <form action="{{ route('users.store', $user->id) }}"
                >
                    {{ csrf_field() }}
                    {{ method_field("patch") }}
                    <button type="submit" class="btn btn-primary">Update User</button>
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

    </section>
    
@endsection
