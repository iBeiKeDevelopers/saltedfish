<script src="js/vue.js"></script>
<script src="js/axios.min.js"></script>
login: &nbsp;&nbsp;
<?php echo session('user');?>
<br/>
your goods: &nbsp;&nbsp;
<div id="goods">
	<button @click="show">show</button><br>
	@{{ message }}
</div><br/>
your orders: &nbsp;&nbsp;
<div id="order">
	<button @click="show">show</button><br>
	@{{ message }}
</div><br/>
<script>
	new Vue({
		el: "#goods",
		data: {
			message: "",
		},
		methods: {
			show: function () {
			self = this
			axios.get("api/goods/list?uid=1")
				.then(function (res) {
					message = res.data
					self.message = message
				})
			}
		}
	})
</script>
<script>
	new Vue({
		el: "#order",
		data: {
			message: "",
		},
		methods: {
			show: function () {
				self = this
				axios.get("api/order/list?uid=1")
					.then(function (res) {
						message = res.data
						self.message = message
					})
			}
		}
	})
</script>