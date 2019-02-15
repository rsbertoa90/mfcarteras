<template>
    <div  v-if="images && images.length > 0" @click="touched=true" >
      <v-touch  @press="touched=true" @panleft="panleft" @panright="panright" class="relative" >
          <div :id="'container'+variant_id" class="img-container">
            <img :id="variant_id" :src="images[0].url" :alt="alt" >
          </div>
         
          <div class="overlay" v-if="!touched">
              <span v-if="$mq!='lg'"> Desliza para girar la imagen </span>
              <span v-else> Toca las flechas para girar la imagen </span>
              <span class="mt-2">360°</span>
          </div>

          <div v-if="$mq=='lg'" class="controls">
              <div class="p-1 bg-secondary text-info" @mousedown="spin('left')" @mouseup="stop"> <span class="fa fa-chevron-left"/> </div>
              <div class="p-1 bg-secondary text-info" @mousedown="spin('right')" @mouseup="stop"> <span class="fa fa-chevron-right"></span> </div>
          </div>

      </v-touch>
    </div>
</template>

<script>
import pinchImage from './PinchImage.vue';
export default {
    commponents:{pinchImage},
    props:['variant_id','alt'],
    data(){
        return{
            pressing:false,
            images:null,
            imgarray:[],
            current:null,
            interval:null,
            direction:'left',
            mousex:0,
            ralentizer:0,
            touched:false,
         

        }
    },
    created(){
        this.$http.get('/api/model/'+this.variant_id)
            .then(res => {
                this.images = res.data;
           
                if (res.data){
                    this.current = 0;
                    this.preloadImages();
                    /* this.$refs.touch.enable('swipeleft');
                    this.$refs.touch.enable('swiperight'); */
                }
            });
    },
    methods:{
        panright(){
            this.touched=true;
            if(this.ralentizer > 1){
                if(this.images[this.current+1]){
                    this.current++
                }
                else{
                    this.current=0;
                }

                this.ralentizer = 0;
            }else{this.ralentizer++}
         
        },
        panleft(){
            this.touched=true;
            if(this.ralentizer > 1){
                if(this.images[this.current-1]){
                this.current--
                }
                else{
                    this.current=this.images.length-1;
                }
                this.ralentizer=0;
            }else{this.ralentizer++}
         
        },
        spin(dir){
            var vm=this;
            this.interval = setInterval(function(){
               
                if(dir=='right'){
                    vm.panright();
                }else{vm.panleft();}
            },30);
        },
        stop(){
            clearInterval(this.interval);
        },
        preloadImages(){
            if (this.images)
            {
                console.log("PRELOADING");
                this.images.forEach(img => {
                    let element  = new Image();
                    element.src = img.url;
                    element.id=this.variant_id;
                    element.alt=this.alt;
                    this.imgarray.push(element);
                });
            }
        },
        
    },
    watch:{
        current(){
            if(this.images && this.images.length>0){
                let container_id="container"+this.variant_id;
                let cont = document.getElementById(container_id);
                if(cont){

                    cont.removeChild(cont.childNodes[0]);
                    cont.appendChild(this.imgarray[this.current]);
                }
            }
        }
    },

}
</script>

<style>
    .relative{
        position:relative;
    }
    .controls{
        position:absolute;
        top:45%;
        width:100%;
        display: flex;
        justify-content: space-between;   
        font-size: 2rem;
       
    }

    .overlay{
        position:absolute;
        top:25%;
        width:60%;
        margin-left: 20%;
        display: flex;
        flex-direction: column;
        justify-content: center;   
        font-size: 1.3rem;
        background-color: #555c;
        text-align: center;
        border-radius: 10%;
        color:#fff;

    }

    .img-container{
        overflow: hidden;
    }

</style>