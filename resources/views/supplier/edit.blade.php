@extends('layouts.main')
@section('title','Edit Supplier | Kasir')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Edit Supplier</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Edit Supplier</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/supplier')}}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"  aria-hidden="true"></i> Back</a>&nbsp;
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
        <div class="col-md-12">
          <div class="tile">
           
            <div class="tile-body">
              <form role="form" action="{{url('admin/supplier/update/'.$supplier->supplier_id)}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                <label for="name">Supplier Name *</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$supplier->name}}">
                
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$supplier->phone}}">
                
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control">{{$supplier->address}}</textarea>
                
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description" value="{{$supplier->description}}">
              </div>
            </div>
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-danger">Reset</button>
            </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection