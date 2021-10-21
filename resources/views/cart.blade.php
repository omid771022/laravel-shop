@extends('layouts.master')
@section('content')
    <article class="container article">
        @include('layouts.header-ads')

@if(count(Cart::all())>0)
    

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>عنوان محصول</th>
                        <th>قیمت واحد</th>
                        <th>قیمت نهایی</th>
                        <th>عملیات</th>

                    </tr>
                </thead>
                <tbody>


                    @foreach (\Cart::all() as $key => $cart)
                        @php
                            
                            $product = $cart['Course'];
                            
                            $sumProducts = $product->sum('price');
                        @endphp
                        <tr role="row" class="">

                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->getFinalPrice() }}</td>

                            <td>
                                <form action="{{ route('cart.delete', $cart['id']) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm(' ایا مطمن هستید که میخواهید خرید را حذف کنید ')"
                                        type="submit" class="item-delete " title="حذف"></button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                    <tr>
                        <th colspan="2"> قیمت نهایی کل سفارش </th>

                        <th colspan="1">
                            {{ \Cart::all()->sum('price') }}

                        </th>


                    </tr>
                    <tr>
                    <th><form action="{{route('payment.cart')}}" method="GET" >
                    
                   <button type="submit" class="btn btn-primary">پرداخت </button>
                    </form></th>

                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <h1> سبد خرید شما خالی است </h1>
        @endif

        <br>
        <br>
        <br>
    @endsection
