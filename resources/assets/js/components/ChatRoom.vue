<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-8">
                <div class="card chat-box">
                    <div class="card-header">聊天室</div>
                    <div class="card-body">
                        <ul class="list-group chat-board" v-if="status === true">
                            <template v-for="bubble in history">
                                <li class="list-group-item" style="margin-top:5%;" :key="bubble.content">
                                    <Bubble :data="bubble" :avatar="(bubble.direct == 'to')?this_avatar:that_avatar"></Bubble>
                                </li>
                            </template>
                        </ul>
                        <div class="chat-control hidden-xs">
                            <div>
                                <Col span="18">
                                    <Input type="textarea" :autosize="{minRows: 3,maxRows: 5}" v-model="form.message" placeholder="aaa"></Input>
                                </Col>
                                <Col span="6">
                                    <Upload action="" style="width:50%;float:left;">
                                        <Button icon="ios-cloud-upload-outline">图片</Button>
                                    </Upload>
                                    <Upload action="" style="width:50%;float:left;">
                                        <Button icon="ios-cloud-upload-outline">文件</Button>
                                    </Upload>
                                    <Button style="width:100%" @click="sendMessage(form.message)">发送</Button>
                                </Col>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Bubble from './ChatBubble'

export default {
    components: {
        Bubble
    },
    props: [
        'this_avatar', 'that_avatar',
    ],
    data() {
        return {
            id: 0,
            that_id: 0,
            Echo: window.Echo,
            status: false,
            history: [],
            form: {
                message: "",
            },
            rule: {},
        }
    },
    mounted() {
        this.id = document.getElementsByTagName('meta')['id'].content
        this.that_id = document.getElementsByTagName('meta')['that_id'].content

        this.loadHistory()
        this.listenHandler()
        console.log(this.this_avatar)
        console.log(this.that_avatar)
    },
    methods: {
        sendMessage(message) {
            self = this
            axios.post('/chat-online/'+this.that_id, {
                message: message,
                type: 'text'
            })
            .then((res) => {
                self.history.push({
                    type: 'text',
                    content: message,
                    direct: 'to',
                })
            })
        },
        showMessage() {

        },
        loadHistory() {
            self = this
            axios.get('/chat/history/'+this.that_id)
            .then((res) => {
                self.history.push({
                    type: 'text',
                    content: 'message',
                    direct: 'to',
                })
                console.log(self.history)
                self.status = true
            })
            .catch((res) => {
                alert("error!");
            })
        },
        listenHandler() {
            this.Echo.private('App.Chat.'+this.id)
                .listen('.message.from.'+this.that_id, function (e) {
                    self.history.push({
                        type: e.type,
                        content: e.message,
                        direct: 'from',
                    })
                })
        }
    }
}
</script>

<style>
    .chat-board {
        min-height: 40em;
    }
</style>