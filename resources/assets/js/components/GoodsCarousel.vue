<template>
    <div style="col-xs-12">
        <template v-if="status == true">
            <Carousel v-model="carouselValue" loop>
                <template v-for="item in imageList">
                    <CarouselItem :key="item.id">
                        <img :src="item.src">
                    </CarouselItem>
                </template>
            </Carousel>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 0,
            imageList: [],
            status: false,
            carouselValue: 0,
        }
    },
    mounted() {
        this.getImages()
    },
    methods: {
        getImages() {
            self = this
            self.id = document.getElementsByTagName('meta')['goods_id'].content
            axios.get('/api/image/id/'+this.id)
            .then((res) => {
                self.imageList = res.data
            })
            .then((res) => {
                self.status = true
                console.log(self.imageList)
                console.log(self.status)
            })
        },
    }
}
</script>
