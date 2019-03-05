<template>
        <div class="col-12 row d-flex mt-3">
           
            <div class="col-10 offset-2 offset-lg-0 col-lg-4 icon-container">
                    <i class="icon fas fa-chart-line"></i>
                    <span class="text-center">Aumenta tus ingresos con nuestros productos</span>
            </div>
        
            <div class="col-10 offset-2 offset-lg-0 col-lg-4 icon-container">
                    <i class="fas fa-dollar-sign"></i>
                    <span class="text-center" v-if="config">Inversion minima: Por local ${{config.minbuy}} / Envio ${{config.minbuy_ship}}</span>
            </div>
        
            <div class="col-10 offset-2 offset-lg-0 col-lg-4 icon-container">
                    <i class="icon fas fa-truck"></i>
                    <span class="text-center">Envío a todo el país</span>
            </div>
    

        </div>

</template>

<script>
export default {
    computed:{
        config(){
            return this.$store.getters.getConfig;
        }
    }
}
</script>

<style lang="scss" scoped>
 

      .fa,.far,.fas{
        font-size: 40px;
        margin-right: 10px;
    }

    .icon-container{
        display: flex;
        padding: 15px;
        align-items:flex-start;
        font-size:1.5rem;
    }


   .icon{
        padding: 10px;
       
        display:flex;
        align-items:center;
        justify-content: center;
       
    }

    @media(max-width:600px){
         .icon-container{
             font-size:1.25rem;
         }

    }
</style>