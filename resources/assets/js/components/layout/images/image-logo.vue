<template> 
    <div class=" pt-3"
        :class="{'big-logo':scrollOnTop,
                'logo':!scrollOnTop}">
        <a href="/" 
                >
            <img  src="/storage/images/app/logo.png" 
                alt="logo"
                >
                
        </a>
    </div>
</template>


<script>
export default {
    
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

<style scoped>
    img{width: 100%}


.logo{
    font-family: 'Permanent Marker', cursive;
    font-size: 2.5rem;
    transition: font-size 0.5s ease-in-out;
}

.biglogo{
    font-size: 4rem;
     transition: font-size 0.5s ease-in-out;
}


</style>
