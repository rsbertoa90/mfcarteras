<template>
    <div class="container">   
        <div class="row">
            <h1 class="col-12 col-lg-6 text-center kalam" v-if="user && user.role_id > 2">Hace tu pedido</h1>
            <h1 class="col-12 col-lg-6 text-center kalam" v-else>Tomar pedido</h1>
            <a href="/lista-de-precios" class="col-12 col-lg-6 btn btn-lg btn-outline-info kalam"> <span class="fas fa-download"></span> Descargar lista de precios</a>
        </div>
        <div class="row">
            <home-info></home-info>
        </div>
             
          <div class="row d-flex flex-column" v-if="user && user.role_id <= 2">
            <code-selector @listChange="listChange" :products="products" :list="list" v-if="user.role_id <= 2"></code-selector>
             <div v-if="list.length > 0">
                <pedido :list="list"></pedido>
             </div>
          </div>  
             
             <hr>
             
        <div id="accordion">
            <div v-for="(product,i) in notPausedProducts" 
                  :key="'product-'+product.id" 
                  class="card flex-wrap" >
               <cotizer-producttable :product="product" :first="i == 0"></cotizer-producttable>
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
       
      <!--   <tutorial></tutorial> -->
    </div>
</template>

<script>
 import { mapActions } from 'vuex';
 import { mapGetters } from 'vuex';
    import cotizerProducttable from './CotizerProductTable.vue';
    import codeSelector from './code-selector.vue';
    import homeInfo from '../home/info.vue';
    
    import pedido from './pedido.vue';
    import tutorial from './tutorial.vue'
    export default {
        components : {homeInfo,pedido,tutorial,cotizerProducttable,codeSelector},
        data(){
            return {
                selector:{
                    code:'',
                    name:'',
                    variant:null,
                    units:0
                },

                list : [],
                
            }
        },

        watch : {
            'selector.code'(){
                var  vm = this;
                var res =false;
                this.products.forEach(prod => {
                    prod.variants.forEach(variant => {
                        if (vm.selector.code == variant.code){
                            vm.selector.variant = variant;
                            vm.selector.name = variant.name;
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
                products : 'getProductsnotpaused',
               user : 'getUser',
               configs:'getConfig'
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
                if(variant){
                    variant.units = event.units;
                }

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
