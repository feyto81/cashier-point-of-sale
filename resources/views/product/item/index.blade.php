@extends('layouts.main')
@section('title','All Item | Kasir')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> All Item</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active"><a href="#">All Item</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/item/create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Item</a>&nbsp;
          <a href="{{url('admin/item/print-all-barcode')}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print All Barcode</a>&nbsp;
          <a href="{{url('admin/item/print-all-qrcode')}}" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print All QR-Code</a>&nbsp;
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
                      <th>Name</th>
                      <th>Category</th>
                      <th>Unit</th>
                      <th>Price</th>
                      <th>Stock</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($item as $row)
                        <tr>
                          <td width="5%;">{{$loop->iteration}}</td>
                          <td>{{$row->barcode}}
                            <br>
                            <a href="{{url('admin/item/print-barcode-qr-code/'.$row->item_id)}}"  class="btn btn-warning btn-sm">
                              Generate <i class="fa fa-barcode"></i>
                            </a>   
                          </td>
                          <td>{{$row->name}}</td>
                          <td>{{$row->Category->name}}</td>
                          <td>{{$row->Unit->name}}</td>
                          <td>@currency($row->price)</td>
                          <td>{{$row->stock}}</td>
                          @if($row->image==null)
                            <td>Gambar Is Null</td>
                          @else
                            <td><a href="{{url('storage/'.$row->image)}}" target="_blank"><img src="{{asset('storage/'.$row->image)}}" width="100px" height="50px" ></a></td>
                          @endif
                          <td>
                            <a href="{{url('admin/item/edit/'.$row->item_id)}}" title="Edit Data" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" item-id="{{$row->item_id}}"><i class="fas fa-sm fa fa-trash"></i></a>
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
            var item_id = $(this).attr('item-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "item/destroy/"+item_id+"";
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