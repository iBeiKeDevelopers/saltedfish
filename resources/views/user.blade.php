@extends('layouts.app')

@section('title', '个人中心')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/user/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/orders">我的订单</a>

<a class="dropdown-item hidden-xs" href="/user/{{ Auth::id() }}/goods">我的商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/{{ Auth::id() }}/goods">我的商品</a>

<a class="dropdown-item hidden-xs" href="/goods/create">上传商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/goods/create">上传商品</a>

<a class="dropdown-item hidden-xs" href="">修改密码</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="">修改密码</a>
@endsection

@section('content')
<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">
					<div class="float-left">个人信息</div>
					<div class="rounded float-right"><a href="profile">编辑</a></div>
				</div>
				<div class="card-body">
					<img class="float-left img-thumbnail" src="{{ Auth::user()->avatar ?? '/storage/null.png' }}" style="max-width:30%;">
					<div id="profile" class="" style="padding-left:40%">
						<table class="table">
  							<tbody>
    							<tr>
      								<td>昵称</td>
      								<td>{{ Auth::user()->nick_name }}</td>
    							</tr>
    							<tr>
      								<td>uid</td>
      								<td>{{ Auth::id() }}</td>
    							</tr>
								<tr>
									<td>宿舍楼</td>
									<td>{{ App\User::find(Auth::id())->contact->domitory ?? '-' }}</td>
								</tr>
								<tr>
									<td>联系方式</td>
									<td>{{ App\User::find(Auth::id())->contact->phone ?? '-' }}</td>
								</tr>
  							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="padding:3%"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="list" class="card">
				<div class="card-header">
					<div class="float-left">最近订单</div>
					<div class="float-right"><a href="orders">更多</a></div>
				</div>
				<div class="card-body">
					<div>
						<ul class="nav nav-tabs">
							<li :class="flag==0?'active':''">
								<a href="#" @click="showOrderBuy">我买的</a>
							</li>
							<li :class="flag==1?'active':''">
								<a href="#" @click="showOrderSell">我卖的</a>
							</li>
						</ul>
					</div>
					<div>
						<ul class="list-group">
							<template v-if="Array.isArray(goodsList)">
								<template v-for="item in goodsList">
									<li class="home-padding list-group-item">
										<a :href="'/orders/'+item.id">
											<img :src="item.thumbnail.src" 
												class="img-thumbnail float-left"
												style="width:30%" alt="thumbnail">
										</a>
										<div class='pre-scrollable float-left'
											style='padding-left:5%;width:65%;overflow:hidden;'>
											<table class='table table-striped table-condensed'>
												<tbody>
													<tr>
														<td>标题</td>
														<td>@{{ item.title }}</td>
													</tr>
													<tr>
														<td>类型</td>
														<td>
															<template v-if="item.type">租赁</template>
															<template v-else>出售</template>
														</td>
													</tr>
													<tr>
														<td>价格</td>
														<td>￥ @{{ item.cost }}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</li>
								</template>
							</template>
							<!-- error -->
							<template v-else-if="goodsList == 'error'">
								<li class="home-padding list-group-item">
									error!
								</li>
							</template>
							<!-- empty -->
							<template v-else>
								<li class="home-padding list-group-item">
									<img class="img-responsive" src="/storage/404.png">
								</li>
							</template>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var orderList = new Vue({
		el: "#list",
		data: {
			uid: 1,//{{ Auth::id() }},
			content: "",
			project: 0,
			flag: 0,
			goodsList: [],
		},
		mounted: function () {
			this.showOrderBuy()
		},
		methods: {
			showOrderBuy : function () {
				getList("orders/list/buy/2")
					.then(res => {
						this.goodsList = res
					})
				this.flag = 0
			},
			showOrderSell: function () {
				getList("orders/list/sell/2")
					.then(res => {
						this.goodsList = res
					})
				this.flag = 1
			},
		},
	})

	async function getList (url) {
		list = []
		await axios.get(url)
			.then(function (res) {
				list = res.data
			})
			.catch(function () {
				list = errorCallback()
			})
		return list
		
		function emptyCallback () {
			return "<div style='padding-top:5%;'></div><li class='list-group-item'><img class='img-responsive' src='storage/404.png'></li>"
		}

		function errorCallback () {
			return "error"
		}
	}
</script>
@endsection
