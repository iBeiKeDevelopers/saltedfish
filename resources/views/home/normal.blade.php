@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('button')
<a class="navbar-brand mr-auto hidden-xs" data-toggle="dropdown" href="#">
    所有商品<span class="caret"></span>
</a>
<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
	<a class="dropdown-item -xs" href="#">aaa</a>
	<a class="dropdown-item hidden-xs" href="#">bbb</a>
	<a class="dropdown-item hidden-xs" href="#">ccc</a>
	<a class="dropdown-item hidden-xs" href="#">ddd</a>
</div>
@endsection

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders/{{ Auth::id() }}">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders/{{ Auth::id() }}">我的订单</a>
@endsection

@section('form')
<form class="navbar-form navbar-right form-inline hidden-xs" role="search" method="PUT">
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
			    <img src="storage/banner/beijing.png" class="img-responsive" style="width:100%;" alt="First slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/chat_bg.jpg" class="img-responsive" style="width:100%;" alt="Second slide">
		    </div>
		    <div class="item img-responsive">
			    <img src="storage/banner/ustb.png" class="img-responsive" style="width:100%;" alt="Third slide">
		    </div>
	    </div>
	    <!-- carousel guide -->
	    <a class="left carousel-control" href="#banner" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#banner" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	    </a>
    </div> 
</div>

<!-- goods -->
<div style="padding-top:5%;"></div>
<div id="goodsCards">
<div  class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="float-left">分类一</div>
					<div class="rounded float-right"><a href="/goods/category/fenleiyi">更多</a></div>
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
					<div class="float-left">分类二</div>
					<div class="rounded float-right"><a href="/goods/category/fenleiyi">更多</a></div>
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
					<div class="float-left">分类三</div>
					<div class="rounded float-right"><a href="/goods/category/fenleiyi">更多</a></div>
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
			url: "/api/goods?num=4",
			content: "",
		},{
			url: "/api/goods?num=4",
			content: "",
		},{
			url: "/api/goods?num=4",
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
					.catch(errorCallback())
			})

			function errorCallback() {}
		},
	},
})

async function getListCallback(url) {
	await axios.get(url)
		.then(function (res) {
			content=""
			res.data.forEach(function (item) {
				content += "<div class='img-wrapper'><div class='thumbnail col-md-3 col-xs-6  float-left'><img src="+item.thumbnail.src+" style='height:10em;max-width:100%'><div class='caption'><h3>aaa</h3></div></div>"
			})
		})
		.catch(errorCallback())
	return content

	function errorCallback () {

	}

	function emptyCallback () {

	}
}
</script>
@endsection