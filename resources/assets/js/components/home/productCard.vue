<template>
    <a :href="product.slug" v-if="product">
        <div  class="image-container" v-if="image">
            <v-lazy-image class="image" :src="image.url" :alt="product.name"></v-lazy-image>
            <span class="price-badge">
               ${{product.price}}
            </span>
            <div class="name-banner">
                {{product.name}}
            </div>
        </div>
    </a>
</template>

<script>
export default {
    props:['product'],
    data(){
        return{
            image:null
        }
    },
    created(){
        if (this.product.images){
            this.image = this.product.images[0];
       
        let i = 0;
        setInterval(() => {
            i++;
            if (!this.product.images[i]){
                i=0;
            }
            this.image = this.product.images[i];
        },1000)
         }
    }
}
</script>

<style lang="scss" scoped>

    .image-container{
        overflow: hidden;
        position:relative;
        border:1px solid #ccc;
        padding:15px;
        cursor: pointer;
    }

    .image:hover{
            transform: scale(1.2);
            transition: all 1s;
    }

    .price-badge{
        position:absolute;
        top:5px;
        left:5px;
        background-color: #fa3455cc;
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
        background-color: #fa345599;
        color:#fff;
        font-weight: bold;
        padding: 10px;
        font-size: 2rem;
        text-align: center;
        white-space: normal;
    }
</style>
