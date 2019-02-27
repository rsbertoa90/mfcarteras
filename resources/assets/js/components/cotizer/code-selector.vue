<template>
    <div class="row w-100 mt-3">
        <div class="col-12 col-lg-2">
           
            <input type="text" placeholder="Codigo" 
                  v-model="newitemcode" class="form-control">
        </div>
        <div class="col-12 col-lg-3 d-flex"  v-if="selected">
            
            <span> {{selected.name}} <span v-if="selectedvariant"> {{selectedvariant.name}} </span> </span>

             
             <div class="variants-clicker d-flex ml-2">
                <span v-for="variant in selected.variants" :key="variant.id" 
                    class="square" :class="{'selected' : variant.id == selectedvariant.id}"
                    :style="{backgroundColor:variant.color_code}"
                    @click="selectedvariant = variant" ></span>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 d-flex" v-if="selected">
            <button class="btn bnt-sm btn-info" @click="qty--"> - </button>
            <input type="number" v-model="qty" style="width:90px" class="form-control" min=0>
            <button class="btn bnt-sm btn-info" @click="qty++"> + </button>

            <button class="btn btn-sm ml-3 btn-success" @click="add">Agregar</button>
        </div>


        
       
    </div>
</template>

<script>
export default {
    props:['list','products'],
    data(){
        return{
            newitemcode:'',
            selectedvariant:null,
            qty:1,
        }
    },
    computed:{
        selected(){
            let res =  this.products.find(prod => {
                return prod.code.trim() == this.newitemcode.trim();
            });

            if (res){
                this.selectedvariant = res.variants[0];
                return res;
            }

        }
    },
    methods:{
        add(){
           this.selectedvariant.units = this.qty;
           this.list.push(this.selectedvariant);

           this.qty=1;

           this.newitemcode = '';
        }
    }
   
}
</script>

<style lang="scss" scoped>
.square{
    display: flex;
    width: 20px;
    height: 20px;
    margin:5px;
    padding:5px;
    border: 1px solid #ccc;
    cursor: pointer;
}

.variants-clicker{
   display: flex;
   align-items:flex-start;
}

.selected{
    transform: scale(1.5);
    border: 2px solid blue;
}
</style>
