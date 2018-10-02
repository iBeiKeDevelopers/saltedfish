@extends('layouts.app')

@section('title', '查看商品')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light hidden-xs hidden-sm">
    <div class="container">
		<div class="
				navbar-header
				second-header
				main-default main-shadow
			"
			style="width:10%">
            <div>商品分类</div>
        </div>
		<ul class="
				mr-auto
				nav navbar-nav navbar-left
				navbar-second
				main-gradient main-shadow
			" style="width:90%">
	        <li><a  href="/goods/category/食品">食品</a></li>
	        <li><a href="/goods/category/服饰">服饰</a></li>
	        <li><a href="/goods/category/生活用品">生活用品</a></li>
	        <li><a href="/goods/category/学习用品">学习用品</a></li>
	        <li><a href="/goods/category/电子产品">电子产品</a></li>
	        <li><a href="/goods/category/体育用品">体育用品</a></li>
	        <li><a href="/goods/category/音乐器材">音乐器材</a></li>
	        <li><a href="/goods/category/非实体商品">非实体商品</a></li>
            <li><a href="/goods/all">所有商品</a></li>
        </ul>
    </div>
</nav>
@endsection

@section('content')
<meta name="goods_id" content="{{ $id }}">
<link href="{{ asset('css/goodsShow.css') }}" rel="stylesheet">

<div id="singleItem" class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                        <!-- carousel slide -->
                        <div class="col-lg-6 image-slide float-left">
                            <goods-carousel></goods-carousel>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="goods-title left-align col-xs-12">
                                {{ $title }}
                            </div>
                            <div class="goods-cost left-align col-xs-12 main-default main-content">
                                {{ $cost }}
                            </div>
                            <div class="left-align col-xs-12">
                                <div class="goods-info left-align col-xs-12">
                                    <template v-if="{{ $status }}">
                                        <div class="float-left">状态：缺货</div>
                                        </template>
                                    <template v-else>
                                        <div class="float-left">状态：{{ $type ? '出租' : '出售' }}&nbsp;&nbsp;</div>
                                        <div class="float-left">库存：{{ $remain }}</div>
                                    </template>
                                </div>
                                <div class="left-align col-xs-12">
                                    <button id="btn-gradient" class="btn btn-lg" type="button">创建订单</button>
                                </div>
                                <div class="left-align col-xs-12">
                                    <button class="btn btn-link" type="button">联系卖家</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="home-padding"></div>
            <div class="card main-background main-shadow">
                <div class="card-header main-gradient">
                    <div class="card-title">卖家留言</div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 background-default">
                        <div class="col-xs-4 col-md-2">
                            <div class="circle-avatar" style="background-image:url('{{ App\User::find($owner)->avatar ?? '/storage/null.png' }}');margin-top:10px;" alt="avatar"></div>
                            <div class="uname">{{ App\User::find($owner)->nick_name }}</div>
                        </div>
                        <div class="col-xs-8 col-md-10">
                            <p class="goods-description">{{ $description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-padding"></div>
            <goods-comment></goods-comment>
            <div class="home-padding"></div>            
        </div>
    </div>
</div>
@endsection