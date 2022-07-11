@extends('main')
@section('body')

<div style="text-align:center;">   
<form method="POST">
  <input name="name" type="name" placeholder="name"><br>
<input name="email" type="email" placeholder="email">
<br>
<input name="password" type="password" placeholder="password"><br>
<input type="submit" value="register">
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

</form>
</div>
@stop