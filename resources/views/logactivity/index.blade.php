@extends('layouts.main')
@section('title','Log Activity | Kasir')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Log Activity Lists</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Activity</li>
          <li class="breadcrumb-item active"><a href="#">Log Activity Lists</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/logactivity/deleteAll')}}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete all data</a>&nbsp;
          
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
                      <th>Subject</th>
                      <th>URL</th>
                      <th>Method</th>
                      <th>IP</th>
                      <th>Code</th>
                      <th width="300px">User Agent</th>
                      <th>User</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($logs->count())
                    @foreach($logs as $key => $log)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $log->subject }}</td>
                      <td class="text-success">{{ $log->url }}</td>
                      <td><label class="label label-info">{{ $log->method }}</label></td>
                      <td class="text-warning">{{ $log->ip }}</td>
                      <td class="text-success">200</td>

                      <td class="text-danger">{{ $log->agent }}</td>
                      <td>{{ $log->Nama->name}}</td>
                    </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('sweetalert::alert')
    </main>
    

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
                  window.location = "/user/delete/"+user_id+"";
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