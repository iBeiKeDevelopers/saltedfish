@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('button')
<a class="navbar-brand mr-auto hidden-xs" data-toggle="dropdown" href="#">
    商品分类<span class="caret"></span>
</a>
<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
	<a class="dropdown-item" href="/goods/category/食品">食&nbsp;&nbsp;&nbsp;&nbsp;品</a>
	<a class="dropdown-item" href="/goods/category/服饰">服&nbsp;&nbsp;&nbsp;&nbsp;饰</a>
	<a class="dropdown-item" href="/goods/category/生活用品">生活用品</a>
	<a class="dropdown-item" href="/goods/category/学习用品">学习用品</a>
	<a class="dropdown-item" href="/goods/category/电子产品">电子产品</a>
	<a class="dropdown-item" href="/goods/category/体育用品">体育用品</a>
	<a class="dropdown-item" href="/goods/category/音乐器材">音乐器材</a>
	<a class="dropdown-item" href="/goods/category/非实体商品">非实体商品</a>
	<li class="divider"></li>
	<a class="dropdown-item" href="/goods/all">所有商品</a>
</div>
@endsection

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders/{{ Auth::id() }}">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders/{{ Auth::id() }}">我的订单</a>
@endsection

@section('form')
<form class="navbar-form navbar-right form-inline hidden-xs" role="search" method="GET">
	@csrf
    <div class="form-group col-md-9">
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
			    <img src="storage/banner/1.jpg" class="img-responsive" style="width:100%;" alt="First slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/2.jpg" class="img-responsive" style="width:100%;" alt="Second slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/3.jpg" class="img-responsive" style="width:100%;" alt="Third slide">
		    </div>
	    </div>
    </div> 
</div>
<script>
	$('.carousel').carousel('cycle')
</script>

<!-- goods -->
<style>
	.img-wrapper {
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		width: 100%;
		height: 12em;
	}
</style>
<div style="padding-top:5%;"></div>
<div id="goodsCards">
<div  class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="float-left">最近上架</div>
				</div>
				<div class="card-body" v-html="cards[0].content"></div>
			</div>
		</div>
	</div>
</div>
<div style="padding-top:5%;"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="float-left">热门商品</div>
				</div>
				<div class="card-body" v-html="cards[1].content"></div>
			</div>
		</div>
	</div>
</div>
<div style="padding-top:5%;"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="float-left">随机推荐</div>
				</div>
				<div class="card-body" v-html="cards[2].content"></div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- scripts -->
<script type="text/javascript" src="js/axios.min.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<script>
new Vue({
	el: "#goodsCards",
	data: {
		cards: [{
			url: "/api/goods/new",
			content: "",
		},{
			url: "/api/goods/hot",
			content: "",
		},{
			url: "/api/goods/random",
			content: "",
		}],
	},
	mounted: function () {
		this.showGoods(getListCallback)
	},
	methods: {
		showGoods: function (getList) {
			this.cards.forEach(function (item) {
				getList(item.url)
					.then(function (content) {
						item.content = content
					})
			})
		},
	},
})

async function getListCallback(url) {
	await axios.get(url)
		.then(function (res) {
			content=""
			if(!res.data.length)
				return content = emptyCallback()
			res.data.forEach(function (item) {
				content += "<div class='thumbnail col-md-3 col-xs-6  float-left'><a href='/goods/"+item.id+"'><div class='img-wrapper' style='background-image: url(" +"\""+ item.thumbnail.src +"\""+ ");'></div><div class='caption'><h4 style='max-height:1em;width:100%;overflow:hidden;text-overflow:ellipsis;'>"+item.title+"</h4><p>￥"+item.cost+"</p></div></div>"
			})
		})
		.catch(function() {
			content = errorCallback()
		})
	return content

	function errorCallback () {
		return "<div class='text-info'>网络出了点小问题，刷新试试～</div>"
	}

	function emptyCallback () {
		return "<div class='img-wrapper' style='height:22em;background-image: url(\"/storage/404.png\")'></div>"
	}
}
</script>
@endsection