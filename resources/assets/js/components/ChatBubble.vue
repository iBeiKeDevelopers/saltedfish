<template>
    <div :class="direction">
        <template v-if="data.type == 'text'">
            <Tooltip :placement="(data.direct == 'to')?'left':'right'+'-start'" always>
                
                <img class="img-thumbnail img-circle img-responsive bubble-avatar" :src="avatar">
                <div slot="content">
                    <p class="bubble-text">{{ data.content }}</p>
                </div>
            </Tooltip>
        </template>
    </div>
</template>

<script>
import { Tooltip } from 'iview'

export default {
    components: {
        Tooltip,
    },
    props: [
        'data', 'avatar'
    ],
    data() {
        return {
            direction: 'left',
        }
    },
    mounted() {
        this.direction = (this.data.direct == 'from') ? 'float-left' : 'float-right'
    }
}
</script>

<style>
    .bubble-text {
        white-space: normal;
    }
    .bubble-avatar {
        width: 50px;
    }
</style>
