<template>
    <div @mousemove="hovered=true" @mouseleave="hovered=false">
       <div class="relatived">
            <v-lazy-image :src="frontVariant.images[0].url" :alt="product.name"></v-lazy-image>
        <transition enter-active-class="animated fadeIn fast"
                    leave-active-class="animated fadeOut fast">
            <v-lazy-image v-if="frontVariant.images[1] && hovered" class="absoluted"  :src="frontVariant.images[1].url" :alt="product.name"></v-lazy-image>
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
    },
    computed:{
        frontVariant(){
            return this.product.variants.find(v=>{
                return v.isfront;
            });
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