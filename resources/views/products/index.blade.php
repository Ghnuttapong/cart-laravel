@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create</a>
        {{--  วิธีเรียกใช้ค่า get ส่งมากับ with   
            @if ($message = Session::get('status'))
                <div class="alert alert-success">{{$message}}</div>
            @endif 
        --}}
        <div class="row">
            {{-- item products --}}
            @foreach ($products as $item)
                <div class="col-md-3 my-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset($item->picture) }}" style="object-fit: cover" height="150" width="150"  alt="">
                            </div>
                            <hr class="my-2">
                            <h4 class="fw-bold">{{ $item->name }}</h4>
                            <h4 class="text-success">฿{{ $item->price }}</h4>
                            @if ($item->amount > 0)
                                <p class="text-muted">สินค้าคงเหลือ {{ $item->amount }} ชิ้น</p>
                            @else    
                                <p class="text-danger">* สินค้าคงเหลือ 0 ชิ้น</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            @if ($item->amount == 0)
                                <button type="submit" disabled class="btn btn-secondary w-100">Buy</button>
                            @else
                            <form action="{{ route('orders.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-secondary w-100">Buy</button>
                            </form>
                            @endif
                            <form action="{{ route('products.destroy', $item->id) }}" class="w-100 mt-2" method="post">
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $products->links('pagination::bootstrap-5') !!}

    </div>
@endsection