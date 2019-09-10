<template>
    <div id="menu" v-on-click-outside="close" >
        <div id="overlay">

        </div>
        <div class="row w-100 p-0 m-0 d-flex ">
            <div @click.prevent="" class="col-12 p-4 d-flex jusfify-conten-center align-items-center">
                 <form class="form-inline w-100" action="/buscar">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" 
                                 aria-label="Buscar productos"
                                placeholder="Que estas buscando?"
                                name="search">
                    </div>  
                </form>
     
            </div>
            <hr/>
           
                <div class="col-12 p-0">
                    <ul > 
                        <li v-for="route in routes" :key="route.url">
                            <a :href="route.url" >
                                {{route.name | uc}}
                               
                            </a>
                        </li>
                     
                    </ul>
                </div>
       
        </div>
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
            submenuCats:[],
            supercategory:null,
            showCats:false,
            showMenu : false,
            routes : [
            {url : '/',name : 'home'},
         /*    {url : '/cotizador',name : 'Hace tu pedido'}, */
         /*    {url : '/sucursales',name : 'Ubicacion'}, */
            {url : '/contacto',name : 'Contacto'},
        ]
                
            
     }
    },
  
    methods:{
        close(){
            this.$emit('close');
        },
       
    },
    
}
</script>

<style scoped lang="scss">

 $color-first : #1102FF;

 // El verde es 09cca2 
 $color-second : #0FE0E8;

 // Rosa fuerte es ff0aaf
 $color-focus: #1EAAFF;

 // Rosa claro es 24FFB8
 $color-back: #24FFB8;

 $color-other: #104DE8;

.submenucat{
    padding: 5px;
    border:1px solid #ccc;
    display: flex;
    justify-content: center;
    align-items:center;
    text-align:center;
    cursor: pointer;
    &:hover{
          background-color: $color-first;
             color: #fff;
             border-bottom: 3px solid $color-second;
    }    

}



#menu{
        width: 100vw;
       
        background-color: #eee;
        position: absolute;
        top: 105px;
        left: 0;
        z-index: 200;
    }

ul li {
    font-size: 1rem;
    color : #555;
    font-weight: bold;
    border-bottom: 1px solid #ccc;
    padding: 15px;

    a {
        display: block;
    }
}

hr {
  border: 0;
  clear:both;
  display:block;
  width: 96%;               
  background-color:#ccc;
  height: 1px;
}

</style>