<template>
    <div >
            <div class="row">
               



              
                   <!--  <div style="height:250px ; width:100%"></div> -->
                    <div class=" col-lg-4" v-for="product in productsWithImages" :key="product.id">
                        <productCard :product="product"> </productCard>
                    </div>
            

                
                
            
                


            
        </div>
    </div>
</template>


<script>
import productCard from './productCard.vue';
export default {
    data(){
       return{
           
       }
    },
    components:{
        productCard
    },
    computed:{
        products(){
            return this.$store.getters.getProducts;
        },
        productsWithImages(){
            if (this.products){
                return this.products.filter(prod => {
                    return ( prod.image != null && !prod.paused );
                });
            }
        }, 
    },
   
}
</script>
