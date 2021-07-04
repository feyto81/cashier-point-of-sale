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
              <p><b>{{$user}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Customer</h4>
              <p><b>{{$customer}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-truck fa-3x"></i>
            <div class="info">
              <h4>Supplier</h4>
              <p><b>{{$supplier}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Category</h4>
              <p><b>{{$category}}</b></p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-archive fa-3x"></i>
            <div class="info">
              <h4>Unit</h4>
              <p><b>{{$unit}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-book fa-3x"></i>
            <div class="info">
              <h4>Item</h4>
              <p><b>{{$item}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
            <div class="info">
              <h4>Transaction</h4>
              <p><b>{{$sales}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h4>Pemasukan</h4>
              <p><b>@currency($pemasukan)</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h4>Pengeluaran</h4>
              <p><b>@currency($pengeluaran)</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h4>Laba</h4>
              <p><b>@currency($laba)</b></p>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Grafik Penjualan Perbulan</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="myChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Grafik Penjualan Pertahun</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="myChartt"></canvas>
            </div>
          </div>
        </div>
      </div>

      
    </main>
    <?php
    foreach ($data as $item) {
        $bulan[] = $item->Bulan;
        $pendapatan[] = $item->Pendapatan;
        }    
    ?>
    <?php
    foreach ($tahun as $row) {
        $th[] = $row->Tahun;
        $pendapatan1[] = $row->Pendapatan1;
        }    
    ?>
    @include('sweetalert::alert')

  @endsection
  @push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"> </script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {

          labels: <?php echo json_encode($bulan)?>,
          datasets: [{
              label: '# Income',
              data: <?php echo json_encode($pendapatan)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  
  </script>
  <script>
     var ctx = document.getElementById('myChartt').getContext('2d');
      var myChart = new Chart(ctx, {
      type: 'bar',
      data: {

          labels: <?php echo json_encode($th)?>,
          datasets: [{
              label: '# Income',
              data: <?php echo json_encode($pendapatan1)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>  
@endpush