@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders/{{ Auth::id() }}">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders/{{ Auth::id() }}">我的订单</a>
@endsection

@section('form')
<form action="/" class="navbar-form navbar-right form-inline hidden-xs" role="search" method="PUT">
    <div class="form-group col-xs-9">
        <input type="text" class="form-control" name="keyword" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-default col-xs-3">搜索</button>
</form>
@endsection

@section('content')

@endsection