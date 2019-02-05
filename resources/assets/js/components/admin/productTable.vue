<template>
<div>
    <table class="table table-striped table-bordered ">
                                        <tr>

                                            <td >
                                                <img v-if="frontvariant && frontvariant.images[0]" 
                                                    :src="frontvariant.images[0].url" 
                                                    :alt="product.name" >  
                                                <img v-else src="/storage/images/app/no-image.png" 
                                                    alt="no-image"> 
                                            </td>
                                            <td>  
                                               COD: <input v-model.lazy="product.code" @change="saveChange('code')" type="text" class="nametd"> 
                                            </td>
                                            <td>  
                                                <textarea rows="2" placeholder="Nombre" v-model.lazy="product.name" @change="saveChange('name')" type="text"> </textarea> 
                                                <textarea placeholder="Descripcion" v-model="product.description" @change="saveChange('description')" rows="3"></textarea>
                                                <input type="text" placeholder="Medidas" v-model="product.messures" @change="saveChange('messures')" />
                                            </td>
                                            
                                            <td class="text-info text-center"> 
                                                $<input style="width:80%" type="number" v-model.lazy="product.price" @change="saveChange('price')"> 
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
                                                 <input type="text" placeholder="#fff" v-model.lazy="variant.color_code"
                                                        @change="saveVariantChange(variant,'color_code')">
                                                     <span class="square ml-2" 
                                                            :style="{backgroundColor:variant.color_code}">
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
                                                
                                                <button @click="toggleVariantIsfront(variant)" class="btn btn-sm m-1" :class="{'btn-secondary' : !variant.isfront,
                                                                                         'btn-success': variant.isfront}"  >
                                                        <i class="fas fa-portrait"></i>
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
                                                Codigo color <input placeholder="#fff" type="text" v-model.lazy="newvariant.color_code"/>
                                                <span class="square" :style="{backgroundColor:newvariant.color_code}"></span>                                            </td>
                                            </td>
                                            <td>
                                                <button @click="saveNewvariant(product.id)" class="btn btn-outline-success mt-1">Guardar</button>
                                            </td>
                                            
                                            
                                        </tr>
                                </table>
            <variantimage-modal :variant="variant"  ref="variantModal" @refresh="refresh()" />
         
        </div>
</template>

<script>
import variantimageModal from './VariantImageModal.vue';
import { mapActions } from 'vuex';
export default {
    props:['product'],
    components:{variantimageModal},
    data(){return{
        variant:null,
         newvariant:{
                    description:'',
                    name: '',
                    color_code:'',
                },
    }},
    computed:{
        frontvariant(){
            return this.product.variants.find(p => {
                return p.isfront;
            });
        }
    },
    methods:{
          ...mapActions({
            fetchUser : 'fetchUser',
            fetchConfig : 'fetchConfig',
            fetchProducts: 'fetchProducts'
            }),

        applyvariant()
            {
                var vm =this;
                var variant = 1+(this.variant/100);
                this.selectedProducts.forEach(prod => {
                    prod.price = prod.price * variant;
                    vm.saveChange('price');
                });
                vm.refresh();
                vm.variant = 0;
            },
            deleteVariant(variant)
            {   
                var vm=this;
                this.$http.delete('/admin/variant/'+variant.id)
                    .then(res => {
                        vm.refresh();
                    });
            },
             variantImgModal(variant){
                this.variant = variant;
                this.showModal = true;
                let element = this.$refs.variantModal.$el
                
                $(element).modal('show')
            },
             saveVariantChange(variant,field){
                 var vm= this;
                var data = {
                    id : variant.id,
                    field : field,
                    value : variant[field]
                }
                 if (data.field == 'paused')
                {
                    data.value = data.value ? 1 : 0;
                }

                this.$http.put('/admin/variant',data)
                    .then(response => {
                         vm.refresh();
                    });
            },
            saveChange(field){
                var data = {
                    product : this.product.id,
                    field : field,
                    value : this.product[field]
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
           refresh(){
                var vm = this;
                vm.fetchProducts();
            },
          

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
                vm.saveChange('paused');
               

                
            },
            toggleVariantPause(variant){
                var vm = this;
                variant.paused = !variant.paused;
                vm.saveVariantChange(variant,'paused');
            },
            toggleVariantIsfront(variant){
                var vm = this;
                this.product.variants.forEach(v => {
                    v.isfront = false;
                });
                
                variant.isfront = true;
                vm.product.variants.forEach(v => {
                    vm.saveVariantChange(v,'isfront');
                });
                
            },
            deleteProduct(product){
                if (product.variants && product.variants.length > 0)
                {
                    swal('Alerta','Antes de borrar un producto elimine sus variantes','error');
                }
                else {
                    var vm = this;
                    this.$http.delete('/admin/product/'+product.id) 
                        .then(res => {
                            vm.refresh();
                        });
                    
                }
            },
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
