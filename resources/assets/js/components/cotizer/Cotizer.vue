<template>
    <div class="container">   
        <div class="row">
            <h1 class="col-12 col-lg-6 text-center kalam" v-if="user && user.role_id > 2">Hace tu pedido</h1>
            <h1 class="col-12 col-lg-6 text-center kalam" v-else>Tomar pedido</h1>
            <a href="/lista-de-precios" class="col-12 col-lg-6 btn btn-lg btn-outline-info kalam"> <span class="fas fa-download"></span> Descargar lista de precios</a>
        </div>
             
            
        
             
             <hr>
             
        <div id="accordion">
            <div v-for="product in notPausedProducts" 
                  :key="'product-'+product.id" 
                  class="card flex-wrap" >
                <div class="card-header bg-white" :id="'card'+product.id">
                  
                    <h5 class="mb-0">
                        <button class="btn bg-white  btn-link w-100 text-left text-big d-flex align-items-center w-100" 
                                data-toggle="collapse" 
                                :data-target="'#acordion'+product.id" 
                                aria-expanded="true" 
                                :aria-controls="product.name">
                                   <div class="product-miniature">
                                        <v-lazy-image :src="product.image"></v-lazy-image>
                                    </div>
                                    <span class="white-space-normal">
                                        {{product.name.ucfirst()}}
                                    </span>
                                    <br>
                                    <span class="ml-4">
                                          ${{product.price}}
                                    </span>
                                   
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
            </div>
        </div>
        
        <transition enter-active-class="animated bounceIn" leave-active-class="animated fadeOutDown">
            <div v-if="total > 0" id="total"  class="col-12 row d-flex flex-column justify-content-center align-items-center w-100">
                <div  class="bg-success p-1 col-6 col-lg-2">
                    <div class="col-12 bg-white d-flex justify-content-center">
                    TOTAL : ${{total | price}}
                    </div>
                </div>
                <div  class="bg-success p-1 col-6 col-lg-2">
                    <div class="col-12 bg-white d-flex justify-content-center">
                        <a href="#form">Terminar pedido</a>
                    </div>
                </div>    
            </div>    
        </transition>
        <hr>
        <div>
            <cotizer-form :list="list" :total="total"></cotizer-form>
        </div>
        <div v-if="list.length > 0">
            <pedido :list="list"></pedido>
        </div>
        <carousel ref="modal" :variant ="carouselvariant" @closeModal="carouselvariant = null"></carousel>
      <!--   <tutorial></tutorial> -->
    </div>
</template>

<script>
 import { mapActions } from 'vuex';
 import { mapGetters } from 'vuex';
    import carousel from './Img-modal.vue';
    import pedido from './pedido.vue';
    import tutorial from './tutorial.vue'
    export default {
        components : {carousel,pedido,tutorial},
        data(){
            return {
                selector:{
                    code:'',
                    name:'',
                    variant:null,
                    units:0
                },

                list : [],
                showCarousel : false,
                carouselvariant : null
            }
        },

        watch : {
            'selector.code'(){
                var  vm = this;
                var res =false;
                this.products.forEach(cat => {
                    cat.variants.forEach(prod => {
                        if (vm.selector.code == prod.code){
                            vm.selector.variant = prod;
                            vm.selector.name = prod.name;
                            res = true;
                        }
                    });
                });
                if (!res){
                    vm.selector.variant = null;
                    vm.selector.name='';
                }
            },
            total() {
                   var result = [];
                   var vm = this;
                    vm.products.forEach(function(product){
                    var vars = product.variants.filter(function(el){     
                        return ( el.units != null & el.units > 0 );
                    });
                    if (vars.length > 0){
                        result.push(vars);
                    }
                    
                });
                   
                vm.list = [].concat.apply([], result);
               
            }
        },
        computed: {
            ...mapGetters({
                products : 'getProducts',
               user : 'getUser'
            }),
            notPausedProducts(){
                return this.products.filter(p => {
                    return !p.paused
                });
            },
            
            total() {
                var vm = this;
                var tot = 0;
                vm.products.forEach(function(product){
                    product.variants.forEach(function(variant){
                        if (variant.units > 0)
                        {
                            
                           tot+= variant.product.price * variant.units
                            
                        }
                    });
                });
                return tot;
            }
        },

        methods:
        {
             listChange(event){
                let variant = this.list.find(vari => {
                    return vari.id == event.id;
                });
                variant.units = event.units;

            },
             addSelectorvariant(){
                var vm = this;
                if (vm.selector.units > 0 && vm.selector.variant != null ){
                    let prod = this.selector.variant;
                    if (prod.units == undefined)
                    {
                        Vue.set(prod,'units',0);
                    }
                   prod.units = this.selector.units;
                   vm.selector.variant = null;
                   vm.selector.code = '';
                   vm.selector.units = 0;
                   vm.selector.name ='';
                   
                }
            },
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
        },     
    }
</script>

<style scoped lang="scss">

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
