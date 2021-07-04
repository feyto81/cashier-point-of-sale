@extends('layouts.main')
@section('title','Edit Category | Kasir')
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
      <li><a class="treeview-item active" href="{{url('admin/category')}}"><i class="icon fa fa-circle-o"></i> Categories</a></li>
      <li><a class="treeview-item" href="{{url('admin/unit')}}"><i class="icon fa fa-circle-o"></i> Units</a></li>
      <li><a class="treeview-item" href="{{url('admin/item')}}"><i class="icon fa fa-circle-o"></i> Items</a></li>

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
          <h1><i class="fa fa-archive"></i> Edit Category</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Product</a></li>
          <li class="breadcrumb-item"><a href="">Edit Category</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/category')}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"  aria-hidden="true"></i> Back</a>&nbsp;
        </div>
      </div>
      <br>
      @if (count($errors) > 0)
      <div class="row">
        <div class="col-lg-12">
          <div class="bs-component">
            <div class="alert alert-dismissible alert-warning">
              <button class="close" type="button" data-dismiss="alert">×</button>
              <h4>Oops!</h4>
              <p>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </p>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">
              <form role="form" action="{{url('/admin/category/update/'.$category->category_id)}}" method="post">
                @csrf
                <div class="form-group">
                <label for="name">Category Name *</label>
                <input type="text" autocomplete="off" class="form-control" name="name" id="name" value="{{$category->name}}">
              </div>
            </div>
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection
