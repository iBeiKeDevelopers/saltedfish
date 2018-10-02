@extends('layouts.app')

@section('title', '贝壳人自己的商城')

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

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('form')
<form id="form" class="navbar-form navbar-right
		form-inline
		hidden-xs
		main-gradient"
	role="search"
	method="GET">
    <div class="form-group" style="width:80%;">
        <input type="text" class="form-control" name="keyword" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-search">搜索</button>
</form>
@endsection

@section('content')
<!-- banner -->
<div class="container">
    <div id="banner" class="carousel slide" data-ride="carousel">
	    <!-- carousel indicators -->
	    <ol class="carousel-indicators">
		    <li data-target="#banner" data-slide-to="0" class="active"></li>
    		<li data-target="#banner" data-slide-to="1"></li>
		    <li data-target="#banner" data-slide-to="2"></li>
	    </ol>   
	    <!-- carousel item -->
	    <div class="carousel-inner">
		    <div class="item active">
			    <img src="storage/banner/2.jpg" class="img-carousel img-responsive" alt="First slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/1.jpg" class="img-carousel img-responsive" alt="Second slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/3.jpg" class="img-carousel img-responsive" alt="Third slide">
		    </div>
	    </div>
    </div>
</div>

<home-card></home-card>
@endsection

@section('scripts')
<script>
	$('#banner').carousel('cycle')
</script>
@endsection