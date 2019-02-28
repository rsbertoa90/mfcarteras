<template>
    <div>
         <div class="card-header bg-white" :id="'card'+product.id">
                  
                    <h5 class="mb-0">
                        <button class="btn bg-white  btn-link w-100 text-left text-big d-flex align-items-center white-space-normal" 
                                data-toggle="collapse" 
                                :data-target="'#acordion'+product.id" 
                                aria-expanded="true" 
                                :aria-controls="product.name">

                                <div class="product-miniature" v-if="frontVariant && frontVariant.images[0]">
                                    <v-lazy-image :src="frontVariant.images[0].url"></v-lazy-image>
                                </div>
                                <div class="d-flex" :class="{'flex-column':$mq !='lg'}">
                                    <span v-if="user && user.role_id <= 2">
                                       COD: {{product.code}} - 
                                    </span>
                                    
                                    <span class="white-space-normal">
                                        {{product.name.ucfirst()}}
                                    </span>
                                    <br>
                                    <span v-if="!configs.hide_prices" class="price-badge" 
                                            :class="{'ml-3':$mq=='lg'}">
                                          ${{product.price}}
                                    </span>
                                </div>
                                   
                        </button>
                    </h5>
                </div>
                <div :id="'acordion'+product.id" class="collapse collapsed " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                       <table class="table table-bordered border-black bg-white font-weight-bold ">
                           <thead class="">
                               <th></th>
                               <th>Foto</th>
                               <th>Color</th>
                               <th>Quiero</th>
                               <th></th>
                               
                           </thead>
                           <tbody>
                               <tr v-for="variant in product.variants" :key="variant.id" v-if="!variant.paused">
                                   <td></td>
                                   <td @click="show(variant)" >
                                        <v-lazy-image v-if="variant.images.length > 0" 
                                            class="sampleImage" :src="variant.images[0].url" 
                                            :alt="variant.name"  /> 
                                        <v-lazy-image class="sampleImage" v-else src="/storage/images/app/no-photo.png" 
                                            alt="Sin foto" />
                                    </td>
                                   <td style="cursor:pointer" @click="show(variant)"> 
                                       <span style="font-size: 1.3rem">

                                        {{product.name}} - {{variant.name | ucFirst}} 
                                       </span>
                                        <br>
                                        {{variant.description}}   
                                    </td>
                                   
                                   
                                   <td v-if="!variant.paused"><input type="number" min="0" class="form-control " v-model="variant.units">
                                        
                                        <div v-if="variant.units > 0" class="text-success d-flex flex-column p-0 m-0 justify-content-center align-items-start">
                                            
                                            <span class="text-success font-weight-bold">  ${{(variant.product.price * variant.units) | price}} </span>
                                            
                                        </div>
                                   
                                   </td>
                                  
                                   
                                  
                                  <td></td>
                               </tr>
                           </tbody>
                       </table>
                    </div>
                </div>
     <carousel ref="modal" :variant ="carouselvariant" @closeModal="carouselvariant = null"></carousel>
    </div>
</template>

<script>
 import { mapActions } from 'vuex';
 import { mapGetters } from 'vuex';
 import carousel from './Img-modal.vue';
export default {
    props:['product'],
    components:{carousel},
    data(){
        return{
            showCarousel : false,
                carouselvariant : null
        }
    },
     computed: {
            ...mapGetters({
                products : 'getProducts',
               user : 'getUser',
               configs:'getConfig'
            }),
        frontVariant(){
            return this.product.variants.find(v => {
                return v.isfront;
            });
        },
    },
        methods:{
                show(variant){
                if (variant.images[0]){
                    this.carouselvariant = variant;
                    this.showCarousel = true;
    
                    let element = this.$refs.modal.$el;
                  
                    $(element).modal('show');
                }
                else
                {
                    var content = document.createElement("img");
                    $(content).attr('src','/storage/images/app/no-photo.png');
                    content.style.width = '100%';
                    swal({content : content});
                }
            }
        }
    }



</script>

<style scoped lang="scss">

.price-badge{
    background-color: #dc3545;
    color:#fff;
    padding:3px;
    border-radius:10%;
}

 .table,.accordion,.tr,.td,.kalam,.card{
    font-family:  'Kalam', cursive;
}


.white-space-normal{
    white-space: normal;
}
.text-big{
    font-size: 1.5rem;
}
.product-miniature{
    min-width: 200px;
    width: 200px;
    margin-right: 15px;
}
.container{
    
    margin-bottom: 100px;
  
    }

    td{
        white-space:normal;
    }
    input[type="number"]{
        width: 70px;
    }

    


   .btn-link {color : black;}
    #total {
        position: fixed;
        /* margin-left:50vw; */
        bottom: 20px;
        z-index: 100;
    }
    img{width:100%}

    @media(max-width: 600px){
        .product-miniature{
    min-width: 100px;
}
        .card-header{
            padding:0;
        }
        .container{
    
            margin-left: -7%;
            width: 100vw;
            padding: 15px;
            }
        .sampleImage{width: 80px;}
        td { white-space :normal;}
        table {
            font-size: 0.66rem;
            font-weight: bold;
        }
       
        .card-body,table th, table td{padding:5px;}
    }
    
    @media(min-width: 600px){
        .sampleImage{width: 150px;}
        table{ font-size: 1rem; font-weight: normal}
        td {white-space: normal;}
        .card-body,.container{padding:1.25rem}
        
    }
   
</style>
