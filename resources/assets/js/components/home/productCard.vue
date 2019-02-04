<template>
<div>
    <div class="variants-clicker d-flex mt-4">
        <span v-for="variant in product.variants" :key="variant.id" 
              class="square" :style="{backgroundColor:variant.color_code}"
              @click="selectedVariant = variant"></span>
    </div>
    <div v-if="product">
        <div  class="image-container" v-if="selectedVariant && selectedVariant.images[0]" 
                @mouseover="hovered=true" @mouseleave="hovered=false">
           <v-lazy-image class="image" :src="selectedVariant.images[0].url" :alt="product.name" />
           <transition enter-active-class="animated fadeIn faster"
                        leave-active-class="animated fadeOut faster position-absolute">
                <v-lazy-image v-if="selectedVariant.images[1] && hovered" 
                         class="overlay image" :src="selectedVariant.images[1].url" :alt="product.name" />
               <!--  <div v-if="!transition" style="height:500px; width:100%;"></div> -->
           </transition>
                        
        </div>
        <div class="d-flex justify-content-between">
            <span> {{product.name}} </span>
            <div v-if="!config.hide_prices">
                <span> ${{product.price |price}} </span>
                <strike class="ml-2 text-secondary"> ${{product.price*1.25 |price}} </strike>
            </div>
        </div>
        <div class="d-flex">
            <a :href="product.slug" class="btn btn-block btn-dark mt-2">VER MAS</a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['product'],
    data(){
        return{
            selectedVariant:null,
            image:null,
            hovered:false,
            transition:true
        }
    },
    computed:{
         config(){return this.$store.getters.getConfig},
        images()
        {
            let res = [];
            
            this.product.variants.forEach(variant => {
                if (variant.images && variant.images.length > 0)
                {
                    res.push(variant.images);
                }
            });

            return res;
        },
         frontvariant(){
            return this.product.variants.find(p => {
                return p.isfront;
            });
        }
    },
    created(){
            this.selectedVariant = this.product.variants.find(p => {
                                        return p.isfront;
                                    });
        }
    
   
   
}
</script>

<style lang="scss" scoped>
.variants-clicker{
    height:40px;
    width:90%;
}
.position-absolute{
    position: absolute;
}

.overlay{
        position:absolute;
        top:0;
        left:0;
        padding: 15px;
        z-index: 50;
       
}

.square{
    display: flex;
    width: 20px;
    height: 20px;
    margin:5px;
    padding:5px;
    border: 1px solid #ccc;
    cursor: pointer;
}


    .image-container{
        overflow: hidden;
        position:relative;
        border:1px solid #ccc;
        padding:15px;
        cursor: pointer;
    }

    /* .image:hover{
            transform: scale(1.2);
            transition: all 1s;
    } */

    .price-badge{
        position:absolute;
        top:5px;
        left:5px;
        background-color: #aaaa;
        color:#fff;
        font-weight: bold;
        padding: 10px;
        font-size: 1.5rem;
        border-radius: 10%;

    }

    .name-banner{
          position:absolute;
        bottom:25%;
        left:0px;
        display: block;
        width: 100%;
        background-color: #ccc8;
        color:#fff;
        font-weight: bold;
        padding: 10px;
        font-size: 2rem;
        text-align: center;
        white-space: normal;
    }
</style>
