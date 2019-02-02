<template>
    <div class="container">   
        
     
        <div>
           
             <!-- <div class="row w-100 d-flex justify-content-center">
                 <img src="/storage/images/app/logo.png" style="width : 200px ; height: 110px" alt="logo">
             </div>  --> 
                <hr>
                <h1>Administrar Productos</h1>
                <button @click="toggleHidePrices" 
                        v-if="config && !config.hide_prices" class="btn btn-lg btn-outline-danger">
                    Ocultar precios al publico
                </button>
                <button @click="toggleHidePrices" v-else class="btn btn-lg btn-outline-success">
                    Mostrar precios al publico
                </button>
                <hr>
                <div class="row w-100">
                    <div class="col-12 col-lg-8">
                        <admin-create @productSaved="refresh"></admin-create>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                        <h4>Cambiar precios masivo</h4>
                        <h5> {{selectedProducts.length}} Productos seleccionados </h5>
                        <button @click="selectAllProducts" class="btn btn-sm btn-outline-danger mb-2">Seleccionar todos</button>
                        <div class="d-flex justify-content-center"> 
                            <button class="mr-2" @click="variant-=1">-</button>
                            <input style="width:45px; text-align-center" type="number" v-model="variant"> %
                            <button class="ml-2" @click="variant+=1">+</button>
                        
                        </div>
                            <button class="btn btn-md btn-outline-success mt-1" v-if="variant != 0 && selectedProducts.length > 0" @click="applyvariant">Aplicar</button>
                    </div>
                </div>
                <hr>
                <div>          
                                <transition-group tag="tbody" 
                                                    enter-active-class="animated slideInLeft faster "
                                                    leave-active-class="animated fadeOutDown faster position-absolute ">
                                <div v-for="product in products" :key="product.id">
                                    <product-table :product="product"></product-table>
                                </div>
                                </transition-group>
                </div>
        </div>     
    </div>
</template>

<script>
import variantimageModal from './VariantImageModal.vue';
import  productTable from './productTable.vue';
import adminCreate from './Create.vue';

    export default {
        components : {
            productTable,
            adminCreate,
            variantimageModal
        },
        computed : {
            products()
            {
                return this.$store.getters.getProducts;
            },
            config(){
                return this.$store.getters.getConfig;
            },
            selectedProducts()
            {
                var list =[];
               
                    this.products.forEach(prod => {
                        if (prod.selected)
                        {
                            list.push(prod);
                        }
                    });
            
                return list;
            }
        },
        data(){
            return {
                variant : 0,
               
                list : [],
                variant : null,
                product:null,
                showModal : false,
            }
        },
        methods : {

            
            fetchUser (){ this.$store.dispatch('fetchUser')},
            fetchConfig(){ this.$store.dispatch('fetchConfig')},
            fetchProducts(){ this.$store.dispatch('fetchProducts')},
            
         
            toggleHidePrices(){
                if (this.config.hide_prices)
                {
                    this.config.hide_prices =0;
                }else{
                    this.config.hide_prices =1;
                }
                var vm = this;
                this.$http.put('/admin/config',{field:'hide_prices',value:this.config.hide_prices})
                    .then(response => {
                       vm.fetchConfig;
                       console.log(vm.config.hide_prices);
                    });
            },
            
            logme(e){console.log(e)},
            refresh(){
                var vm = this;
                vm.fetchProducts();
            },
            
           
           
           
            selectAllProducts()
            {
                

                    this.products.forEach(prod => {
                        if (prod.selected == undefined)
                        {
                            Vue.set(prod,'selected',true)
                        }
                        else {
                            prod.selected = true;
                        }
                    });
            
            },
            
        },
        

            
        
        filters : {
            price(value){
                return  value.toFixed(2);
            }
        }
    }
</script>

<style scoped>
.square{
    display: flex;
    max-width: 30px;
    height: 30px;
    margin:5px;
    padding:5px;
    border: 1px solid #ccc;
}
.btn-link {color : black;}
    td img {
        width: 10vw;
    }
textarea{
    width:100%;
}
input[type="checkbox"]{
    width: 25px;
    margin: 0 10px;
}
   @media(max-width: 600px){
       table,.container,.card,.card-body {font-size: 0.66rem ; padding : 0}
       
       th,td, input{
           white-space:nowrap;
           width: 13vw;
           padding: 2px;
       }
       .form-control{width: 20vw;}
       .nametd {width: 25vw;}
   }
</style>
