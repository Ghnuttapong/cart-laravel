@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="card">
           <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
               <div class="card-body">
                   <h1 class="text-center">Update Product</h1>
                   <div class="row">
                       <div class="col-md-4">
                       </div>
                       <div class="col-md-4">
                           <img src="{{ asset($product->picture) }}" width="100%" height="300" style="object-fit: cover" alt="">
                        </div>
                        <div class="col-md-4">
                        </div>
                       <div class="col-md-6 form-group">
                           <label for="" class="form-lable text-capitalize">name</label>
                           <input type="text" class="form-control" value="{{ $product->name }}" name="name">
                           @error('name')
                            <span class="text-danger">{{ $message }}</span>    
                           @enderror
                        </div>
                       <div class="col-md-6 form-group">
                           <label for="" class="form-lable text-capitalize">price</label>
                           <input type="number" class="form-control" value="{{ $product->price }}" name="price">
                           @error('price')
                            <span class="text-danger">{{ $message }}</span>    
                           @enderror
                        </div>
                       <div class="col-md-6 form-group">
                           <label for="" class="form-lable text-capitalize">picture</label>
                           <input type="file" class="form-control" value="{{ $product->picture }}" name="picture">
                           <p class="text-danger">*หากไม้ได้เลือกไฟล์จะใช้รูปสินค้าเดิม</p>
                           @error('picture')
                            <span class="text-danger">{{ $message }}</span>    
                           @enderror
                        </div>
                       <div class="col-md-6 form-group">
                           <label for="" class="form-lable text-capitalize">amount</label>
                           <input type="number" class="form-control" value="{{ $product->amount }}" name="amount">
                           @error('amount')
                            <span class="text-danger">{{ $message }}</span>    
                           @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-80">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
        </div>
   </div>
@endsection