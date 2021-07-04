@extends('layouts.main')
@section('title','Akumulasi Keuangan | Kasir Application')
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Akumulasi Keuangan</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <div class="box-header">
                        <h3 class="box-title" style="font-size: 20px">Pemasukan</h3>
                        
                    </div>
                    <div class="box-body">
                        <br>
                        	<h4>@currency($penjualan)</h4>

                     </div>
                      
                </table>
                
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <div class="box-header">
                        <h3 class="box-title" style="font-size: 20px">Pengeluaran</h3>
                        
                    </div>
                    <div class="box-body">
                        <br>
                        	<h4>@currency($pengeluaran)</h4>
                     </div>
                      
                </table>
                
              </div>
            </div>
            
          </div>
        </div>


        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <div class="box-header">
                        <h3 class="box-title" style="font-size: 20px">Laba Atau Keuntungan</h3>
                        
                    </div>
                    <div class="box-body">
                        <br>
                        	<h4>@currency($penjualan-$pengeluaran)</h4>
                     </div>
                      
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
                  window.location = "/delete-item/"+item_id+"";
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