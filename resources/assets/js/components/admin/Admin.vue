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
                <div >
                   
                                
                                <transition-group tag="tbody" 
                                                    enter-active-class="animated slideInLeft faster "
                                                    leave-active-class="animated fadeOutDown faster position-absolute ">
                                <div v-for="product in products" :key="product.id">
                                    <table class="table table-striped table-bordered ">
                                        <tr>

                                            <td >
                                                <img v-if="product.image" 
                                                    :src="product.image" 
                                                    :alt="product.name" @click="productImgModal(product)" >  
                                                <img v-else src="/storage/images/app/no-image.png" 
                                                    alt="no-image" @click="productImgModal(product)"> 
                                            </td>
                                            <td>  
                                               COD: <input v-model.lazy="product.code" @change="saveChange(product,'code')" type="text" class="nametd"> 
                                            </td>
                                            <td>  
                                                <textarea rows="2" placeholder="Nombre" v-model.lazy="product.name" @change="saveChange(product,'name')" type="text"> </textarea> 
                                                <textarea placeholder="Descripcion" v-model="product.description" @change="saveChange(product,'description')" rows="3"></textarea>
                                            </td>
                                            
                                            <td class="text-info text-center"> 
                                                $<input style="width:80%" type="number" v-model.lazy="product.price" @change="saveChange(product,'price')"> 
                                                <button class="btn btn-block mt-3" :class="{'bg-focus white-bold':product.offer}" @click="toggleOffer(product)">Oferta</button>
                                            </td>                
                                            <td class="d-flex flex-column justify-content-center align-items-center">
                                                <input type="checkbox" class="form-control" v-model="product.selected">
                                                <button @click.prevent="deleteProduct(product)" class="btn btn-sm btn-outline-danger m-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button @click.prevent="togglePause(product)" class="btn btn-sm m-1" :class="{'btn-info' : !product.paused, 'btn-success': product.paused}">
                                                    <i :class="{'fa fa-pause-circle' : !product.paused , 'fa fa-play' : product.paused}"></i>
                                                </button>
                                                
                                            </td>
                                        </tr>

                                        <tr v-if="product.variants && product.variants.length > 0"
                                            v-for="variant in product.variants" :key="variant.id">
                                            <td></td>

                                            <td v-if="variant.images && variant.images.length > 0" >
                                                <img :src="variant.images[0].url" :alt="variant.name"  @click="variantImgModal(variant)">
                                            </td>
                                            <td v-else>
                                                <img src="/storage/images/app/no-image.png" :alt="variant.name"  @click="variantImgModal(variant)">
                                            </td>
                                            <td>
                                                <input type="text" v-model.lazy="variant.name" placeholder="nombre" @change="saveVariantChange(variant,'name')">
                                                <br>
                                                <textarea class="mt-1" placeholder="descripcion" type="text" v-model="variant.description" @change="saveVariantChange(variant,'description')" />
                                            </td>
                                            <td>
                                                # <input type="text" v-model.lazy="variant.color_code"
                                                        @change="saveVariantChange(variant,'color_code')">
                                                     <span class="square ml-2" 
                                                            :style="{backgroundColor:'#'+variant.color_code}">
                                                     </span>
                                            </td>
                                             <td class="d-flex flex-column justify-content-center align-items-center">
                                               
                                                <button @click.prevent="deleteVariant(variant)" class="btn btn-sm btn-outline-danger m-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                 <button @click.prevent="toggleVariantPause(variant)" 
                                                         class="btn btn-sm m-1" :class="{'btn-info' : !variant.paused,
                                                                                         'btn-success': variant.paused}">
                                                    <i :class="{'fa fa-pause-circle' : !variant.paused , 
                                                                'fa fa-play' : variant.paused}"></i>
                                                </button>
                                                
                                                
                                            </td>
                                            
                                        </tr>

                                        <tr>
                                            
                                            <td>
                                                <b>
                                                    Nueva Variacion
                                                </b>
                                            </td>
                                            <td>
                                                Nombre 
                                                <br>
                                                <input type="text" v-model.lazy="newvariant.name">
                                            </td>
                                            <td>
                                                Descripcion <textarea type="text" v-model.lazy="newvariant.description"/>                                            </td>
                                            </td>
                                            <td>
                                                Codigo color <input type="text" v-model.lazy="newvariant.color_code"/>
                                                <span class="square" :style="{backgroundColor:'#'+newvariant.color_code}"></span>                                            </td>
                                            </td>
                                            <td>
                                                <button @click="saveNewvariant(product.id)" class="btn btn-outline-success mt-1">Guardar</button>
                                            </td>
                                            
                                            
                                        </tr>
                                    </table>
                                </div>
                                </transition-group>
                </div>
                <variantimage-modal :variant="variant"  ref="variantModal" @refresh="refresh()">

                </variantimage-modal>

                <productimage-modal :product="product"  ref="productModal" @refresh="refresh()">

                </productimage-modal>
        </div>

        
    </div>
