<template>
    <div class="w-100">
       


        <div class="fixed-navbar p-2"
            :class="{'displayed' : scrollOnTop,
                    'nondisplayed': !scrollOnTop}">
            
             <div class="col-4 ">
                <ul class="d-flex justify-content-around align-items-end mb-0">
                    <li> <a href="/cotizador"> Hace tu pedido </a> </li>
                    <li> <a href="/contacto"> Contacto  </a> </li>
                    <li> <a href="/contacto"> Ubicacion  </a> </li>
                </ul>
            </div>
            
            
            <div class=" pt-3"
               :class="{'big-logo':scrollOnTop,
                        'logo':!scrollOnTop}">
                <a href="/" 
                        >
                    <img class="w-100" src="/storage/images/app/logo.png" 
                        alt="logo"
                        >
                        
                </a>
            </div>

             <div class="col-4 offset-1">
                <form class="form-inline" action="/buscar">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" 
                                 aria-label="Buscar productos"
                                placeholder="Que estas buscando?"
                                name="search">
                        <div class="input-group-prepend">
                            <span class="white-bold input-group-text bg-second d-flex justify-content-center" 
                                  id="basic-addon1">
                            <i class="fa fa-search"></i>
                                
                            </span>
                        </div>
                    </div>  
                </form>
            </div>

           
          
        </div>

           <div class="space"> </div>
    </div>
</template>

<script>
import imageLogo from '../images/image-logo.vue';

import {mapGetters} from 'vuex';
export default {
    components : {
        imageLogo,
     
    },
    data(){
        return{
           scrollOnTop : true,
            overMenu : false,
            overNav : false,
     }
    },
    methods :{
      handleScroll(){
          this.scrollOnTop =  window.scrollY < 100;
      }
      
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
},
   
}
</script>

<style lang="scss" scoped >
 $color-first : #1102FF;

// El verde es 09cca2 
$color-second : #24FFB8;

// Rosa fuerte es ff0aaf
$color-focus: #1EAAFF; 

// Rosa claro es ff97dd
$color-back: #0FE0E8;

$color-other: #104DE8;

.displayed{
    min-height: 130px;
    transition: min-height 0.5s ease-in-out;
}
.nondisplayed{
    min-height: 60px;
    transition: min-height 0.5s ease-in-out;
}

.logo{
    max-width: 17vw;
    transition: max-width 0.5s ease-in-out;
}

.big-logo{
   max-width: 25vw;
    transition: max-width 0.5s ease-in-out;
}
ul{
    li{
        display: block;
        
        font-weight: bold;
        &:hover{
            border-bottom: 3px solid #000;
        }
    }
}

.space{

    height: 150px;
}


.fixed-navbar{
   
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    margin-right: 0;
    margin-left: -8%;
    width: 100vw;
    z-index: 300;
   
}


.fa-chevron-down{
    margin-left: 5px;
    font-weight: normal;
}

.subcat
{
    text-align: center;
    padding: 10px;
    margin-bottom: 5px;
   //border:1px solid #fff;
    cursor: pointer;
     color: #fff;
     font-weight: bold;
    &:hover{
       background-color: #eee;
        color: $color-first;
        border-bottom: 3px solid $color-second;
    }
}

.focus-nav-item
{
    background-color: $color-focus;
    width: 80%;
    margin-left: 10%;
    padding: 15px 6px;
}

.fa-phone{
    font-size: 2rem;
}
.nav-row{
           margin: 0px -7.5%;
       }
  
.navbar{
    /* font-weight: bold; */
    color:#000;
    display:flex;
    width: 100%;
    justify-content: space-around;
    align-items: center;
    margin: 0;
    padding: 0;
    li{
        a{
            &:hover{
                color:inherit;
                text-decoration: none;
            }
                display: flex;
                 align-items:center;
                justify-content: center;
                width: 100%;
                height: 100%;
        }

        cursor:pointer;
        padding: 1;
        
        height: 100%;
        width: 20%;
        display: flex;
        align-items:center;
        justify-content: center;
        &:hover{
             background-color: $color-first;
             color: #fff;
             border-bottom: 3px solid $color-second;
            }
        
    }

    .hovered{
           background-color: $color-first;
            color: #fff;
            border-bottom: 3px solid $color-second;
    }
 
     
   

}
</style>