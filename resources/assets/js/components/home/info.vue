<template>
        <div class="row mt-3 ml-4">
           
            <div class="col-12 col-lg-4 icon-container row d-flex align-items-center">
                    <i class="icon fas fa-chart-line col-1"></i>
                    <span class="text-center col-10">Aumenta tus ingresos con nuestros productos</span>
            </div>
        
            <div class="col-12  col-lg-4 icon-container row d-flex align-items-center">
                    <i class="fas fa-dollar-sign col-1"></i>
                    <span class="text-center col-10" v-if="config">Inversion minima: Por local ${{config.minbuy}} / Envio ${{config.minbuy_ship}}</span>
            </div>
        
            <div class="col-12  col-lg-4 icon-container row d-flex align-items-center">
                    <i class="icon fas fa-truck col-1"></i>
                    <span class="text-center col-10">Envío a todo el país</span>
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
        font-size:1.3rem;
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
              padding: 5px;
         }

    }
</style>