<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="js/axios.min.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

@extends('layouts.app')

@section('title', '信息修改')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="profile">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="profile">个人中心</a>

<a class="dropdown-item hidden-xs" href="password/reset">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="password/reset">我的订单</a>

<a class="dropdown-item hidden-xs" href="password/reset">我的商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="password/reset">我的商品</a>

<a class="dropdown-item hidden-xs" href="password/reset">修改密码</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="password/reset">修改密码</a>
@endsection

@section('content')

@endsection