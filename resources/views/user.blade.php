<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="js/axios.min.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>
<div id="form">
	<i-form>
		<form-item label="login">
			<?php echo session('user');?>
		</form-item>
		<form-item label="个人信息">
			<i-button @click="showProfile('user/info')">点我</i-button>
			<div>@{{ profile }}</div>
		</form-item>
		<form-item label="">
		</form-item>
		<form-item>
			
		</form-item>
		<form-item>
			
		</form-item>
		<form-item>
			
		</form-item>
		<form-item>
			
		</form-item>
	</i-form>
</div>
<script>
	var app = new Vue({
		el: "#form",
		data: {
			profile: "",
			message: "",
		},
		methods: {
			showProfile: function ($url) {
				self = this
				axios.get($url)
					.then(function (res) {
						self.profile = res.data
					})
			},
		}
	})
</script>