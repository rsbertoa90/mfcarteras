<template>
    <div v-if="product">
        
        <div class="row mt-1 mb-4" v-if="models.length>0">
           
            <div class="col-12 d-flex justify-content-center  align-items-center flex-column w-100"
                :class="{'flex-column':$mq!='lg'}">
                <div class="d-flex ml-1 w-100 justify-content-center" v-if="models && models.length>1">
                    <div  v-for="model in models" 
                            :key="model.name" class="square" 
                            :style="{'background-color':model.color_code}"
                            @click="selectedmodel=model.id">

                    </div>
                </div> <br>
                <div v-for="model in models" :key="model.id" class="model-container ml-2 mr-2">
                    
                    <variant-model v-if="selectedmodel==model.id" :alt="product.name" :id="'asd'+model.id" :key="'asd'+model" :variant_id="model.id"></variant-model>
                </div>
            </div>
            
        </div>

        <hr v-if="models.length>0">

        <div class="row justify-content-center" itemscope itemtype="http://schema.org/Product">
            <div class="col-12 col-lg-6 row">
                <div class="col-12 image-frame" @click="show">
                    <v-lazy-image v-if="!images[0]"  src="/storage/images/app/no-photo.png" alt="sin foto"/>
                    <v-lazy-image  itemprop="image" v-else 
                        :src="images[selectedImage].url" 
                        :alt="product.name" />
                </div>
                <div class="col-12 row" v-if="images[1]">
                    <div  v-if="i-1 != selectedImage"  class="col-4 mt-2 image-frame" v-for="i in images.length" :key="i" @click="selectedImage=i-1">
                        <v-lazy-image :src="images[i-1].url" :alt="product.name"  />
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="d-flex flex-column align-items-start justify-content-around h-100">
                    <div class="d-flex flex-column">
                        <h2> {{product.name | ucFirst}} </h2>
                        
                    </div>
                    <div  class="d-flex align-items-center" v-if="!config.hide_prices">
                        <h2>  ${{product.price}} </h2>
                        <h5> <del class="text-secondary ml-2"> ${{product.price*1.4 |price}} </del> </h5>
                    </div>
                    <div  class="d-flex align-items-center" v-if="product.messures">
                        <p>Medidas: {{product.messures}}</p>
                    </div>
                    <div v-if="product.variants && product.variants.length>0">
                        <span>Variedades disponibles:</span>
                        <ul>
                            <li v-for="variant in product.variants" :style="{color:variant.color_code}" class="ml-4" :key="variant.id" >
                                <span class="fa fa-star"></span> {{variant.name | ucFirst}}
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-column mt-3" v-if="product.description">
                        <h4>Sobre el producto:</h4>
                        <p class="texto"> {{product.description | ucFirst}} </p>
                        <span style="font-size: 0.7rem ; font-style:italic">* Los diseños estan sujetos a disponibilidad</span>
                    </div>
                    <div class="mt-3">
                        <a href="/cotizador" class="btn btn-lg btn-outline-success"> <span class="fa fa-shopping-cart"></span> Hacer pedido</a>
                    </div>
                   <!--  <div class="row mt-3">
                        <div class="col-6 d-flex align-items-center">
                             <span class="fa fa-truck mr-2"></span>
                             <span class="ml-2">Envio a todo el país</span>
                        </div>
                     
                        <div class="col-12 d-flex flex-column">
                            <span><i class="fa fa-arrow-right"></i> Compra minima en local: $1500</span>
                            <span><i class="fa fa-arrow-right"></i> Compra minima para envios: $3000</span>
                            <span><i class="fa fa-arrow-right"></i> Los despachos se realizaran de 1 a 5 días hábiles a partir del informe y acreditación del pago</span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <related-products :category_id="product.category_id"></related-products>
        </div> -->
    </div>
</template>

<script>
import relatedProducts from './related.vue';
export default {
    components:{relatedProducts},
    props:['product_id'],
    data(){
        return{
            selectedImage : 0,
            selectedVariant:null,
            product:null,
           selectedmodel:0,
           
           
            
        }
    },
    computed:{
        models(){
            let res=[];
            if(this.product){
                this.product.variants.forEach(variant=>{
                    if(variant.model_images && variant.model_images.length>1){
                        res.push(variant);
                    }
                });
                if (res.length>0){
                    this.selectedmodel=res[0].id;
                }
            }
            return res;
        },
        config(){return this.$store.getters.getConfig},
       
        
        frontvariant(){
            if (this.product){
                return this.product.variants.find(v => {
                    return v.isfront;
                });
            }
        },
        images(){
            if(this.product){

            
                let res =[];
                if (this.frontvariant){
                   res= res.concat(this.frontvariant.images);
                   
                }
                this.product.variants.forEach(v=>{
                    if (!v.isfront){
                        res = res.concat(v.images);
                         
                    }
                });
            
                return res;
            }
        }
        
    },
     watch:{
        frontvariant(){
            this.selectedVariant = this.frontvariant;
        }
    },
    methods:{
        show(){
            if (this.images){
                let url = this.images[this.selectedImage].url;
                let image = document.createElement('img');
                image.setAttribute('src',url);
                swal({
                    content:image,
                });
            }else{
                    var content = document.createElement("img");
                    $(content).attr('src','/storage/images/app/no-photo.png');
                    content.style.width = '100%';
                    swal({content : content});
            }
        }
    },
    created(){
        var vm=this;
        this.$http.get('/api/product/'+this.product_id)
            .then(res => {
                vm.product = res.data;
            });
    }
}
</script>


<style scope>
    .fa,.fas{
        font-size: 1.5rem;
        text-align: center;
        
    }

    .image-frame{
        border:1px solid #ccc;
        padding:5px;
    }

    .model-container{
        border:1px solid #ccc;
        padding:10px;
        max-width: 500px;
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
</style>