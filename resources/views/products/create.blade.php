@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center my-4">Create Product</h1>
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label for="" class="form-label text-capitalize">name</label>
                            <input type="text" class="form-control" name="name" id="">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 my-3">
                            <label for="" class="form-label text-capitalize">price</label>
                            <input type="number" class="form-control" name="price" id="">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 my-3">
                            <label for="" class="form-label text-capitalize">picture</label>
                            <input type="file" name="picture" class="form-control" id="">
                            @error('picture')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 my-3">
                            <label for="" class="form-label text-capitalize">amount</label>
                            <input type="number" class="form-control" name="amount" id="">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success w-100">
                </form>
            </div>
        </div>
    </div>
@endsection