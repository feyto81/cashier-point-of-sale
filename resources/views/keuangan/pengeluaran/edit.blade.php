@extends('layouts.main')
@section('title','Edit Pengeluaran | Kasir Application')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Edit Pengeluaran</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Edit Pengeluaran</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Edit Pengeluaran</h3>
            <div class="tile-body">
              <form role="form" action="{{url('/pengeluaran/update-pengeluaran/'.$pengeluaran->pengeluaran_id)}}" method="post">
                {{ csrf_field() }}
                <div class="form-group{{$errors->has('pengeluaran_count') ? 'has-error' : '' }}">
                <label for="pemasukan_count">Jumlah *</label>
                <input type="number" class="form-control" name="pengeluaran_count" id="pengeluaran_count" value="{{$pengeluaran->pengeluaran_count}}">
                @if($errors->has('pengeluaran_count'))
                <span class="text-danger">
                    <small>{{$errors->first('pengeluaran_count')}}</small>
                </span>
                 @endif
              </div>
              <div class="form-group{{$errors->has('keterangan') ? 'has-error' : '' }}">
                <label for="keterangan">Keterangan *</label>
                <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{$pengeluaran->keterangan}}">
                @if($errors->has('keterangan'))
                    <span class="text-danger">
                        <small>{{$errors->first('keterangan')}}</small>
                    </span>
               @endif
              </div>
            </div>
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-danger">Reset</button>&nbsp;
              <a href="{{url('finance/pengeluaran/all')}}" class="btn btn-warning">Back</a>
            </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection