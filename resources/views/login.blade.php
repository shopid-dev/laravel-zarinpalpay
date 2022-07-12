@extends('main')

@section('body')
    <div style="text-align:center;">   
<h1>ورود کاربر </h1>
<form method="POST">
<input name="email" value="" type="email" placeholder="email">
<br>
<input name="password" value="" type="password" placeholder="password"><br>
<input type="submit" value="login"><br>
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

</form>
<br>
تازه واردید ؟  <a href="/register">عضویت</a>
</div>
@stop
