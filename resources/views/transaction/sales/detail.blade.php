@extends('layouts.main')
@section('title','Invoice | Kasir Application')
@section('content')
<title>Detail | Kasir</title>
<style>
.table {
  border-collapse: collapse;
  width: 100%;
}

.td {
  color:black;
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
<main class="app-content">
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><i class="fa fa-globe"></i> Invoice</h2>
            </div>
            <div class="col-6">
                    @foreach ($data as $k)
                     <h5 class="text-right">Date: {{$k->created}}</h5>
                
              
            </div>
          </div>
          <div class="row invoice-info">
           
            <div class="col-4"><b>Invoice : {{$k->sale_id}}</b><br><b> Kasir&nbsp;&nbsp;&nbsp;&nbsp;     :  {{$k->name}}</b> <br></div>
            <br>
            @endforeach
            @foreach($detailtransaksi as $row)
                <div class="col-8"><b>Customer Name : {{$row->customer_name}}</b><br><b></div>
            @endforeach


        </div>
          
          <br>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($detailtransaksi as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->name}}</td>
                        <td class="td">{{$row->qty}}</td>
                        <td class="td">{{$row->price}}</td>
                        <td class="td">{{$row->total}}</td>

                    </tr>
                    @endforeach
                    @foreach ($data as $l)
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Total Semua Barang : </td>
                        <td class="td">{{$l->total_price}}</td>
                        <input type="hidden" id="" value="{{$l->total_price}}">
                    </tr>
                    
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Diskon : </td>
                        <td class="td">{{$l->discount}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->discount}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Total Kesuluruhan : </td>
                        <td class="td">{{$l->final_price}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->final_price}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Bayar : </td>
                        <td class="td">{{$l->cash}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->cash}}">
                    </tr>
                    
                    
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Kembalian : </td>
                        <td class="td">{{$l->remaining}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->remaining}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Note : </td>
                        <td class="td">{{$l->note}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->note}}">
                    </tr>
                    
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="{{ url('admin/sales/cetak/'.$l->sale_id) }}" target="_blank"><i class="fa fa-print"></i> Print</a>
                <a href="{{ url('admin/sales/') }}" class="btn btn-danger"><i class="fa fa-backward"></i>Back</a></div>
           
          </div>
        </section>
        @endforeach

      </div>
    </div>
  </div>

</main>
@endsection