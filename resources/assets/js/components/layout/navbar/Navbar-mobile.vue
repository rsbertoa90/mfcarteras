<template>
    <div class="w-100" id="top">
        <div style="height:90px">

        </div>
        <div class="fixthis row d-flex justify-content-between  pt-2 pb-1">
             
             <button aria-label="menu" 
             class="col-2 navbar-toggler
                    font-weight-bold" 
                     @click="shomenu" >
                <span class="fa fa-bars"></span>
            </button>
            <div :class="{'big-logo':scrollOnTop,
                        'logo':!scrollOnTop}">
                <image-logo></image-logo>
            </div>
            <div :class="{'col-4':scrollOnTop, 'col-6':!scrollOnTop}">

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
    created () {
        window.addEventListener('scroll', this.handleScroll);
    },
    methods:{
       
      handleScroll(){
          this.scrollOnTop =  window.scrollY < 100;
      },
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
        width: 106vw;
    }


.logo{
   /*  margin-top:-23px; */
    max-width: 25vw;
    transition: max-width 0.5s ease-in-out;
}

.big-logo{
  /*   margin-top:-28px; */
    max-width: 40vw;
    transition: max-width 0.5s ease-in-out;
}
</style>