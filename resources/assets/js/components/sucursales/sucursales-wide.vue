<template>
    <div class="container">
        <div class="row">
            
            <div class="col-12 row mt-3 mb-4">
                <h2 class="col-12 mb-3">MF Carteras</h2>
                <div class="col-6">
                     <map-iframe></map-iframe>
                </div>
                <div class="col-6">
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
</template>

<script>
import mapIframe from './iframe.vue';
export default {
    components:{mapIframe}
}
</script>



