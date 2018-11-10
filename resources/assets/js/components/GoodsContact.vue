<template>
    <div class="left-align col-xs-12">
        <button class="btn btn-link" type="button" @click="modal = true">联系卖家</button>
        <Modal
            v-model="modal"
            @on-ok="ok"
        >
            <h4>程序员跑路了，该功能尚未开放，敬请期待</h4>
            <br>
            <p style="color:red;">温馨提示：</p>
            <br>
            <p>我的订单页面可以看到卖家的联系方式哦</p>
        </Modal>
    </div>
</template>

<script>
import "iview";

export default {
    data() {
        return {
            modal: false,
        }
    },
    methods: {
        ok() {},
        calcel() {},
    }
}
</script>
