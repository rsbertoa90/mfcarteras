



const state = {
    products : []
};


const getters = {
     getProducts(state) {
        return state.products;
    },
    getProduct: (state) => (id)=> {
        if(state.products.length > 0){
            return state.products.find( cat => {
                return cat.id == id;
            });
        }
    },
    getProducts(state) {
        let prods = [];
        if (state.products.length > 0){
            state.products.forEach(product => {
                prods.concat(product.products);
            });
        }
        return prods;
    },
    getProduct: (state) => (id) => {
        var res  = null;
        if (state.products.length > 0) {
            state.products.forEach(cat => {
             
                var prod = cat.products.find(p => {
                    return p.id == id
                });
                if (prod){
                
                    res = prod;
                    
                } 
            });
            return res;
      
        }
    },
    getOffers(state){
        let prods = [];
        if (state.products.length > 0) {
            state.products.forEach(product => {
                product.products.forEach(product => {
                   
                    if (product.offer) {
                        prods.push(product);
                    }
                });
            });
        }
       
        return prods;
    },
    
};

const mutations = 
{
    update : (state, payload) => {
        state.products = payload;
    },
    save : (state,product) => {
        state.products.push(product);
    },
    delete(state,product)
    {
        for (const key in state.products) {
            if (state.products.hasOwnProperty(key)) {
                const element = state.products[key];
                if (element === product)
                {
                    state.products.splice(key,1);
                }
            }
        }
    }
};

const actions = {
    fetch : ({
        commit
    }, payload) => {
        
        Vue.http.get('/api/products')
            .then(response => {
                commit('update',response.data);
            });
    },

};

export default {
    namespaced : true,
    state,
    mutations,
    actions,
    getters
}