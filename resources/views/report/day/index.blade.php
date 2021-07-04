@extends('layouts.main')
@section('title','Report Day | Kasir Application')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Report Day</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Report</li>
          <li class="breadcrumb-item active"><a href="#">Day</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-body">
                    <form class="navbar-form navbar-right" role="search" action="{{url('admin/report/day/search')}}">
                        <div class="input-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>From Date </label>
                                        <input type="date" id=""  name="date1"  class="form-control ">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">For Date</label>
                                            <input type="date"  name="date2"  class="form-control ">                                            
                                    </div>
                                </div>                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button  style="margin-top: 30px" class="btn btn-success" type="submit"><i class="fa fa-search"></i> </button> 
                                    </div>
                                </div>
                                             <!--/span-->
                            </div>
                
                            </div>
                        
                    </form>
                    <a href="{{url('admin/report/sale/cetakpdf/?date1='.Request::get('date1').'&date2='.Request::get('date2'))}}"
                     class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Cetak PDF</a>

                     <a href="{{url('admin/report/sale/dayp?date1='.Request::get('date1').
                     '&date2='.Request::get('date2'))}}"
                      class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                      <a href="{{url('admin/report/day')}}"><button type="button" class="btn btn-danger btn-sm">
                        <i class="fa fa-sw fa-refresh">  Reload</i></button></a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Transaksi ID</th>
                       <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $row)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$row->sale_id}}</td>
                      <td>{{$row->date}}</td> 
                      <td>
                        <a href="{{url('admin/sales/cetak/'.$row->sale_id)}}" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print"></i>Print</a>
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
@endsection
@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var customer_id = $(this).attr('customer-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Customer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "admin/customer/delete-customer/"+customer_id+"";
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