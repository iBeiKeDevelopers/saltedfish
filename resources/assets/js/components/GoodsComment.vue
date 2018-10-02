<template>
    <div class="card main-background main-shadow">
        <div class="card-header main-gradient">
            <div class="card-title">商品评论</div>
        </div>
        <div class="card-body" v-if="status">
            <template v-for="card in commentList">
                <ul class="list-group" :key="card.id">
                <template v-if="card.uid">
                    <li class="list-group-item comment col-xs-12">
                        <div class="col-md-2 col-xs-4">
                            <div class="circle-avatar"
                                :style="'background-image: url('+card.avatar+')'">
                            </div>
                            <div class="uname">{{ card.uname }}</div>
                        </div>
                        <div class="goods-comment col-md-10 col-xs-8">
                            <div>{{ card.content }}</div>
                            <div class="goods-meta">{{ card.created_at }}</div>
                        </div>
                    </li>
                </template>
                </ul>
            </template>
            <div>
                <i-form action="">
                <i-col span="18">
                    <form-item prop="content">
                        <i-input v-model="content" placeholder="说些什么..."></i-input>
                    </form-item>
                </i-col>
                <i-col span="1">&nbsp;</i-col>
                <i-col span="5">
                    <form-item>
                        <i-button id="btn-submit" style="width:100%" type="primary" @click="submitComment">提交</i-button>
                    </form-item>
                </i-col>
                </i-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 0,
            page: 1,
            num: 5,
            commentList: [],
            content: "",
            status: false,
        }
    },
    mounted() {
        this.id = document.getElementsByTagName('meta')['goods_id'].content
        this.showComments()
    },
    methods: {
        showComments() {
            self = this
            axios.get('/goods/comments/' + this.id)
                .then((res) => {
                    self.commentList = res.data
                    //console.log(self.commentList)
                })
                .then((res) => {
                    self.status = true
                })
        },
        submitComment() {
            self = this
            var id = self.id
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
}
</script>
