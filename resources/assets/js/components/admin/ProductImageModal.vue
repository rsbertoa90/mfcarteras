<template>
    <div class="modal fade" id="image-modal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
    <div  v-if="product" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">  {{product.name}} - {{product.name}} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form enctype="multipart/form-data" name="uploader" >
          <h4> {{selectedImage}} </h4>
            <div class="img-container">
                <img v-if="image" :src="image" :alt="product.name">
                <img v-else src="/storage/images/app/no-image.png" alt="">
                <div class="controls">
                    <span @click="changeImage()"  class="fa fa-chevron-left"></span>
                    <span  @click="changeImage()" class="fa fa-chevron-right"></span>
                </div>
            </div>

            <div class="d-flex flex-column mt-3">
                <label class="text-info font-weight-bold">Cambiar Imagen </label>
                <input @change="chargedImage = true" type="file" name="file"  accept="image/x-png,image/gif,image/jpeg">
            </div>   
           
          </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="save" v-if="chargedImage">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  
</div>
</template>

<script>
    export default {
        props: ['product'],
        data: function(){
            return {
               file : null,
               chargedImage:false,
               image:null,
               selectedImage:'frente'
            }
        },
        
        watch:{
            product(){
                if (this.product && this.product.image){
                    this.image = this.product.image;
                    this.selectedImage='frente';
                }
            },
        },
        methods : {
            changeImage()
            {
                if (this.image == this.product.image){
                    this.image = this.product.side_image;
                    this.selectedImage = 'costado';
                }else{
                    this.image = this.product.image;
                    this.selectedImage='frente';
                }
            },
            
            save :  function(event){
                var vm =this;
                var file = $('input[type="file"]')[0].files[0];
                if (file == null){
                    swal('No se ha seleccionado una imagen','','error');
                } else {

                    this.file = file;
                    // console.log(file);
                    
                    
                    var fdata =  new FormData();
                    fdata.append('image',file);
                    fdata.append('product_id',this.product.id);
                    fdata.append('selected',this.selectedImage);
                    // console.log(fdata);
                    
    
                    $.ajax({
                        url: "/admin/product/image",
                        type: "post",
                        data: fdata,
                        // async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        files : true,
                        success: function () {
                           $('#image-modal').modal('hide');
                           window.location.replace('/admin');
                        },
                    });
                }

        
        },
            
        
    }
}
</script>

<style lang="scss" scoped>
    .image-container{
        position: relative;
    }

    .controls{
        position:absolute;
        top:30%;
        width:90%;
        display: flex;
        justify-content: space-between;
        .fa{
            font-size:1.5rem;
            color:blue;
            background-color:pink;
            cursor: pointer;
            padding: 5px;
        }
    }
</style>
