<template>
    <div >
            <div class="row">
               



                <div class="col-lg-6 d-flex flex-column">
                    <div style="height:250px ; width:100%"></div>
                    <div v-for="product in odds" :key="product.id">
                        <productCard :product="product"> </productCard>
                    </div>
                </div>

                <div class="col-lg-6 d-flex flex-column">
                    <div v-for="product in evens" :key="product.id">
                        <productCard :product="product"> </productCard>
                    </div>
                    <div style="height:250px ; width:100%"></div>
                </div>

            
                


            
        </div>
    </div>
</template>


<script>
import productCard from './productCard.vue';
export default {
    data(){
        return{
            odds:[],
            evens:[]
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
                    return ( prod.images != undefined && prod.images.length > 0 );
                });
            }
        },
    },
    watch:{
        productsWithImages(){
            if (this.productsWithImages){
                for (const key in this.productsWithImages) {
                    if (this.productsWithImages.hasOwnProperty(key)) {
                        const element = this.productsWithImages[key];
                        let rest = (parseInt(key) + 1) % 2;

                        if (rest == 0){
                            console.log('even',parseInt(key)+1,element.name)
                            this.evens.push(element);
                        }else{
                             console.log('odd',parseInt(key)+1,element.name)
                            this.odds.push(element);
                        }
                    }
                }
            }
        }
    }
}
</script>
