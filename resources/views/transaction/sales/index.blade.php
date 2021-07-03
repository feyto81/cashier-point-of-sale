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
{{-- modal barcode --}}
<div class="modal"  tabindex="-1" role="dialog"  id="modal-item">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product Item</h5>
          <button type="button" class="close" id="closeModalTambah" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table table-bordered table-striped" id="sampleTable">
            <thead>
              <tr>
                <th>Barcode</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($item as $data)
                <tr>
                  <td>{{$data->barcode}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->unit_name}}</td>
                  <td>{{$data->price}}</td>
                  <td>{{$data->stock}}</td>
                  <td class="text-right">
                    <button class="btn btn-info btn-xs" id="select"
                     data-id="{{$data->item_id}}"
                     data-barcode="{{$data->barcode}}"
                     data-price="{{$data->price}}"
                     data-stock="{{$data->stock}}">
                      <i class="fa fa-check"></i> Select
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('bottom')
<script type="text/javascript">

    function loadDataTable(){
          $.ajax({
            url: "{{url('/sales/getDataTable')}}",
            success:function(data){
              $('#cart_table').html(data);
              calculate();
            }
          })
        }
        loadDataTable();
        $('#formSave').submit(function(e){
          e.preventDefault();
          var request = new FormData(this);
          var item_id = $('#item_id').val()
          var price = $('#price').val()
          var stock = $('#stock').val()
          var qty = $('#qty').val()
          if(item_id == '') {
            toastr["error"]("Product Belum DiPilih","Error")
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            $('#barcode').focus()
          } else if(stock < 1) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Stock Habis',
            })
            $('#item_id').val('')
            $('#barcode').val('')
            $('#barcode').focus();
          } else if(stock < qty) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Pembelian Lebih dari stock yang ada',
            })
            $('#qty').val('')
            $('#qty').focus()
          } else {
            $.ajax({
              url: "{{url('sales/cart')}}",
              method: "POST",
              data: request,
              contentType: false,
              cache: false,
              processData: false,
              success:function(data){
                if(data == "sukses"){
                  
                  loadDataTable();
                  calculate();
                }
                else {
                  alert('gagal menambah data');
                }
              }
            });
          }
        });
    
      $(document).on('click', '#select', function() {
        $('#item_id').val($(this).data('id'))
        $('#barcode').val($(this).data('barcode'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        // $('#modal-item').modal('hide')
      $('#closeModalTambah').click();
    });
    
    </script>
    <script>
    function count_edit_modal() {
      var price = $('#price_item').val()
      var qty = $('#qty_item').val()
      var discount = $('#discount_item').val()
    
      total_before = price * qty
      $('#total_before').val(total_before)
    
      total = (price - discount) * qty
      $('#total_item').val(total)
      // unutk 0 discount
      if(discount == '') {
        $('#discount_item').val()
      }
    }
    function calculate() {
        var subtotal = 0;
        $('#cart_table tr').each(function() {
            subtotal += parseInt($(this).find('#total').text())
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)
    
        var discount = $('#discount').val()
        var grand_total = subtotal - discount
        if(isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
    
        } else {
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)
        }
    
        var cash = $('#cash').val();
        cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
        // unutk 0 discount
        if(discount == '') {
            $('#discount').val()
        }
    }
    
    
    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()
    })
    $(document).on('keyup mouseup', '#price_item, #qty_item, #discount_item', function() {
      count_edit_modal()
    })
    
    $(document).ready(function() {
        calculate()
    })
    $(document).on('click', '.btn-delete', function(e){
          if(confirm('Apakah Anda Yakin?')) {//
          e.preventDefault();
          var cart_id = $(this).attr('cart-id');
          $.ajax({
            url: "{{url('/sales/delete-cart')}}/"+cart_id,
            method: "GET",
            success:function(data){
              if(data == "sukses"){
                toastr["success"]("Cart Berhasil Dihapus","Success")
                $('#item_id').val('')
                $('#barcode').val('')
                loadDataTable();
              } else {
                alert('Gagal');
            }
            }
          });
          }//
        });
        $('#formEdit').submit(function(e){
          e.preventDefault();
          var request = new FormData(this);
          var cart_id = $('#cartid_item').val();
          var price = $('#price_item').val()
          var qty = $('#qty_item').val()
          var discount = $('#discount_item').val()
          var total = $('#total_item').val()
          if(price == '' || price < 1) {
            toastr["error"]("Harga Tidak Boleh Kosong","Error")
            $('#price_item').focus()
          } else if(qty == '' || qty < 1) {
            toastr["error"]("Qty Tidak Boleh Kosong","Error")
            $('#qty_item').focus()
          } else {
            $.ajax({
              url: "{{url('/sales/EditData') }}/"+cart_id,
              method: "POST",
              data: request,
              contentType: false,
              cache: false,
              processData: false,
              success:function(data){
                if(data == "sukses"){
                  $('#closeModalEdit').click();
                  $('#formSave')[0].reset();
                  alert('berhasil memperbarui data');
                  loadDataTable();
                }
                else {
                  alert('Gaga');
                }
              }
            });
          }
        });
        $(document).on('click', '#update_cart', function() {
          $('#cartid_item').val($(this).data('cartid'))
          $('#barcode_item').val($(this).data('barcode'))
          $('#product_item').val($(this).data('product'))
          $('#price_item').val($(this).data('price'))
          $('#qty_item').val($(this).data('qty'))
          $('#total_before').val($(this).data('price') * $(this).data('qty'))
          $('#discount_item').val($(this).data('discount'))
          $('#total_item').val($(this).data('total'))
        });
        
    
    
    
    </script>
@endpush