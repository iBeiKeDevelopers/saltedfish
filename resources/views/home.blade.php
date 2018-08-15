<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="js/axios.min.js"></script>
<script type="text/javascript" src="js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<div id="form" style="width:80%;">
    <i-form :label-width="70">
        <form-item label="login">
            <?php echo Auth::id();?>
        </form-item>
        <form-item label="search">
            <i-col span="11">
                <i-input/>
            </i-col>
            <i-button @click="search">submit</i-button>
        </form-item>
        <form-item label="redirects">
            <i-button @click="redirect('home')">home</i-button>
        </form-item>
    </i-form>
</div>
<script>
    new Vue({
        el: "#form",
        methods: {
            search: function () {
                self = this
                axios.get("")
            },
            redirect: function (url) {
                window.location.href = url
            }
        }
    })
</script>

<div id="goodsBox">
    <i-form :label-width="70">
        <form-item label="Goods">
            <i-button @click="getGoodsList">getGoodsList</i-button>
        </form-item>
        <form-item>
            @{{ message }}
        </form-item>
    </i-form>
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
                        else self.message = res.data
                    })
            }
        }
    })
</script>
