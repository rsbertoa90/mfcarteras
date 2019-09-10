<template>
    <div>
        <div class="row">
            
            <div class="col-12 row mt-2">
                   <div class="col-6 col-lg-3 m-0 p-0">
                    <button @click="changestatus('pendiente')" 
                        class="btn btn-block "
                        :class="{'btn-outline-warning':status != 'pendiente',
                                'btn-warning' : status == 'pendiente'}">
                        <span class="far fa-clock"></span>
                        Pendientes
                    </button>
                </div>
                 <div class="col-6 col-lg-3 m-0 p-0">
                    <button @click="changestatus('pagado')" 
                        class="btn btn-block"
                        :class="{'btn-outline-success':status != 'pagado',
                                'btn-success' : status == 'pagado'}">
                        <span class="fa fa-dollar-sign"></span>
                        Pagadas
                    </button>
                </div>
                 <div class="col-6 col-lg-3 m-0 p-0">
                    <button @click="changestatus('enviado')" 
                        class="btn btn-block"
                        :class="{'btn-outline-info':status != 'enviado',
                                'btn-info' : status == 'enviado'}">
                        <span class="fa fa-truck"></span>
                        Enviadas
                    </button>
                </div>
                <div class="col-6 col-lg-3 m-0 p-0">
                    <button @click="changestatus('cancelado')" 
                        class="btn btn-block"
                        :class="{'btn-outline-danger':status != 'cancelado',
                                'btn-danger' : status == 'cancelado'}">
                      <span class="fa fa-times"></span>
                       Canceladas
                    </button>
                </div>
               
            </div>
        </div>
        <div class="col-12 row">
            <div class="col-12 col-lg-4">
                <table class="table table-striped table-hover"> 
                    <thead>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th> - </th>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="text" v-model="searchTerm" class="form-control">
                        </tr>
                        <tr  v-for="order in filteredOrders" 
                                :key="'order'+order.id"
                                @click ="selected = order"
                                style="cursor:pointer"
                                :class="{'bg-info' : order == selected}">
                            <td>{{order.created_at | datetime}}</td>
                            <td>{{order.client}}</td>
                            <td> <input type="checkbox" @click="toggleviewed(order)"  v-model.lazy="order.viewed" class="form-control checkbox"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-8 bg-white">
                <app-order @statusChanged="statusChanged" 
                        v-if="selected" :order="selected">
                </app-order>
            </div>
        </div>


    </div>
</template>

<script>
import appOrder from './order.vue';
export default {
    components: {
        appOrder
    },
    data(){
        return {
            searchTerm:'',
            orders : [],
            status : 'pendiente',
            filtered : [],
            selected : null,

        }
    },
    methods : {
        toggleviewed(order){
            let data = {
                field: 'viewed',
                value : order.viewed ? 1 : 0 ,
                id: order.id
            }
            this.$http.put('/admin/order',data);
        },
        statusChanged(event){
            this.status = event.status;
        },
        changestatus(status)
        {
            this.status = status;
            this.selected = null;
        }
    },
   
    computed : {
        filteredOrders(){
            var vm = this;
            let res = this.orders.filter(order => {
              
                return (order.status == vm.status);
            });
            
            if ( vm.searchTerm.trim().length > 2 )
            {
                res = res.filter(order => {
                    let searchTerm = vm.searchTerm.trim().toLowerCase();
                    let client = order.client.trim().toLowerCase();
                    let  email = order.email.trim().toLowerCase();
                    return (client.indexOf(searchTerm) > -1
                            || email.indexOf(searchTerm) > -1);
                });
            }

            res = _.sortBy(res,'created_at');
            res = res.reverse();


            return res;
        }
    },
    created(){
        this.$http.get('/admin/getOrders')
            .then(response => {this.orders = response.data });
        
    },
    filters : {
        datetime(val){
            return moment(val).format('DD/MM/YYYY H:mm')
        }
    }
    
}
</script>

<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .checkbox{
        width:30px;
        height: 30px;
    }
   
</style>
