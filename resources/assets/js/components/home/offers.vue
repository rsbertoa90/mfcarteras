
<template>
<div class="row" v-if="offers.length > 0" >
  <hr>
  <div class="col-12 text-center">
    <h2 class="mb-4 text-center">OFERTAS DEL MES DE REDLIMP</h2>
  </div>
  <div class="col-12 row  d-flex align-items-stretch">
    <div v-for="product in offers" :key="product.id" class="p-4">
      <div class="card h-100 text-center" style="width: 18rem;">
        <v-lazy-image  v-if="product.images[0]"  class="card-img-top" :src="product.images[0].url" :alt="product.name" />
        <v-lazy-image  v-else  class="card-img-top" src="/storage/images/app/no-photo.png" :alt="product.name" />
        <div class="card-body">
          <h5 class="card-title"> {{product.name}} </h5>
          <p class="card-text"> {{product.description}} </p>
          <a :href="product.slug" class="btn btn-primary mt-3"> Ver mas </a>
        </div>
    </div>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
      
       
        
      }
    },
    computed:{
     
        offers(){
            return this.$store.getters['categories/getOffers'];
        }
    },
    methods: {
      appendSlide() {
        this.swiperSlides.push(this.swiperSlides.length + 1)
      },
      prependSlide() {
        this.swiperSlides.unshift(this.swiperSlides[0] - 1)
      },
      popSlide() {
        this.swiperSlides.pop()
      },
      shiftSlide() {
        this.swiperSlides.shift()
      }
    }
  }
</script>

<style scoped>


  .badge{
    font-size: 1.2rem;
  }
  .append-buttons {
    text-align: center;
    margin-top: 20px;
  }
  .append-buttons a {
    display: inline-block;
    margin: 0 10px;
  }
  .container{
      width: 100vw;
  }
  .card-img-overlay{
    max-height: 60%;
  }
</style>