new Vue({
    el: "#orders",
    data() {
        return {
            flag: 0,
            mescroll: [],
        }
    },
    mounted() {
        function initMescroll(mescrollId, clearEmptyId) {
            var mescroll = new MeScroll(mescrollId, {
                up: {
                    callback: getListData,
                    isBounce: false,
                    empty: {
                        icon: "/storage/404.png",
                        tip: "no more",
                        btntext: "home",
                        btnClick: function () {
                            window.location.href = "/"
                        }
                    },
                    clearEmptyId: clearEmptyId,
                    toTop: {
                        src: "/mescroll/res/img/mescroll-totop.png",
                        //offset: 1000,
                    }
                }
            })
            return mescroll
        }

        function getListData(page) {
            var dataIndex = curNavIndex
            axios.get('/api/orders')
        }
    },
    methods: {
        changeFlag(num) {
            this.flag = num
        },
    },
})