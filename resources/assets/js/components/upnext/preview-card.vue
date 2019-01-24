<template>
    <div @mousemove="hovered=true" @mouseleave="hovered=false">
       <div class="relatived">
            <v-lazy-image :src="product.image" :alt="product.name"></v-lazy-image>
        <transition enter-active-class="animated fadeIn fast"
                    leave-active-class="animated fadeOut fast">
            <v-lazy-image v-if="product.side_image && hovered" class="absoluted"  :src="product.side_image" :alt="product.name"></v-lazy-image>
        </transition>

       </div>
    </div>
</template>

<script>
export default {
    props:['product'],
    data(){
        return{
            hovered:false
        }
    }
}
</script>

<style scoped lang="scss">
    .relatived{
        position:relative;
    }

    .absoluted{
        position: absolute;
        top: 0;
        left:0;

    }
</style>