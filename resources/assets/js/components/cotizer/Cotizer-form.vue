<template>
    <div class="kalam" v-if="user">
        
         <div v-if="loading" class="loader">
            <fade-loader :loading="loading" size="200px"></fade-loader>
        </div>


        <h5>Envianos tu pedido</h5>
        <p>Recibiras confirmacion de tu presupuesto por email</p>
        <form id="form" class="col-12">
        <!-- Retiro en local -->
              <div class="col-12 row form-group-row mb-3">
                  <div class="col-12 col-lg-4">
                    <input  type="radio"
                           v-model="formData.shipping" :value="false"> 
                     <span @click="formData.shipping=false"  class="text-secondary radioText" :class="{'text-success':!formData.shipping}">
                        <span class="fa fa-building"></span> Retiro en el local
                     </span>
                  </div>
              </div>
              <div class="col-12 row form-group-row mb-3">
                  <div class="col-12 col-lg-4">
                    <input  type="radio"
                           v-model="formData.shipping" :value="true"> 
                    <span  @click="formData.shipping=true" class="text-secondary radioText" :class="{'text-success':formData.shipping}">
                        <span class="fa fa-truck"></span> Envio por transporte
                    </span>
                  </div>
               </div> 
       <!--  -->        

       <span v-if="!formData.shipping" class="warn">*Los retiros presenciales son en Pasteur 410 - CABA </span>
       <br>
       <span class="warn">*Los precios no incluyen IVA</span>
        <div v-if="user.role_id > 2" class="col-12 row form-group-row mb-3">
                    <span class=" warn" v-if="!formData.shipping">*El minimo de compra es de ${{minBuy}} </span>
                    <span class=" warn" v-else>*El minimo de compra para envíos es de ${{minBuy}} </span>
                    
        </div> 

             
             
               <div class="col-12 row form-group-row">
                   <label class="col-4 col-lg-4" for="">Nombre y Apellido <span v-if="user.role_id < 3"> (cliente) </span> </label>
                   <input required type="text" v-model="formData.client"  class="form-control col-8 col-lg-4">
                </div> 
                 <div v-if="user.role_id < 3" class="col-12 row form-group-row">
                   <label class="col-4 col-lg-4" for="">Nombre del vendedor</label>
                   <input required type="text" v-model="formData.seller"  class="form-control col-8 col-lg-4">
                </div> 
               
                <!-- DATOS DE ENVIO -->
                <div v-if="formData.shipping">
                    
                    <div class="col-12 row form-group-row">
                        <label class="col-4 col-lg-4" for=""> Provincia </label>
                        <select v-if="states.length > 0" v-model="state" class="form-control col-8 col-lg-4">
                            <option v-for="opt in states" :key="opt.id" :value="opt"> 
                                {{opt.name}}
                            </option>
                        </select>
                    </div>
                    <div class="col-12 row form-group-row">
                        <label class="col-4 col-lg-4" for=""> Ciudad </label>
                        <select v-if="state" v-model="formData.city_id" class="form-control col-8 col-lg-4">
                            <option v-for="opt in state.cities" :key="opt.id" :value="opt.id"> 
                                {{opt.name}}
                            </option>
                        </select>
                    </div>
                    <div class="col-12 row form-group-row">
                        <label class="col-4 col-lg-4" for=""> Direccion </label>
                        <input  type="text" v-model="formData.address"  class="form-control col-8 col-lg-4">
                    </div>
                    <div class="col-12 row form-group-row">
                        <label class="col-4 col-lg-4" for=""> Transporte </label>
                        <input  type="text" v-model="formData.transport"  class="form-control col-8 col-lg-4">
                    </div>
                    <div class="col-12 row form-group-row">
                        <label class="col-4 col-lg-4" for=""> Codigo Postal </label>
                        <input  type="text" v-model="formData.cp"  class="form-control col-8 col-lg-4">
                    </div>
                </div>
                <!-- /DATOS DE ENVIO -->
              
               <div class="col-12 row form-group-row">
                   <label class="col-4 col-lg-4" for="">Email</label>
                   <input :required="user.role_id > 2" type="email" v-model="formData.email"  class="form-control col-8 col-lg-4">
                </div> 
               <div class="col-12 row form-group-row">
                   <label class="col-4 col-lg-4" for="">Telefono</label>
                   <input v-model="formData.phone" type="text" class="form-control col-8 col-lg-4">
                </div> 
               <div class="col-12 row form-group-row">
                   <label class="col-4 col-lg-4" for="">Mensaje</label>
                   <textarea v-model="formData.message" name="message" class="form-control col-8 col-lg-4"></textarea>
                </div> 

           
               
                <button class="button btn-lg btn-outline-success offset-2 mt-2" 
                        @click.prevent.stop="send">
                        Enviar
                </button>
        </form>
    </div>
</template>

<script>
export default{
    props : {
        list : {default : []},
        total : {default : 0}
    },

    data(){return{
        state:null,
        loading:false,
        formData : {
            shipping:true,
            cp:'',
            address:'',
            transport:'',
            city_id:null,
            message : '',
            phone : '',
            email : '',
            client:'',
            seller:''
        },
    
       
    }},
    computed : {
        config(){
            return this.$store.getters.getConfig;
        },
        minBuy(){
          if(this.config){
              if (this.formData.shipping){
                  return this.config.minbuy_ship;
              }else {return this.config.minbuy;}
          }
        
        },
        user(){
            return this.$store.getters.getUser;
        },
        states(){
            return this.$store.getters.getStates;
        }
    },
    
    methods : {
        formValid()
        {
            if(!this.formData.client || this.formData.client.trim() == '')
            {
                 swal('El campo "Nombre y Apellido" es obligatorio ','','error');
                 return false; 
            }
            else if (this.formData.email.length < 4 && this.user.role_id > 2)
            {
                swal('Hay algo mal con el mail','','error');
                return false;
            }else if (this.list.length <= 0) 
            {   
                swal('No hay productos seleccionados','','error');
                return false;
            } else if (this.total < this.minBuy)
            {
                swal('El minimo de compra es de $'+this.minBuy,'','error');
                return false;
            } else {return true;}
        },
        send(){
            if (this.formValid()){

                var data = this.formData;
                data.list = JSON.stringify(this.list);
                data.total = this.total;
                if (data.shipping){
                    data.shipping = 1;
                } else {data.shipping = 0;}
                
                var vm = this;
                vm.loading=true;
                $.ajax({
                    method : 'post',
                    data : data,
                    url : '/cotizer/send',
                    success(r){
                      /*   console.log(r); */
                        if(vm.user.role_id > 2){
                            swal('Enviamos tu presupuesto', 'Te estaremos contactando a la brevedad','success')
                                .then(confirm => {window.location.replace('/')});
                        }
                        else{
                            swal('Orden guardada', 'Revisa el panel de administracion de ordenes','success')
                                .then(confirm =>{window.location.replace('/admin/cotizador')});
                        }
                    } 
                });
            }
        }
    }
}

</script>

<style scoped lang="scss">

   .kalam {

        font-family:  'Kalam', cursive;
    }

.loader {
    position : fixed;
    height: 100%;
    width: 100%;
    z-index: 110;
    background-color: #ddddddaa;
    left: 0;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: start;
    padding-top: 5%;
}

    .warn{
        font-size: 0.9rem;
        color: red;
        font-style: italic;
    }
</style>