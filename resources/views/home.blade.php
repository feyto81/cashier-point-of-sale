@extends('layouts.main')
@section('title','Home | Kasir')
@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-user fa-3x"></i>
          <div class="info">
            <h4>Users</h4>
            <p><b>4</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Customer</h4>
            <p><b>13</b></p>
          </div>
        </div>
      </div>



    </div>


    
  </main>

@endsection