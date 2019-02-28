
<template>
<div class="container w-100" v-if="products.length > 0" >
  <hr>
  <h2 class="mb-4">Productos relacionados</h2>
      <!-- swiper -->
      <swiper :options="swiperOption" v-if="render && filteredproducts" class="align-items-stretch">
        <swiper-slide  v-for="product in filteredproducts" :key="product.id" >
            <div class="card" itemscope itemtype="https://schema.org/Product">
                <div>
                  <v-lazy-image class="card-img card-img-top" 
                        :src="product.variants[0].images[0].url"
                        :title="product.name"
                        itemprop="image" 
                        alt="Card image cap" />
                    
                </div>
                <div class="card-body">
                    <h5 class="card-title" itemprop="name" style="height:60px"> {{product.name | ucFirst}}  </h5>
                    <h4 v-if="!$store.getters.getConfig.hide_prices" class="second">  
                      ${{product.price | price}} 
                      <strike style="font-size:1rem"  v-if="!$store.getters.getConfig.hide_prices" class="text-secondary"> ${{product.price * 1.67 | price}}</strike> 
                    </h4>
                   
                    <a :href="product.slug" style="cursor:pointer" class="btn btn-outline-second  white-bold mb-4 mt-1"> Ver mas</a>
                    <p></p>
                </div>
            </div>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
      </swiper>
  
</div>
</template>

<script>
  export default {
    props:['category_id'],
    data() {
      return {
        render:false,
        swiperOption: {
          slidesPerView: null,
          centeredSlides: false,
          spaceBetween: 5,
          /* pagination: {
            el: '.swiper-pagination',
            clickable: true
          }, */
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        },
        
      }
    },
    created(){
        if (this.$mq == 'lg')
        {
            this.swiperOption.slidesPerView = 6;
        } else{
            this.swiperOption.slidesPerView = 2.5;
        }
        this.render=true;
    },
    computed:{
        products(){
            return this.$store.getters.getProducts;
        },
        filteredproducts(){
          if (this.products){
            return this.products.filter(prod =>  {
              return (!prod.paused 
                      && prod.variants 
                      && prod.variants[0]
                      && prod.variants[0].images
                      && prod.variants[0].images[0]
                      );
            });
          }
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