<script src="js/axios.min.js"></script>
<script src="js/vue.js"></script>
login&nbsp;&nbsp;
<?php echo Auth::check() ?? "null"; ?>

<form method="GET" action="">
    search
    <input name="search"/>
    <input type="submit"/>
</form>

<div>
    <div id="goodsBox">
        <button @click="getGoodsList">getGoodsList</button>
        <br/>
        Goods:
        <br/>
        @{{ message }}
    </div>
</div>
<script>
    new Vue({
        el: "#goodsBox",
        data: {
            message: "",
        },
        methods: {
            getGoodsList: function () {
                self = this
                axios.get("api/goods")
                    .then(function (res) {
                        message = res.data
                        if(!message) self.message = "null"
                        else self.message = res.data.message
                    })
            }
        }
    })
</script>
