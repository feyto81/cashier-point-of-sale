@extends('layouts.main')
@section('title','Edit Category | Kasir')
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
                <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
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
