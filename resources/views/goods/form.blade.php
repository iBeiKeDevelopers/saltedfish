@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('content')
<meta name="id" content="{{ $id }}">
<goods-form></goods-form>
@endsection