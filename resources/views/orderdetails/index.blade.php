@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name Product</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orderdetails == '')
                        <tr>
                            <td colspan="6" class="text-danger">*คุณยังไม้ได้เลือกซื้อสินค้า</td>
                        </tr>
                        @else
                        
                        <?php $i =0; ?>
                        @foreach ($orderdetails as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td><img src="{{ asset($item->product->picture) }}" alt="" style="object-fit: cover" width="100" height="100"></td>
                            <td>{{ $item->product->price }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <form action="{{ route('orderdetails.update', $item->id ) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="minus" value="1">
                                    <input type="submit" class="btn btn-danger" value="-">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">ยอดรวมทั้งหมด</td>
                            <td colspan="1">{{ $orderdetails[0]->order->total }}</td>
                        </tr>
                    </tfoot>
                </table>
                <form action="{{ route('orders.update', $orderdetails[0]->order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="submit" class="btn btn-warning" value="ยืนยันสั่งซื้อ">
                </form>
                @endif
            </div>{{-- end card body --}}
        </div>
    </div>
@endsection