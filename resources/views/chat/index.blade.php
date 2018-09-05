@extends('layouts.app')

@section('title', '聊天室')

@section('content')
<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<meta name="id" content="{{ Auth::id() }}">
<meta name="that_id" content="{{ $id }}">
<div id="chat">
    <input v-model="message">
    <button type="submit" @click="sendMessage">submit</button>
</div>
<script>
    new Vue({
        el: "#chat",
        data() {
            return {
                id: 0,
                that_id: 0,
                Echo: window.Echo,
                message: "",
            }
        },
        mounted() {
            this.id = document.getElementsByTagName('meta')['id'].content
            this.that_id = document.getElementsByTagName('meta')['that_id'].content

            this.Echo.private('App.Chat.'+this.id)
                .listen('.message.from.'+this.that_id, function (e) {
                    alert(e.message)
                })
        },
        methods: {
            sendMessage() {
                self = this
                axios.post('/chat-online/'+this.that_id, {
                    message: self.message
                })
            }
        }
    })
</script>
@endsection