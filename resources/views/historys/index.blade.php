@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if ($his_orders === '')
                    <p class="text-danger">*ไม่พบรายการที่เคยสั่งซื้อ</p>
                    
                @else
                <h3 class="text-center mb-4">รายการสั่งซื้อของคุณ</h3>
                <div class="row">
                    <?php $i = 0 ?>
                    @foreach ($his_orders as $item)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>รายการที่ {{ ++$i }}</h4>
                                <img src="{{ asset($item->bill) }}" alt="" width="150" height="150" style="object-fit: cover" srcset="">
                                <br>
                                <br>
                                <p>ราคาทั้งหมด <span class="text-success">{{ $item->total }}</span> บาท</p>
                                <a href="{{ route('historys.show', $item->id) }}" class="btn btn-primary mt-2 w-100">ดูรายละเอียด</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection