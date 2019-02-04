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
import productCard from '../home/productCard.vue';
export default {
    props:['ids'],
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
            return this.$store.getters.getProducts;
        },
        filteredProducts(){
            if (this.products){
                return this.products.filter(p => {
                    return this.ids.includes(p.id);
                });
            }
        },
        productsWithImages(){
            var vm =this;
            if (this.filteredProducts){
                return this.filteredProducts.filter(prod => {
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
