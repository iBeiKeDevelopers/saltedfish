<template>
    <div class="row justify-content-center">
        <div class="col-lg-8">
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
									<li :key="item.id" class="home-padding list-group-item">
										<div class="col-xs-12 col-md-6 float-left">
											<a :href="'/orders/'+item.id">
												<div :style="'background-image: url('+item.thumbnail.src+')'" 
													class="img-wrapper float-left"
													alt="thumbnail"></div>
											</a>
										</div>
										<div class='col-xs-12 col-md-6 pre-scrollable float-left'
											style='overflow:hidden;'>
											<table class='table table-striped table-condensed'>
												<tbody>
													<tr>
														<td>标题</td>
														<td>{{ item.title }}</td>
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
														<td>￥ {{ item.cost }}</td>
													</tr>
													<template v-if="flag">
														<tr>
															<td>买家</td>
															<td>{{ item.uid }}</td>
														</tr>
													</template>
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
</template>

<script>
export default {
    data() {
		return {
			uid: 0,
			content: "",
			project: 0,
			flag: 0,
			goodsList: [],
		}
	},
	mounted: function () {
		this.uid = document.getElementsByTagName('meta')['uid'].content
		this.showOrderBuy()
	},
	methods: {
		showOrderBuy : function () {
			this.getList("orders/get/buy")
			.then(res => {
				this.goodsList = res
			})
			this.flag = 0
		},
		showOrderSell: function () {
			this.getList("orders/get/sell")
			.then(res => {
				this.goodsList = res
			})
			this.flag = 1
		},
		async getList (url) {
			var list = []
			await axios.get(url)
			.then(function (res) {
				list = res.data
			})
			.catch(function () {
				list = errorCallback()
			})
			return list

			function emptyCallback () {
				return []
			}

			function errorCallback () {
				return "error"
			}
		},
	},
}
</script>
