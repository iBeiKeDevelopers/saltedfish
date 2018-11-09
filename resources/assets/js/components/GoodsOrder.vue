<template>
    <div class="left-align col-xs-12">
        <button id="btn-gradient" class="btn btn-lg" type="button" @click="modal = true">创建订单</button>
        <Modal
            v-model="modal"
            title="New Order"
            @on-ok="ok"
            @on-cancel="cancel"
        >
            <Form>
                <FormItem class="col-6 float-left">
                    <div
                        class="img-wrapper"
                        :style="'background-image: url(' + imgUrl + ')'"
                    >
                    </div>
                </FormItem>
                <FormItem class="col-6 float-left">
                    <p>￥ {{ cost }}</p>
                    <p>库存{{ remain }}件</p>
                </FormItem>
                <FormItem class="col-12">
                    <p>购买数量</p>
                    <InputNumber :max="remain*1" :min="1" v-model="amount"></InputNumber>
                </FormItem>
            </Form>
        </Modal>
    </div>
</template>

<script>
import 'iview';

export default {
    props: [
        'imgUrl',
        'cost',
        'remain',
        'gid',
    ],
    data() {
        return {
            modal: false,
            amount: 1,
        }
    },
    methods: {
        ok() {
            var self = this
            axios.post('/orders', {
                amount: self.amount,
                goods_id: self.gid,
            })
            .then((res) => {
                if(res.data === 'OK') {
                    self.$Message.success('订单创建成功，3秒后刷新页面。')
                    setTimeout('window.location.reload()', 3000)
                }
                else
                    self.$Message.error(res.data)
            })
            this.amount = 1
        },
        cancel() {
            this.amount = 1
        },
    }
}
</script>
