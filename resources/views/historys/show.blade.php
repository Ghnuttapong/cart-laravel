@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    
                    @foreach ($orderdetails as $item)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset($item->product->picture) }}" style="object-fit: cover" width="150" height="150" alt="" srcset="">
                                    <h4 class="text-primary my-2">{{ $item->product->name }}</h4>
                                    <hr>
                                    <p>ราคา {{ $item->product->price }} บาท</p>
                                    <p>จำนวน {{ $item->amount }} ชิ้น</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
