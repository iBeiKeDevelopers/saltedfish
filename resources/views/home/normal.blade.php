@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item hidden-xs" href="/orders/{{ Auth::id() }}">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders/{{ Auth::id() }}">我的订单</a>
@endsection

@section('form')
<form class="navbar-form navbar-right form-inline hidden-xs" role="search" method="PUT">
    <div class="form-group col-xs-9">
        <input type="text" class="form-control" name="keyword" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-default col-xs-3">搜索</button>
</form>
@endsection

@section('content')
<!-- banner -->
<div class="container" style="height:25%;">
    <div id="banner" class="carousel slide">
	    <!-- carousel -->
	    <ol class="carousel-indicators">
		    <li data-target="#banner" data-slide-to="0" class="active"></li>
    		<li data-target="#banner" data-slide-to="1"></li>
		    <li data-target="#banner" data-slide-to="2"></li>
	    </ol>   
	    <!-- carousel item -->
	    <div class="carousel-inner">
		    <div class="item active">
			    <img src="storage/banner/beijing.png" class="img-responsive" alt="First slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/chat_bg.jpg" class="img-responsive" alt="Second slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/ustb.png" class="img-responsive" alt="Third slide">
		    </div>
	    </div>
	    <!-- carousel guide -->
	    <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#banner" role="button" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	    </a>
    </div> 
</div>

<!-- goods -->

@endsection