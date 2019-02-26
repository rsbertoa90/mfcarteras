import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state : {
        user : null,
        config : null,
        states:[],
        products:[],
        productsnotpaused:[],
        
        
    },
    getters :{
        getProducts(store){
            return store.products;
        },
        getProductsnotpaused(store){
            return store.productsnotpaused;
        },

       
        getUser(store){
            return store.user;
        },
        getConfig(store){
            return store.config;
        },
        getStates(store){
            return store.states;
        },
        getCity: store => id => {
            if (store.states){
            
                store.states.forEach(state => {
                    let cit = state.cities.find(city => {
                        return city.id == id;
                    });
                    if (cit){
                        return cit;
                    }
                })  ;
            }
        }
    },
    mutations : {

        setProducts(state,payload){
            state.products = payload;
        },
        setProductsnotpaused(state,payload){
            state.productsnotpaused = payload;
        },
        setUser(state,payload){
            state.user = payload;
           
        },
        setConfig(state,payload){
            state.config = payload;
        },
        setStates(state,payload){
            state.states = payload;
        },
       
    },
    actions : {
        fetchProducts : ({commit},payload) => {
            Vue.http.get('/api/products')
                .then(res => {
                    commit('setProducts',res.data);
                });
        },  
        fetchProductsnotpaused : ({commit},payload) => {
            Vue.http.get('/api/products-not-paused')
                .then(res => {
                    commit('setProductsnotpaused',res.data);
                });
        },  
       fetchUser: ({
           commit
       }, payload) => {

           Vue.http.get('/getUser')
               .then(response => {
                   commit('setUser', response.data);
                  
               });
       },
       fetchConfig: ({
           commit
       }, payload) => {

           Vue.http.get('/config')
               .then(response => {
                   commit('setConfig', response.data);
               });
       },
       fetchStates: ({
           commit
       }, payload) => {
           Vue.http.get('/api/states')
               .then(response => {
                   commit('setStates', response.data);
               });
       },
      
    },
 
});

