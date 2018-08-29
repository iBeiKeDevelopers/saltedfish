new Vue({
    el: "#singleItem",
    data() {
        return {
            carouselValue: 0,
            page: 1,
            num: 5,
            imageList: [],
            commentList: [],
        }
    },
    mounted() {
        id = document.getElementsByTagName('meta')['goods_id'].content
        this.getImages(id)
        this.showComments(id)
    },
    methods: {
        getImages(id) {
            self = this
            axios.get('/api/image/id/'+id)
                .then(function (res) {
                    self.imageList = res.data
                })
        },
        showComments(id) {
            self = this
            axios.get('/goods/comments/' + id)
                .then(function (res) {
                    self.commentList = res.data
                    //console.log(self.commentList)
                })
        },
    }
})