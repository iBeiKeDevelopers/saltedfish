@extends('layouts.app')

@section('title', '信息修改')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>

<a class="dropdown-item hidden-xs" href="/goods">我的商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/goods">我的商品</a>

<a class="dropdown-item hidden-xs" href="/password/reset">修改密码</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/password/reset">修改密码</a>
@endsection

@section('content')
<div id="userInfo" class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <breadcrumb separator=">">
                    <breadcrumb-item to="/home">个人中心</breadcrumb-item>
                    <breadcrumb-item>个人信息编辑</breadcrumb-item>
                    </breadcrumb>
                </div>
                <user-profile user-id="{{ Auth::id() }}"></user-profile>
            </div>
        </div>
    </div>
</div>
@endsection