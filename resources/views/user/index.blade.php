@extends('layouts.main')
@section('title','All User | Kasir Application')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> All User</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active"><a href="#">All User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="button" style="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
          Add User
    </button>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user as $all)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$all->username}}</td>
                        <td>{{$all->name}}</td>
                        <td>{{$all->address}}</td>
                        <td>{{$all->Level->name}}</td>
                        <td>
                            <a href="{{url('admin/users/edit-user/'.$all->id)}}" title="Edit Data" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" user-id="{{$all->id}}"><i class="fas fa-sm fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('sweetalert::alert')
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{url('admin/users/add')}}" method="POST">
                  {{csrf_field()}}
              <div class="form-group{{$errors->has('name') ? 'has-error' : '' }}">
                <label for="validationServer033">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="">
                @if($errors->has('name'))
                  <span class="text-danger">
                    <small>{{$errors->first('name')}}</small>
                  </span>
                @endif
              </div>
              <div class="form-group{{$errors->has('username') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                @if($errors->has('username'))
                  <span class="text-danger">
                    <small>{{$errors->first('username')}}</small>
                  </span>
                @endif
              </div>
              <div class="form-group{{$errors->has('email') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                @if($errors->has('email'))
                  <span class="text-danger">
                    <small>{{$errors->first('email')}}</small>
                  </span>
                @endif
              </div>
              
              <div class="form-group{{$errors->has('password') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                 @if($errors->has('password'))
                  <span class="text-danger">
                    <small>{{$errors->first('password')}}</small>
                  </span>
                @endif
              </div>
               <div class="form-group{{$errors->has('passwordconf') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Password Confirmation</label>
                <input name="passwordconf" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                 @if($errors->has('passwordconf'))
                  <span class="text-danger">
                    <small>{{$errors->first('passwordconf')}}</small>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
                 @if($errors->has('address'))
                  <span class="text-danger">
                    <small>{{$errors->first('address')}}</small>
                  </span>
                @endif
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Level</label>
                <select name="level_id" id="level_id" class="form-control demoSelect" required="">
                    <option disabled selected>--Select Role-- </option>
                      @foreach ($level as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                      </select>
                   @if($errors->has('level_id'))
                  <span class="text-danger">
                    <small>{{$errors->first('level_id')}}</small>
                  </span>
                @endif
              </div>
              
              
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Submit</button>
                </form>
              </div>
            </div>
            @include('sweetalert::alert')

          </div>
@endsection
@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var user_id = $(this).attr('user-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data User ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "users/delete/"+user_id+"";
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                  )
                }
              })
          });
              
    </script>
@endpush