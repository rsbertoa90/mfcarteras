<template>
    <div  v-if="images && images.length > 0" @click="touched=true" >
      <v-touch  @press="touched=true" @panleft="panleft" @panright="panright" class="relative" >
          <div :id="'container'+variant_id" class="img-container">
            <img :id="variant_id" :src="images[0].url" :alt="alt" >
          </div>
         
          <div class="overlay" v-if="!touched && $mq!='lg'">
              <!-- <span v-if="$mq!='lg'"> Desliza para girar la imagen </span>
              <span v-else> Toca las flechas para girar la imagen </span>
              <span class="mt-2">360°</span> -->
              <span class="fas fa-hand-point-up bigicon" :style="handmove"></span>
              <div class="arrows">
                <span v-for="i in 5" :key="i" class="fas fa-arrow-right ml-2"></span>
              </div>
              <div class="slidetext">
                  <span>Desliza!</span>
              </div>
              
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
            current:0,
            direction:'left',
            mousex:0,
            ralentizer:0,
            touched:false,
            handmovemargin:1,
            interval:null,
            handmoveinterval:null,
            softspininterval:null
         

        }
    },
    created(){
        this.$http.get('/api/model/'+this.variant_id)
            .then(res => {
                this.images = res.data;
           
                if (res.data){
                    this.current = 0;
                    this.preloadImages();
                    this.softspin();
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
            this.touched=true;
            this.interval = setInterval(function(){
               
                if(dir=='right'){
                    vm.panright();
                }else{vm.panleft();}
            },30);
        },
        softspin(){
            var vm=this;
            if(this.images && this.images.length > 0){

                vm.softspininterval = setInterval(function(){
                   
                    if(vm.images[vm.current+1]){
                        vm.current++
                    }
                    else{
                        vm.current=0;
                    }
                },200);

                vm.handmoveinterval = setInterval(function(){
                     if(vm.handmovemargin < 90){
                        vm.handmovemargin++;
                    }
                    else {vm.handmovemargin=0;}
                },30);
            }
        },
        stop(){
             this.touched=true;
            clearInterval(this.interval);
            clearInterval(this.handmoveinterval);
        },
        preloadImages(){
            if (this.images)
            {
             
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
        },
        touched(){
            if (this.touched){
               

                
               clearInterval(this.softspininterval);
               clearInterval(this.interval);
               
               clearInterval(this.handmoveinterval);
            }
        }
    },
    computed:{
        handmove(){
            return `margin-left:${this.handmovemargin}%;` ;
        }
    }
    

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
        top:40%;
        width:80%;
        margin-left: 10%;
        display: flex;
        
        justify-content: flex-start;   
      
        background-color: #0FE0E8cc;
        
        border-radius: 10%;
        color:#fff;
        padding:5px;

    }

    .img-container{
        overflow: hidden;
    }

    .bigicon{font-size:3rem}

    .arrows{
        position:absolute;
        top:25%;
        width:100%;
        display: flex;
        justify-content: space-around;
        font-size: 2rem;
        padding:5px;
    }

    .slidetext{
         position:absolute;
        bottom:-100%;
        width:50%;
        margin-left: 25%;
        display: flex;
        justify-content: space-around;
        font-size: 2rem;
         background-color: #0FE0E8cc;
         border-radius: 10%;
       
    }
</style>