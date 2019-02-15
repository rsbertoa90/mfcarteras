<template v-if="variant">
    <div class="modal fade" ref="modal" id="image-modal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
    <div  v-if="variant" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">  {{variant.product.name}} - {{variant.name}} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form enctype="multipart/form-data" name="uploader" >
           <b-carousel  
                        :controls="variant.images.length > 1"
                        id="carousel"
                        background="#ababab"
                        :interval="4000"
                        img-width="600"
                        >
                  
                  <b-carousel-slide v-if="variant.images.length > 0" v-for="img in variant.images" :key="img.id"
                                     :img-src="img.url">
                        <button class="btn btn-sm btn-danger"
                                @click.prevent="deleteImage(img)">X</button>
                  </b-carousel-slide>
                  <b-carousel-slide v-else
                                    img-src="/storage/images/app/no-image.png">
                        <button class="btn btn-sm btn-danger"
                                @click.prevent="deleteImage(img)">X</button>
                  </b-carousel-slide>


           </b-carousel>


            <div class="d-flex flex-column mt-3">
                <label class="text-info font-weight-bold">Nueva Imagen </label>
                <input @change="chargedImage = true"  type="file" name="file"  accept="image/x-png,image/gif,image/jpeg">
            </div>   
           
          </form>
       
      </div>
      <div class="modal-footer">
        <button v-if="chargedImage" type="button" class="btn btn-primary" @click="save">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    <app-model-gallery :variant_id="variant.id"></app-model-gallery>
    <app-model-upload @close="close()" v-if="variant" :variant_id="variant.id"></app-model-upload>
    </div>
  </div>
</div>
</template>

<script>
import appModelGallery from '../modelImage/model.vue';
import appModelUpload from '../modelImage/upload.vue';
    export default {
        components:{'app-model-gallery':appModelGallery,
                    'app-model-upload':appModelUpload},
        props: ['variant'],
        data: function(){
            return {
               file : null,
               chargedImage:false
            }
        },
        
        
        methods : {
            close(){
                window.location.replace('/admin');
            },
            deleteImage(image){
                this.$http.delete('/admin/variant/image/'+image.id)
                    .then(()=>{
                        this.$emit('refresh')
                         $('#image-modal').modal('hide');
                        });
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
                    fdata.append('variant_id',this.variant.id)
                    // console.log(fdata);
                    
    
                    $.ajax({
                        url: "/admin/variant/image",
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
