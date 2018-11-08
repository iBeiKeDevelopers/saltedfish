<template>
    <div style="col-xs-12">
        <Carousel v-model="carouselValue" loop>
            <template v-for="item in imageList" v-if="status">
                <CarouselItem :key="item.id">
                    <img :src="item.src">
                </CarouselItem>
            </template>
        </Carousel>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: 0,
            imageList: [{
                id: 1,
                src: "/storage/1.jpg",
            },{
                id: 2,
                src: "/storage/2.jpg",
            },],
            carouselValue: 0,
            status: false,
        }
    },
    mounted() {
        this.getImages()
    },
    methods: {
        getImages() {
            self = this
            
            this.id = document.getElementsByTagName('meta')['goods_id'].content
            axios.get('/api/image/id/' + this.id)
            .then((res) => {
                self.imageList = res.data
                self.status = true
                console.log(self.imageList)
            })
        },
    }
}
</script>
