<template>
  <div>
     
         <form ref="form" @submit.prevent="save" class="form form-inline row ml-1">
               <div class="col-3 row">
                 <label for="" class="col-12">Codigo</label>
                 <input required v-model.trim="formData.code" type="text" class="col-12">
             </div>
             
        
             <div class="col-3 row">
                 <label for="" class="col-12">Producto</label>
                 <textarea  rows="2" required  v-model.trim="formData.name" type="text" class="col-12"> </textarea>
             </div>
          
             <div  class="col-3 row">
                 <label for="" class="col-12">Precio</label>
                 <input min='0' step=".01" required v-model.trim="formData.price"  type="number" class="col-12">
             </div>
             <button type="submit" class="btn btn-outline-success align-self-end justify-self-end"> GUARDAR </button>
         </form>
    </div>
</template>

<script>
    export default {
   
        data(){
            return {
            
        
                formData: {

                    price :null,
                    pck_price :null,
                    pck_units :null,           
                    name : null,
                    code :null
                }
            }
        },
        computed:{
            products() {
                return this.$store.getters.getProducts;
            }
        },
        methods : 
        {
            valid(){
            

                
                    var vm = this;
                    var duplicated = null;
                    
                    duplicated =    this.products.find(p => {
                            return p.code == vm.formData.code;
                        });
                        
                

                    if (duplicated){
                        swal('error','ya existe un producto con el codigo'+vm.formData.code,'error');
                    } 
                    else {return true;}
                
            },
            resetForm(){
                this.formData =  {
                    price :null,
                    
                    name : null,
                    code :null
                }
            },
            save()
            {
                var vm = this;
                if (this.valid()){

                        
                    vm.$http.post('/admin/product/',vm.formData)
                        .then(response => {
                            vm.$emit('productSaved',response.data);
                        //   console.log(response.data);
                            swal('Product guardado','','success');
                            vm.resetForm();
                                        
                        });
                            
                                
                
                }
            },
       
        }
    }
</script>