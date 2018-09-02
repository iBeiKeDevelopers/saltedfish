new Vue({
    el: "#singleItem",
    data() {
        return {
            id: 0,
            carouselValue: 0,
            page: 1,
            num: 5,
            imageList: [],
            commentList: [],
            content: "",
        }
    },
    mounted() {
        this.id = document.getElementsByTagName('meta')['goods_id'].content
        this.getImages()
        this.showComments()
    },
    methods: {
        getImages() {
            self = this
            axios.get('/api/image/id/'+this.id)
                .then(function (res) {
                    self.imageList = res.data
                })
        },
        showComments() {
            self = this
            axios.get('/goods/comments/' + this.id)
                .then(function (res) {
                    self.commentList = res.data
                    //console.log(self.commentList)
                })
        },
        submitComment() {
            self = this
            id = self.id
            if(id === 0)
                self.$Message.error('error!')
            
            axios.post('/comments/submit', {
                content: this.content,
                id: this.id
            })
                .then(function (res) {
                    if(res.data.status)
                        self.$Message.success('提交成功！')
                    else
                        self.$Message.error(res.data.error)
                })
                .catch(function () {
                    self.$Message.error('提交失败！')
                })
        }
    }
})