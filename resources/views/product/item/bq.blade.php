@extends('layouts.main')
@section('title','Barcode and QR-Code | Kasir Application')
@section('menu')
<ul class="app-menu">
  @if(auth()->user()->level_id == '1')
  <li><a class="app-menu__item" href="{{url('admin/home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Supplier</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('admin/supplier/create')}}"><i class="icon fa fa-circle-o"></i> Add Supplier</a></li>
      <li><a class="treeview-item" href="{{url('admin/supplier')}}"><i class="icon fa fa-circle-o"></i> List Supplier</a></li>
    </ul>
  </li>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('admin/customer/create')}}"><i class="icon fa fa-circle-o"></i> Add Customer</a></li>
      <li><a class="treeview-item" href="{{url('admin/customer')}}"><i class="icon fa fa-circle-o"></i> List Customer</a></li>
    </ul>
  </li>
  <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('admin/category')}}"><i class="icon fa fa-circle-o"></i> Categories</a></li>
      <li><a class="treeview-item" href="{{url('admin/unit')}}"><i class="icon fa fa-circle-o"></i> Units</a></li>
      <li><a class="treeview-item active" href="{{url('admin/item')}}"><i class="icon fa fa-circle-o"></i> Items</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('admin/sales')}}"><i class="icon fa fa-circle-o"></i> Sales</a></li>
      <li><a class="treeview-item" href="{{url('admin/stock-in')}}"><i class="icon fa fa-circle-o"></i> Stock In</a></li>
      <li><a class="treeview-item" href="{{url('admin/stock-out')}}"><i class="icon fa fa-circle-o"></i> Stock Out</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-usd"></i><span class="app-menu__label">Finance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      
      <li><a class="treeview-item" href="{{url('admin/finance/pengeluaran')}}"><i class="icon fa fa-circle-o"></i> Pengeluaran</a></li>
      <li><a class="treeview-item" href="{{url('admin/finance/akumulasi')}}"><i class="icon fa fa-circle-o"></i> Akumulasi</a></li>
    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '3')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('admin/report/day')}}"><i class="icon fa fa-circle-o"></i> Day</a></li>
      <li><a class="treeview-item" href="{{url('admin/report/month')}}"><i class="icon fa fa-circle-o"></i> Month</a></li>
      <li><a class="treeview-item" href="{{url('admin/report/year')}}"><i class="icon fa fa-circle-o"></i> Year</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1')
  <li><a class="app-menu__item" href="{{url('admin/users')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2' || auth()->user()->level_id == '3')
   <li><a class="app-menu__item" href="{{url('admin/profile')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profile</span></a></li>
   @endif
   @if(auth()->user()->level_id == '1')
   <li><a class="app-menu__item" href="{{url('admin/logActivity')}}"><i class="app-menu__icon fa fa-bookmark"></i><span class="app-menu__label">Log Activity</span></a></li>
   @endif
</ul>
@endsection
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
