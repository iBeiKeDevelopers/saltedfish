<template>
    <div id="orders" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                buy
                            </menu-item>
                            <menu-item class="col-xs-4" name="1" >
                                sell
                            </menu-item>
                            <menu-item class="col-xs-4" name="2" >
                                finished
                            </menu-item>
                        </i-menu>
                    </div>
                    <template>
                        <div v-show="flag == 0">
                            <template v-if="itemList[0].length === 0">
                                <div class="col-12">
                                    <img class="img-responsive" src="/storage/404.png" alt="404">
                                </div>
                            </template>
                            <template v-for="item in itemList[0]">
                                <div class="col-xs-6" :key="item.id">
                                    <div class="img-wrapper col-xs-12 col-md-6"
                                        :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    <div class="col-xs-12 col-md-6">
                                        <div>{{ item.title }}</div>
                                        <div>{{ item.cost }}</div>
                                        <div>{{ item.amount }}</div>
                                        <div>{{ item.created_at }}</div>
                                        <div>
                                            <!-- Waiting for the confirm of seller -->
                                            <template v-if="item.status == 0">
                                                <Button @click="cancel(item.id)">Cancel</Button>
                                            </template>
                                            
                                            <!-- To be shipped -->
                                            <template v-else-if="item.status == 1">
                                                <Button @click="cancel(item.id)">Cancel</Button>
                                                <Button @click="shipped">Shipped</Button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-show="flag == 1">
                            <template v-for="item in itemList[1]">
                                <div class="col-xs-6" :key="item.id">
                                    <div class="img-wrapper col-xs-12 col-md-6"
                                        :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    <div class="col-xs-12 col-md-6">
                                        <div>{{ item.title }}</div>
                                        <div>{{ item.cost }}</div>
                                        <div>{{ item.amount }}</div>
                                        <div>{{ item.created_at }}</div>
                                        <div>
                                            <!-- To be confirmed and sent -->
                                            <template v-if="item.status == 0">
                                                <Button @click="confirm(item.id)">Confirm</Button>
                                            </template>
                                            <template>
                                                <Button type="info">Finished</Button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-show="flag == 2">
                            <template v-for="item in itemList[2]">
                                <div class="col-xs-6" :key="item.id">
                                    <div class="img-wrapper col-xs-12 col-md-6"
                                        :style="'background-image:url('+item.thumbnail.src+')'"
                                        ></div>
                                    <div class="col-xs-12 col-md-6">
                                        <div>{{ item.title }}</div>
                                        <div>{{ item.cost }}</div>
                                        <div>{{ item.amount }}</div>
                                        <div>{{ item.created_at }}</div>
                                        <div>
                                            <!-- To make a comment -->
                                            <!-- todo a simple form to comment -->
                                            <Button @click="comment(item.id)">Comment</Button>
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
import "mescroll";

export default {
    data() {
        return {
            flag: 0,
            mescroll: [],
            urlList: [
                '/orders/list/buy',
                'orders/list/sell',
                'orders/list/finished',
            ],
            itemList: [],
        }
    },
    mounted() {
        var self = this
        this.urlList.forEach((url) => {
            axios.get(url)
            .then((res) => {
                self.itemList.push(res.data)
            })
        });
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
        cancel(id) {
            axios.post('/orders/' + id, {
                _method: 'DELETE',
            })
            .then((res) => {
                window.location.reload()
            })
            .catch((e) => {
                // I don't know why
            })
        },
        shipped() {},
        confirm() {},
        comment() {},
    }
}
</script>
