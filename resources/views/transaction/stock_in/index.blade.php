@extends('layouts.main')
@section('title','All Stock In | Kasir')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> All Stock In</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Transaction</li>
          <li class="breadcrumb-item active"><a href="#">All Stock In</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/stock-in/add')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Stock In</a>&nbsp;
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
                      <th>Barcode</th>
                      <th>Product Item</th>
                      <th>Qty</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($stock as $data)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->Item->barcode}}</td>
                        <td>{{$data->Item->name}}</td>
                        <td>{{$data->qty}}</td>
                        <td>{{$data->date}}</td>
                        <td>
                          <a id="set_dtl" class="btn btn-warning btn-sm" 
                          data-toggle="modal" data-target="#modal-detail"
                          data-barcode="{{$data->Item->barcode}}"
                          data-detail="{{$data->detail}}"
                          data-itemname="{{$data->Item->name}}"
                          data-suppliername="{{$data->Supplier->name}}"
                          data-qty="{{$data->qty}}"
                          data-date="{{$data->date}}">
                          <i class="fa fa-eye"></i> Details
                        </a>
                         <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" stock-id="{{$data->stock_id}}"><i class="fas fa-sm fa fa-trash"></i>Hapus</a>
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
<div class="modal"  tabindex="-1" role="dialog"  id="modal-detail">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Stock In Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped" id="sampleTable">
          <tbody>
            <tr>
              <th style="width: 35%">Barcode</th>
              <td><span id="barcode"></span></td>
            </tr>
            <tr>
              <th style="">Item Name</th>
              <td><span id="item_name"></span></td>
            </tr>
            <tr>
              <th style="">Detail</th>
              <td><span id="detail"></span></td>
            </tr>
            <tr>
              <th style="">Supplier Name</th>
              <td><span id="supplier_name"></span></td>
            </tr>
            <tr>
              <th style="">Qty</th>
              <td><span id="qty"></span></td>
            </tr>
            <tr>
              <th style="">Date</th>
              <td><span id="date"></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var stock_id = $(this).attr('stock-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Stock",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/stock-in/delete-stock/"+stock_id+"";
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
      var barcode = $(this).data('barcode');
      var itemname = $(this).data('itemname');
      var detail = $(this).data('detail');
      var suppliername = $(this).data('suppliername');
      var qty = $(this).data('qty');
      var date = $(this).data('date');
      $('#barcode').text(barcode);
      $('#item_name').text(itemname);
      $('#detail').text(detail);
      $('#supplier_name').text(suppliername);
      $('#qty').text(qty);
      $('#date').text(date);
      $('#detail').text(detail);

    })
  })
</script>
@endpush