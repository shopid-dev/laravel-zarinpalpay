@extends('main')
@section('body')

<div style="text-align:center">

  <h1>سفارش با موفقیت ثبت شد</h1>
  <h2>شماره ی سفارش :‌ {{$order->id}}</h2>


  
  <h2>مبلغ قابل پرداخت :‌ {{number_format($order->amount)}} تومان</h2>
  <h2>


  <a href="/zarinpalpay/{{$order->id}}" class="btn btn-primary btn-lg"> پرداخت آنلاین</a></h2>

</div>
@stop