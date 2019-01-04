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
         
             <img v-if="product.image" :src="product.image" :alt="product.name">

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
               chargedImage:false
            }
        },
        
        
        methods : {
            
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
                    fdata.append('product_id',this.product.id)
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
