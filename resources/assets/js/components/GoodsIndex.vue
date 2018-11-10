<template>
    <div v-if="card.status == true">
        <!-- nothing -->
        <template v-if="card.content.length === 0">
            <div class="img-wrapper col-12"
                style="background-image: url('/storage/404.png')">
            </div>
        </template>
        <!-- normal -->
        <template v-else>
            <template v-for="item in card.content">
                <div class="thumbnail col-md-3 col-xs-6 float-left" :key="item.id">
                    <a :href="'/goods'+'/'+item.id">
                        <div class='img-wrapper'
                            :style="'background-image: url('+item.thumbnail.src+')'">
                        </div>
                    </a>
                        <div class='caption'>
                        <h4 class='goods-title'>
                            {{ item.title }}
                        </h4>
                        <h5 class='goods-cost main-content'>
                            ￥ {{ item.cost }}
                        </h5>
                    </div>
                </div>
            </template>
        </template>
        <Page :total="total" @on-change="change(num)" show-elevator />
    </div>
</template>

<script>
import "iview";

export default {
    props: [
        'url'
    ],
    data() {
        return {
            total: 0,
            card: {
                status: false,
                content: [],
            },
        }
    },
    mounted() {},
    methods: {
        change(num) {
            axios.get('url')
            .then((res) => {
                
            })
        },
    },
}
</script>

<style>

</style>
