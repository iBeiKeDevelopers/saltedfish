<template>
    <div id="orders" class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">    
                        <breadcrumb separator=">">
                            <breadcrumb-item to="/home">个人中心</breadcrumb-item>
                            <breadcrumb-item>我的订单</breadcrumb-item>
                        </breadcrumb>
                    </div>
                    <div class="card-body">
                        <i-menu active-name="0" style="text-align:center"
                            mode="horizontal" @on-select="changeFlag">
                            <menu-item class="col-xs-4" name="0">
                                我买的
                            </menu-item>
                            <menu-item class="col-xs-4" name="1" >
                                我卖的
                            </menu-item>
                            <menu-item class="col-xs-4" name="2" >
                                已完成
                            </menu-item>
                        </i-menu>
                    </div>
                    <template>
                        <div v-show="flag == 0">
                            <template v-if="itemList[0].content.length === 0">
                                <div class="col-12">
                                    <img class="img-responsive" src="/storage/404.png" alt="404">
                                </div>
                            </template>
                            <template v-for="item in itemList[0].content">
                                <div class="col-xs-6 col-lg-12" :key="item.id">
                                    <div class="" style="padding-top: 5px;"></div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div class="img-wrapper"
                                            :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    </div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div><h1 class="goods-title">{{ item.title }}</h1></div>
                                        <div class="goods-cost font-dark">合计：￥&nbsp;{{ (item.cost*item.amount).toFixed(2) }}</div>
                                        <div class="goods-amount">数量：{{ item.amount }}</div>
                                        <div class="goods-status">
                                            状态：<span class="font-default">{{ getStatus(item.status) }}</span>
                                        </div>
                                        <div class="goods-contact">
                                            联系方式：{{ item.phone }}
                                        </div>
                                        <div>
                                            创建时间：{{ item.created_at }}
                                        </div>
                                        <div>
                                            <!-- Waiting for the confirm of seller -->
                                            <template v-if="item.status == 0">
                                                <Button @click="cancel(item.id)">取消订单</Button>
                                            </template>
                                            
                                            <!-- To be shipped -->
                                            <template v-else-if="item.status == 1">
                                                <Button @click="cancel(item.id)">取消订单</Button>
                                                <Button @click="modal_shipped = true">确认收货</Button>
                                                <Modal
                                                    v-model="modal_shipped"
                                                    title="确认收货"
                                                    @on-ok="shipped(item.id)"
                                                >
                                                    <h class="font-dark">确认商品无误后，</h>
                                                    <p>请尽快完成交易</p>
                                                </Modal>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-show="flag == 1">
                            <template v-if="itemList[1].content.length === 0">
                                <div class="col-12">
                                    <img class="img-responsive" src="/storage/404.png" alt="404">
                                </div>
                            </template>
                            <template v-for="item in itemList[1].content">
                                <div class="col-xs-6 col-lg-12" :key="item.id">
                                    <div style="padding-top: 5px;"></div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div class="img-wrapper"
                                            :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    </div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div><h1 class="goods-title">{{ item.title }}</h1></div>
                                        <div class="goods-cost font-dark">合计：￥&nbsp;{{ (item.cost*item.amount).toFixed(2) }}</div>
                                        <div class="goods-amount">数量：{{ item.amount }}</div>
                                        <div class="goods-status">
                                            状态：<span class="font-default">{{ getStatus(item.status) }}</span>
                                        </div>
                                        <div class="goods-contact">
                                            联系方式：{{ item.phone }}
                                        </div>
                                        <div>
                                            创建时间：{{ item.created_at }}
                                        </div>
                                        <div>
                                            <!-- To be confirmed and sent -->
                                            <template v-if="item.status == 0">
                                                <Button @click="modal_confirm = true">确认订单</Button>
                                                <Modal
                                                    v-model="modal_confirm"
                                                    title="确认订单"
                                                    @on-ok="confirm(item.id)"
                                                >
                                                    <h class="font-dark">确认订单无误后，</h>
                                                    <p>请尽快将商品送至买家手中</p>
                                                </Modal>
                                            </template>
                                            <template v-else-if="item.status === 3 || item.status === 4">
                                                <!--<Button @click="modal_delete = true">删除</Button>-->
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-show="flag == 2">
                            <template v-if="itemList[2].content.length === 0">
                                <div class="col-12">
                                    <img class="img-responsive" src="/storage/404.png" alt="404">
                                </div>
                            </template>
                            <template v-for="item in itemList[2].content">
                                <div class="col-xs-6 col-lg-12" :key="item.id">
                                    <div style="padding-top: 5px;"></div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div class="img-wrapper"
                                            :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    </div>
                                    <div class="col-12">
                                        <div><h1 class="goods-title">{{ item.title }}</h1></div>
                                        <div class="goods-cost font-dark">合计：￥&nbsp;{{ (item.cost*item.amount).toFixed(2) }}</div>
                                        <div class="goods-amount">数量：{{ item.amount }}</div>
                                        <div class="goods-status">
                                            状态：<span class="font-default">{{ getStatus(item.status) }}</span>
                                        </div>
                                        <div>创建时间：{{ item.created_at }}</div>
                                        <div>
                                            <!-- To make a comment -->
                                            <!-- todo a simple form to comment -->
                                            <Button @click="modal_comment = true">评论</Button>
                                            <Modal
                                                v-model="modal_comment"
                                                title="商品评论"
                                                @on-ok="comment(item.id)"
                                            >
                                                <p>没这功能（暂时）</p>
                                                <p>程序员跑路了～</p>
                                            </Modal>
                                            <!-- Delete -->
                                            <!--<Button @click="modal_delete = true">删除</Button>-->
                                            <Modal
                                                v-model="modal_delete"
                                                title="删除"
                                                @on-ok="deletes(item.id)"
                                            >
                                                <h3 class="font-dark">订单删除后在记录中将不再显示。</h3>
                                            </Modal>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            flag: 0,
            modal_delete: false,
            modal_comment: false,
            modal_confirm: false,
            modal_shipped: false,
            itemList: [
                {
                    url: '/orders/list/buy',
                    content: [],
                }, {
                    url: '/orders/list/sell',
                    content: [],
                }, {
                    url: '/orders/list/finished',
                    content: [],
                },
            ],
        }
    },
    mounted() {
        var self = this
        this.itemList.forEach((list) => {
            axios.get(list.url)
            .then((res) => {
                list.content = res.data
            })
        });
    },
    methods: {
        changeFlag(num) {
            this.flag = num
        },
        getStatus(status) {
            switch(status) {
                case 0: return "等待卖家确认订单发货";
                case 1: return "等待卖家确认商品无误后付款";
                case 2: return "订单已完成";
                case 4: return "订单已取消";
                default: return "";
            }
        },
        cancel(id) {
            axios.post('/orders/' + id, {
                _method: 'PUT',
                operation: 'cancel',
            })
            .then((res) => {
                window.location.reload()
            })
            .catch((e) => {
                this.$Message.error('error!')
            })
        },
        shipped(id) {
            axios.post('/orders/' + id, {
                _method: 'PUT',
                operation: 'shipped',
            })
            .then((res) => {
                this.$Message.success('提交成功')
                // setTimeout('window.location.reload()', 3000);
            })
        },
        confirm(id) {
            axios.post('/orders/' + id, {
                _method: 'PUT',
                operation: 'confirm',
            })
            .then((res) => {
                this.$Message.success('提交成功')
                // setTimeout('window.location.reload()', 3000);
            })
        },
        comment() {},
        deletes(id) {
            axios.post('/orders/' + id, {
                _method: 'DELETE',
            })
        },
    }
}
</script>
