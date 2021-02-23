@extends('layouts.main')
@section('title','Barcode and QR-Code | Kasir')
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Barcode and QR-Code</h1>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <div class="box-header">
                        <h3 class="box-title" style="font-size: 20px">Barcode Generator</h3>
                        
                    </div>
                    <div class="box-body">
                        <br>
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($row->barcode, 'C39')}}" height="60" width="180">
                        <br>
                        {{$row->barcode}}
                        <br>
                        <a href="{{url('admin/item/barcode-print/'.$row->item_id)}}" target="_blank"  class="btn btn-primary btn-sm">
                          <i class="fa fa-print"></i> Print
                        </a>
                        <a href="{{url('admin/item')}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-backward"></i> Back
                          </a>
                      </div>
                      
                </table>
                
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                        <div class="box-header">
                            <h3 class="box-title" style="font-size: 20px">QR-Code Generator</h3>
                        </div>
                      <div class="box-body">
                          <?php
                            $qrCode = new Endroid\QrCode\QrCode($row->barcode);//('123456') buat angka doang
                            $qrCode->writeFile('uploads/qr-code/item-'.$row->barcode.'.png');
                          ?>
                          <br>
                          <img src="{{asset('uploads/qr-code/item-'.$row->barcode.'.png')}}" style="width: 140px;">
                          
                          <br>{{$row->barcode}}<br>
                          <a href="{{url('admin/item/qrcode-print/'.$row->item_id)}}" target="_blank"  class="btn btn-primary btn-sm">
                            <i class="fa fa-print"></i> Print
                          </a>
                          <a href="{{url('admin/item')}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-backward"></i> Back
                          </a>
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
