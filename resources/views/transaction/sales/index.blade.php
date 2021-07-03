@extends('layouts.main')
@section('title','Transaction | Kasir Application')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-cart"></i> Transaction</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Transaction</li>
        </ul>
      </div>

      <form id="formSave" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="tile">
                    <div class="tile-body">
                        <table widht="100%">
                            <tr>
                                <td style="vertical-align: top">
                                    <label for="date">Date</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" value="<?=date('Y-m-d')?>" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; width: 30%">
                                    <label for="user">Kasir</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="user_id" name="user_id" value="{{Auth::user()->name}}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <label for="customer">Customer</label>
                                </td>
                                <td>
                                    <div>
                                        <select id="customer_name" name="customer_name" class="form-control demoSelect">
                                            <option value="umum">Umum</option>
                                            @foreach ($customer as $row)
                                                <option value="{{$row->name}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tile">
                    <div class="tile-body">
                        <table widht="100%">
                            <tr>
                                <td style="vertical-align: top;width: 30%">
                                    <label for="barcode">Barcode</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id" name="item_id">
                                        <input type="hidden" id="price" name="price">
                                        <input type="hidden" id="stock" name="stock">
                                        
                                        <input type="text" id="barcode" name="barcode" class="form-control" autofocus >
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <label for="qty">Qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id" name="id">
                                        <input type="number" id="qty" name="qty" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            <i class="fa fa-cart-plus"></i> Add
                                          </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="tile">
                  <div class="tile-body">
                    <div class="box box-widget">
                        <div class="box-body">
                            <div align="right">
                                <h4>Invoice <b><span id="sale_id" name="sale_id">b</span></b></h4>
                                <h1><b><span id="grand_total2" style="font-size: 50pt">0</span></b></h1>
                            </div>
                            <br>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Barcode</th>
                              <th>Product Item</th>
                              <th>Price</th>
                              <th>Qty</th>
                              <th>Discount Item</th>
                              <th>Total</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="cart_table">
                           
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
            var stockout_id = $(this).attr('stockout-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Stock Out",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/admin/stock-out/delete-stock/"+stockout_id+"";
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