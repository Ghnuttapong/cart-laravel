@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if ($order === '') 
                    <h4 class="text-danger text-center">*ไม่มีรายการสั่งซื้อ</h4>
                @endif
                    <div class="row">
                        <div class="col-md-10">
                            <h4>การชำระเงิน</h4>
                            {{-- form --}}
                            <form action="{{ route('payments.update', $order->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('image/payments/bank/pay.jpg') }}" alt="" class="rounded" width="400" height="400" srcset="">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">สลิปการชำระเงิน</label>
                                    <input type="file" name="picture" class="form-control" id="">
                                    @error('picture')
                                        <p class="text-danger">*{{ $message }}</p> 
                                    @enderror
                                    <input type="submit" value="ยืนยัน" class="btn btn-success mt-3 w-100">
                                </div>
                            </div>
                            </form>
                            {{-- form --}}
                        </div>
                        <div class="col-md-2">
                            <div class="overflow-auto" style="height: 500px">
                                <h4>รายการสินค้า</h4>
                                @foreach($order->orderdetails as $item)
                                    <div class="card mb-2">
                                        <div class="card-body text-center">
                                            <img src="{{ asset($item->product->picture) }}" alt="" width="100" height="100" srcset="">
                                            {{ $item->product->name }}
                                            <br>
                                            จำนวน {{$item->amount}} ชิ้น
                                            <p>ราคา <span class="text-success">{{ $item->product->price }}</span> บาท</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-end">
                ยอดที่ต้องชำระ <b class="text-success">{{ $order->total }}</b> บาท
            </div>
        </div>
    </div>
@endsection