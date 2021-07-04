@extends('layouts.main')
@section('title','Edit User | Kasir Application')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Edit User</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Edit User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Edit User</h3>
            <div class="tile-body">
              <form role="form" action="{{url('admin/users/update-user/'.$user->id)}}" method="post">
                {{ csrf_field() }}
                <div class="form-group{{$errors->has('name') ? 'has-error' : '' }}">
                  <label class="control-label">Name</label>
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter Name" value="{{$user->name}}">
                  @if($errors->has('name'))
                    <span class="text-danger">
                        <small>{{$errors->first('name')}}</small>
                    </span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('username') ? 'has-error' : '' }}">
                  <label class="control-label">Username</label>
                  <input class="form-control" name="username" id="username" type="text" placeholder="Enter Name" value="{{$user->username}}">
                  @if($errors->has('username'))
                    <span class="text-danger">
                        <small>{{$errors->first('username')}}</small>
                    </span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label">Email</label>
                    <input class="form-control" name="email" id="email" type="text" placeholder="Enter email" value="{{$user->email}}">
                    @if($errors->has('email'))
                      <span class="text-danger">
                          <small>{{$errors->first('email')}}</small>
                      </span>
                    @endif
                  </div>
                  <div class="form-group{{$errors->has('level_id') ? 'has-error' : '' }}">
                    <label class="control-label">Level</label>
                     <select name="level_id" class="form-control demoSelect" id="level_id">
                          <option disabled selected>-- Select Level -- </option>
                          @foreach ($level as $row)
                          <option @if($row->id==$user->level_id) selected @endif value="{{ $row->id}}">{{$row->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('level_id'))
                        <span class="text-danger">
                            <small>{{$errors->first('level_id')}}</small>
                        </span>
                        @endif
                  </div>
                  <div class="form-group{{$errors->has('password') ? 'has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter Password" value="">
                    <small>Biarkan kosong jika tidak ingin mengubah password</small>
                    @if($errors->has('password'))
                      <span class="text-danger">
                          <small>{{$errors->first('password')}}</small>
                      </span>
                    @endif
                  </div>
                  <div class="form-group{{$errors->has('confPassword')?' has-error':''}}">
                    <label class="control-label" for="confPassword">Confirm Password</label>
                    <input class="form-control" name="confPassword" id="confPassword" type="password"  placeholder="Enter Conf Password" value="">
                    @if($errors->has('confPassword'))
                      <span class="text-danger">
                          <small>{{$errors->first('confPassword')}}</small>
                      </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" class="form-control" rows="3">{{$user->address}}</textarea>
                     @if($errors->has('address'))
                      <span class="text-danger">
                        <small>{{$errors->first('address')}}</small>
                      </span>
                    @endif
                    
              </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                <a href="{{url('/all-user')}}" class="btn btn-primary"><i class="fa fa-backward"></i>Back</a>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection
