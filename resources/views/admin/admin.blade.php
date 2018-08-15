<link rel="stylesheet" href="{{ URL::asset('/css/admin.css') }}">

<div class="column">
    <div id="show">
        <div v-html="html"></div>
        <div>
            <button v-on:click="getGoods(page)" v-html="buttontext"></button>
        </div>
    </div>
    <div id="moreinfo"></div>
    
</div>

<script type="text/javascript" src="{{ URL::asset('js/axios.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/vue.js')}}"></script>
<script type="text/javascript">
    var goods = new Vue({
    el: '#show',
    data: {
        page: 0,
        num: 10,
        html: "<table><tr><td>id</td><td>title</td><td>owner</td><td>info</td><td>status</td><td>changes</td></tr>",
        buttontext: "next page",
    },
    methods: {
        getGoods: function() {
            axios.post("/admin",{
                "request": "getGoods",
                "page": this.page,
                "num": this.num,
            }).then(function (response) {
                page = ++goods.page
                arr = response.data
                console.log("page: " + page)
                console.log(arr)
                if(arr == "empty") {
                    alert("end of the list!");
                    return
                }
                inner = goods.html
                len = arr.length
                for(i = 0; i < len; i++) {
                    inner += "<tr><td>"+arr[i].goods_id+"</td><td>"+arr[i].goods_title+"</td><td>"+arr[i].goods_owner+"</td><td>"+arr[i].goods_info+"</td><td>"+arr[i].goods_status+"</td>"
                    inner += "<td><button onclick='post_delete("+arr[i].goods_id+")'>remove</button></td></tr>"
                }
                goods.html = inner
                if(arr,length == goods.num) { //normal
                    
                }
            });
        }
    }
})

goods.getGoods()

function post_delete(num) {
    console.log("deleteing...goods_id=" + num)
    axios.post("/admin",{
        "request": "deleteGoods",
        "id": num,
    }).then(function (response) {
        res = response.data.status
        console.log(res)
        if(res != "true") alert("failed to remove the item with id: " + num)
        else alert("detele an item with id: " + num + " succeed.")
    })
}
</script>
