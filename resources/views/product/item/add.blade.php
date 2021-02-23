@extends('layouts.main')
@section('title','Add Item | Kasir')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-archive"></i> Add Item</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"></a></li>
          <li class="breadcrumb-item"><a href="#">Add Item</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('admin/item')}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"  aria-hidden="true"></i> Back</a>&nbsp;
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
      <form action="{{url('admin/item/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
              <div class="tile">
                <div class="tile-body">
                  
                    <div class="form-group">
                      <label class="control-label" for="barcode">Barcode *</label>
                      <input type="text" class="form-control" name="barcode" id="barcode">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Product Name *</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="category_id">Category *</label>
                        <select name="category_id" id="category_id" class="form-control demoSelect">
                          <option disabled selected>--Select Category-- </option>
                          @foreach ($category as $row)
                            <option value="{{$row->category_id}}">{{$row->name}}</option>
                          @endforeach
                        </select>
                    </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                  <div class="tile-body">
                    
                        <div class="form-group">
                            <label for="unit_id">Unit *</label>
                                <select name="unit_id" id="unit_id" class="form-control demoSelect">
                                <option disabled selected>--Select Unit-- </option>
                                @foreach ($unit as $row)
                                    <option value="{{$row->unit_id}}">{{$row->name}}</option>
                                @endforeach
                                </select>
                        </div>
                      <div class="form-group">
                          <label class="control-label" for="name">Price *</label>
                          <input type="text" class="form-control" name="price" id="price">
                      </div>
                      <div class="form-group">
                        <label for="image">Image *</label>
                        <input type="file" class="form-control" name="image" id="image">
                        
                      </div>
                      
                    
                  </div>
                  <div class="tile-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                  </div>
                </div>
            </div>
          </div>
      </form>
      
    </main>
    @include('sweetalert::alert')
@endsection