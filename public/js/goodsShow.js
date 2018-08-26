new Vue({
    el: "#singleItem",
    data() {
        return {
            carouselValue: 0,
            imageList: [
                {
                    src: "/storage/1.png",
                },
                {
                    src: "/storage/2.png",
                },
                {
                    src: "/storage/3.png",
                },
            ],
        }
    },
})