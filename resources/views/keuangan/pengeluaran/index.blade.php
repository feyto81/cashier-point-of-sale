@extends('layouts.main')
@section('title','Pengeluaran | Kasir Application')
@section('content')
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengeluaran Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body table-responsive">
                  <table class="table table-bordered no-margin">
                    <tbody>
                      <tr>
                        <th style="width: 35%">Pemasukan</th>
                        <td><span id="pengeluaran_count"></span></td>
                      </tr>
                      <tr>
                        <th style="">Keterangan</th>
                        <td><span id="keterangan"></span></td>
                      </tr>
                      <tr>
                        <th style="">Cretaed</th>
                        <td><span id="created_at"></span></td>
                      </tr>
                      <tr>
                        <th style="">Updated</th>
                        <td><span id="updated_at"></span></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
        </div>
        </div>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Pengeluaran</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Keuangan</li>
          <li class="breadcrumb-item active"><a href="#">Pengeluaran</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="button" style="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
          Add Pengeluaran
    </button>&nbsp;
    <a href="{{url('/pengeluaran/export-excel')}}" class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i> Export Excel</a>&nbsp;
          <a href="{{url('/pengeluaran/export-pdf')}}" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> Export PDF</a>&nbsp;
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
                      <th>Pengeluaran</th>
                      <th>Keterangan</th>
                      <th>Created At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($pengeluaran as $p)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>@currency($p->pengeluaran_count)</td>
                      <td>{{$p->keterangan}}</td>
                      <td>{{$p->created_at->format('d-m-Y')}}</td>
                       <td>
                            <a title="Detail" id="set_dtl" class="btn btn-warning btn-sm" 
                              data-toggle="modal" data-target="#modal-detail"
                              data-pengeluaran_count="@currency($p->pengeluaran_count)"
                              data-keterangan="{{$p->keterangan}}"
                              data-created_at="{{$p->created_at->format('d-m-Y')}}"
                              data-updated_at="{{$p->updated_at->format('d-m-Y')}}">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{url('/pengeluaran/edit-pengeluaran/'.$p->pengeluaran_id)}}" title="Edit Data" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" pengeluaran-id="{{$p->pengeluaran_id}}"><i class="fas fa-sm fa fa-trash"></i></a>
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
              <form action="{{url('/pengeluaran/add')}}" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Input Pengeluaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                  <div class="form-group{{$errors->has('pengeluaran_count') ? 'has-error' : '' }}">
                    <label for="pengeluaran_count">Jumlah</label>
                    <input name="pengeluaran_count" type="number" class="form-control" id="pengeluaran_count" aria-describedby="emailHelp" required="" value="">
                  </div>
                  <div class="form-group{{$errors->has('keterangan') ? 'has-error' : '' }}">
                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" required="" class="form-control" id="keterangan" aria-describedby="emailHelp" value="">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Submit</button>
                  </div>
                 </div>
            </form>
          </div>
        </div>
        
 
@endsection

@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var pengeluaran_id = $(this).attr('pengeluaran-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data pemasukan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/pengeluaran/delete-pengeluaran/"+pengeluaran_id+"";
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
    <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '#set_dtl', function() {
        var jumlah = $(this).data('pengeluaran_count');
        var keterangan = $(this).data('keterangan');
        var created_at = $(this).data('created_at');
        var updated_at = $(this).data('updated_at');
        $('#pengeluaran_count').text(jumlah);
        $('#keterangan').text(keterangan);
        $('#created_at').text(created_at);
        $('#updated_at').text(updated_at);
      })
    })
    </script>
@endpush