new Vue({
    el: "#order",
    data() {
        return {
            step: 0,
            Echo: window.Echo
        }
    },
    mounted() {
        self = this
        self.id = document.getElementsByTagName('meta')['id'].content
        axios.get('/api/order/'+self.id+'/status')
            .then(function (res) {
                self.step = res.data
            })
            .then(function () {
                self.listenOrderStatus()
            })
    },
    methods: {
        listenOrderStatus() {
            Echo.private('App.Order.'+this.id)
                .listen('.status.changed', function (e) {
                    console.log(e)
                })
        }
    }
})