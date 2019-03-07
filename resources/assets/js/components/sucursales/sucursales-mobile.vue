<template>
    <div>
        
            <!-- pasteur -->
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle=""
                             data-target="" aria-expanded="true" aria-controls="collapseOne">
                    MF Carteras
                    </button>
                </h5>
                </div>

                <div id="" class="" aria-labelledby="headingOne" >
                    <div class="card-body row">
                       <div class="col-12">
                           <map-iframe></map-iframe>
                         </div>
                       <div class="col-12">
                            <ul>
                                <li> <b> Dirección: </b> Pasteur 410 </li>
                                <li> <b>Atención: </b> Lunes a viernes de 9 a 18 hs </li>
                                <li>  <b> Teléfono:</b> 11-3187-8362   </li>
                            </ul>
                            <p> MF Carteras se encuentra a metros de Avenida 
                                Corrientes y de la estación Pasteur del subte B.</p>
                       </div>
                    </div>
                </div>
            </div>
           
            
        
    </div>
</template>

<script>
import mapIframe from './iframe.vue';
export default {
    components:{mapIframe}
}
</script>

<style scoped lang="scss">
// violeta oscuro es b2037a
$color-first : #b2037a;

// El verde es 09cca2 
$color-second : #09cca2;

// Rosa fuerte es ff0aaf
$color-focus: #ff0aaf; 

// Rosa claro es ff97dd
$color-back: #ff97dd;


    .btn-link{
        display: block;
        width: 100%;
        height: 100%;
        background-color: $color-focus;
        color: #fff;
        font-weight: bold;
        &:hover{
            cursor: pointer;
            text-decoration: none;
            
        }
    }
</style>
