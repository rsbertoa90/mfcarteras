<template>
    <div v-if="images && images.length > 0">
        <div class="p-3">
            <img :src="images[current].url">
        </div>
    </div>
</template>

<script>
export default {
    props:['variant_id'],
    data(){
        return{
            images:null,
            current:null,
            interval:null,
            direction:'left'

        }
    },
    created(){
        this.$http.get('/api/model/'+this.variant_id)
            .then(res => {
                this.images = res.data;
           
                if (res.data){
                    this.current = 0;
                    this.preloadImages();
                    this.move();
                }
            });
    },
    methods:{
        move(){
            
            var vm =this;
            if(this.images){
                
                setInterval(function(){

                        if (! vm.images[vm.current+1]){
                                vm.current = -1;
                        }
                        vm.current++;
                },120);


            }
        },
     
       
        preloadImages(){
            if (this.images)
            {
                this.images.forEach(img => {
                    let element  = new Image();
                    element.src = img.url;
                });
            }
        }
    }

}
</script>
