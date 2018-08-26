new Vue({
	el: "#goodsCards",
	data() {
		return {
			goodsList: [
				{
					url: "/api/goods/new/8",
					header: "最近上架",
					status: true,
					content: [],
				},{
					url: "/api/goods/hot/8",
					header: "热门商品",
					status: true,
					content: [],
				},{
					url: "/api/goods/random",
					header: "随机推荐",
					status: true,
					content: [],
				}
			],
		}
	},
	mounted: function () {
		this.showGoods(getListCallback)
	},
	methods: {
		showGoods: function (getList) {
			this.goodsList.forEach(function (card) {
				getList(card.url)
					.then(function (info) {
						if(info != false)
							card.content = info
						else
							card.status = info
					})
			})
		},
	},
})

async function getListCallback(url) {
	var info = ""
	await axios.get(url)
		.then(function (res) {
			if(!res.data.length)
				info = emptyCallback()
			info = res.data
		})
		.catch(function(res) {
			info = errorCallback()
		})
	return info

	function errorCallback () {
		return false
	}

	function emptyCallback () {
		return []
	}
}