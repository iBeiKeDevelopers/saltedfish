<template>
</template>

<script>
import { Carousel, CarouselItem } from 'iview'

export default {
    props: [
        'imageList', 'status',
    ],
    data() {
        return {
        }
    },
    mounted() {
        console.log(this.imageList)
        console.log(this.status)
    }
}
</script>

