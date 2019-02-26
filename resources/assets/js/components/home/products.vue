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
    methods:{
         frontvariant(product){
            if (product.variants){
                return product.variants.find(v => {
                    return v.isfront;
                });
            }
            
        },
    },
    computed:{
        products(){
            return this.$store.getters.getProductsnotpaused;
        },
       
        productsWithImages(){
            var vm =this;
            if (this.products){
                return this.products.filter(prod => {
                    if ( vm.frontvariant(prod) ){
                        let fv = vm.frontvariant(prod);
                        return fv.images[0] != null;
                    }     
                });
            }
        }, 
    },
   
}
</script>