</template>

<script>
import variantimageModal from './VariantImageModal.vue';
import productimageModal from './ProductImageModal.vue';
import adminCreate from './Create.vue';
import { mapActions } from 'vuex';
    export default {
        components : {
            productimageModal,
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
                newvariant:{
                    description:'',
                    name: '',
                    color_code:'',
                },
                list : [],
                variant : null,
                product:null,
                showModal : false,
            }
        },
        methods : {
             ...mapActions({
            fetchUser : 'fetchUser',
            fetchConfig : 'fetchConfig',
            fetchProducts: 'fetchProducts'
            }),
            saveNewvariant(product_id){
                var vm = this;
                let data = vm.newvariant;
                data.product_id = product_id;

                this.$http.post('/admin/variant',data)
                    .then(res => {
                        this.newvariant = {
                            name:'',
                            color:'000',
                            product_id:0
                        }
                        vm.fetchProducts();
                    });

            },
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
            toggleOffer(product){
                product.offer = ! product.offer;
                var data = {
                    product : product.id,
                    field : 'offer',
                    value : product.offer ? 1 : 0
                }
                $.ajax({
                    method : 'put',
                    data : data,
                    url : '/admin/product'
                });
            },
            togglePause(product){
                var vm = this;
                product.paused = !product.paused;
                vm.saveChange(product,'paused');
               

                
            },
            toggleVariantPause(variant){
                var vm = this;
                variant.paused = !variant.paused;
                vm.saveVariantChange(variant,'paused');
               

                
            },
            deleteProduct(product){
                var vm = this;
                this.$http.delete('/admin/product/'+product.id)
                this.fetchProducts();
            },
            logme(e){console.log(e)},
            refresh(){
                var vm = this;
                vm.fetchProducts();
            },
            saveChange(product,field){
                var data = {
                    product : product.id,
                    field : field,
                    value : product[field]
                }
                if (data.field == 'paused')
                {
                    data.value = data.value ? 1 : 0;
                }
                $.ajax({
                    method : 'put',
                    data : data,
                    url : '/admin/product'
                });
            },
            saveVariantChange(variant,field){
                var data = {
                    id : variant.id,
                    field : field,
                    value : variant[field]
                }
                 if (data.field == 'paused')
                {
                    data.value = data.value ? 1 : 0;
                }

                
                $.ajax({
                    method : 'put',
                    data : data,
                    url : '/admin/variant'
                });
            },
            variantImgModal(variant){
                this.variant = variant;
                this.showModal = true;
                let element = this.$refs.variantModal.$el
                
                $(element).modal('show')
            },
            productImgModal(product){
                this.product = product;
                this.showModal = true;
                let element = this.$refs.productModal.$el
                
                $(element).modal('show')
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
            applyvariant()
            {
                var vm =this;
                var variant = 1+(this.variant/100);
                this.selectedProducts.forEach(prod => {
                    prod.price = prod.price * variant;
                    vm.saveChange(prod,'price');
                });
                vm.refresh();
                vm.variant = 0;
            }
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
