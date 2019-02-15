<template>
    <div  v-if="images && images.length > 0">
      <v-touch  @panleft="panleft" @panright="panright" class="relative" >
          <div id="container">
            <img id="image" :src="images[0].url" >
          </div>
          <div v-if="$mq=='lg'" class="controls">
              <div class="p-1 bg-secondary text-info" @mousedown="spin('left')" @mouseup="stop"> <span class="fa fa-chevron-left"/> </div>
              <div class="p-1 bg-secondary text-info" @mousedown="spin('right')" @mouseup="stop"> <span class="fa fa-chevron-right"></span> </div>
          </div>
      </v-touch>
    </div>
</template>

<script>
export default {
    props:['variant_id'],
    data(){
        return{
            pressing:false,
            images:null,
            imgarray:[],
            current:null,
            interval:null,
            direction:'left',
            mousex:0,
            ralentizer:0
         

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
                    element.id="image";
                    this.imgarray.push(element);
                });
            }
        },
        
    },
    watch:{
        current(){
            let cont = document.getElementById("container");
            cont.removeChild(cont.childNodes[0]);
            cont.appendChild(this.imgarray[this.current]);
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
    }
</style>