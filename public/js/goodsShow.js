new Vue({
    el: "#singleItem",
    data() {
        return {
            carouselValue: 0,
            page: 1,
            num: 5,
            imageList: [
                {
                    src: "/storage/1.jpg",
                },
                {
                    src: "/storage/2.jpg",
                },
                {
                    src: "/storage/3.jpg",
                },
            ],
            commentList: [],
        }
    },
    mounted() {
        this.showComments()
    },
    methods: {
        showComments() {
            self = this
            id = document.getElementsByTagName('meta')['goods_id'].content
            axios.get('/goods/comments/' + id)
                .then(function (res) {
                    self.commentList = res.data
                    //console.log(self.commentList)
                })
        },
    }
})