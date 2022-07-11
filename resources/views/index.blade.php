@extends('main')

@section('body')
<div style="text-align:center;direction:rtl">
    <h3>خوش آمدید</h3>

    <div style="display:flex;justify-content: center;">
        @foreach($products as $product)
        <div style="text-align:center;margin:2rem;border: 1px solid;border-radius:4px;padding:3px">
            {{$product->title}}<br>
            <img src="{{$product->photo}}" style="max-width:10rem" /><br>
            {{$product->price}} تومان
            <br>
            <a class="btn btn-success " href="/addToCart/{{$product->id}}">خرید</a>
        </div>
        @endforeach
    </div>


    <div style="font-size: 1.5rem;font-weight:bold">
        @if($cart != null)

        سبد خرید :
        <br><br>

        @php
        $total = 0;
        @endphp
        @foreach ($cart as $item)
        {{$item->title}} {{$item->count}} عدد

        @php
        $total += $item->count * $item->price
        @endphp
        <hr>
        @endforeach

        مجموع : {{number_format($total)}} تومان

        <br> <br>
        <a  href="checkout" class="btn btn-primary btn-lg"> ثبت نهایی سفارش</a>
        @endif

    </div>
</div>


@stop