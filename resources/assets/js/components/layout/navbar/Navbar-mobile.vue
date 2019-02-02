<template>
    <div class="w-100" id="top">
        <div style="height:90px">

        </div>
        <div class="fixthis row d-flex justify-content-between pt-2 pb-1">
             <button aria-label="menu" 
             class="col-2 navbar-toggler
                    font-weight-bold" 
                     @click="shomenu" >
                <span class="fa fa-bars"></span>
            </button>
            <div class="col-6">
                <image-logo></image-logo>
            </div>
            <div class="col-4">

            </div>
        </div>
         
        <mobile-menu v-if="showMenu" 
                        @close="showMenu=false"></mobile-menu>

  

    


         

      
    </div>
</template>

<script>
import imageLogo from '../images/image-logo.vue';
import mobileMenu from './mobile-menu.vue'
import {mapGetters} from 'vuex';
export default {
    components : {
        imageLogo,
        mobileMenu
    },
    data(){
        return{
            showMenu : false,
             scrollOnTop : true,
     }
    },
 
    methods:{
        shomenu(){
            this.showMenu=true;
            window.scrollTo(0, 0);
        },
       
      handleScroll(){
          this.scrollOnTop =  window.scrollY < 100;
      }
      
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
},
     data(){
        return{
            showMenu : false,
             scrollOnTop : true,
     }
    },
    
    
    methods:{
        shomenu(){
            this.showMenu=true;
            window.scrollTo(0, 0);
        },
       
      handleScroll(){
          this.scrollOnTop =  window.scrollY < 100;
      }
      
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
},
    
}
</script>

<style>
  
    .fixthis{
        position: fixed;
        z-index: 200;
        top:0;
        left:0;
        background-color: #f5f8fa;
        width: 99.99vw;
    }

</style>