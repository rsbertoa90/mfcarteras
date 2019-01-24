<template>
    <div class="row padded">
        <div class="col-12 col-lg-3" v-for="product in offers" 
            :key="product.id">
            <prevCard class="mt-4" :product="product"></prevCard>
        </div>
    </div>
</template>


<script>
import prevCard from './preview-card.vue';
export default {
    components:{
        prevCard
    },
    computed:{
        
        offers(){
            let products = this.$store.getters.getProducts;
            if (products){

                return products.filter(p => {
                    return p.offer;
                });
            }
        }
    }
}
</script>

<style>
    .padded{
        padding:0px 47px;
        margin-left: 1px;
    }

    @media (max-width:900px){
        .padded{
            padding:0;
            margin-left:4px;
        }
    }
</style>
