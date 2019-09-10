<template>
    
    <div class="row">
       <div class="row" v-if="config">
           <div class="row mt-4 mb-4">
               <button class="ml-4 btn btn-lg btn-info" @click="generarCatalogo()">Generar Catalogo</button>
               <a href="/descargar-catalogo" class="ml-4 btn btn-lg btn-info">Descargar Catalogo</a>
           </div>
           <div class="col-12">
               Minimo de compra en local
               <input type="number" v-model.lazy="config.minbuy" 
                      @change="updateconfig('minbuy')">
           </div>
           <div class="col-12">
               Minimo de compra envios
               <input type="number" v-model.lazy="config.minbuy_ship" 
                      @change="updateconfig('minbuy_ship')">
           </div>
       </div>
        <div class="col-12 mt-4">
            <hr>
            <super-metadata></super-metadata>
            <hr>
        </div>
        
    </div>
</template>

<script>
import superCategories from './categories.vue';
import superSupercategories from './supercategories.vue';
import superMetadata from './metadata.vue'
export default {
    components : {
        superCategories,
        superMetadata,
        superSupercategories
    },
    computed:{
        config(){
            return this.$store.getters.getConfig;
        }
    },
    methods:{
        generarCatalogo(){
            this.$http.get('/api/catalogo-job')
                .then(()=>{
                    swal('Procedimiento iniciado','espera unos minutos para ver los cambios','success');
                });
        },
        updateconfig(field)
        {
            let data = {
                field:field,
                value:this.config[field]
            }
            this.$http.put('/admin/config',data);
        }
    },
    data(){
        return{
            
        }
    }

}
</script>
