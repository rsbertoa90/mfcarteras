<template>
    <div v-if="list && list.length > 0" class="mt-5 kalam">
        <h5>Pedido actual:</h5>
        <table class="table table-striped">
            <thead>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Unidades</th>
                <th>Subtotal</th>
                <th>-</th>
            </thead>
            <tbody>
                <tr v-for="variant in list" :key="variant.id">
                    <td> {{variant.code}} </td>
                    <td> {{variant.product.name}} - {{variant.name}} </td>
                    <td>  <input type="number" class="form-control" style="width:100px" 
                                v-model.lazy="variant.units" > </td>
                    <td > ${{ variant.product.price * variant.units | price }} </td>
                    <td> <button class="btn btn-sm btn-outline-danger" @click="del(variant)">
                            <span class="fa fa-times"></span> 
                         </button> 
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props:['list'],
    methods:{
        del(variant)
        {
            variant.units = 0;
          
        }
    }
}
</script>

<style scoped>

 .table,.accordion,.tr,.td,.kalam,.card{
    font-family:  'Kalam', cursive;
}


    .table{
        font-size:0.8rem;
    }
</style>
