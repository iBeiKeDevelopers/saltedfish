<template>
    <div>
        <template v-for="card in goodsList">
            <GoodsCard :card="card" v-if="card.status" :key="card.header"></GoodsCard>
        </template>
    </div>
</template>


<script>
import GoodsCard from './HomeGoodCard'

export default {
    components: {
        GoodsCard,
    },
    data() {
        return {
			goodsList: [
				{
					url: "/api/goods/new/8",
                    header: "最近上架",
                    status: false,
					content: [],
				},{
					url: "/api/goods/hot/8",
					header: "热门商品",
                    status: false,
					content: [],
				},{
					url: "/api/goods/random",
					header: "随机推荐",
                    status: false,
					content: [],
				}
			],
        }
    },
    created() {
        self = this
        this.goodsList.forEach(function (item) {
            axios.get(item.url)
            .then((res) => {
                item.content = res.data
                item.content.forEach(function (it) {
                    if(!it.thumbnail)
                        it.thumbnail = {src: '/storage/admin.png'}
                })
            })
            .then(function () {
                item.status = true
            })
            .catch(function () {
                item.status = false
            })
        })
    },
}
</script>

