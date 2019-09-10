<template>
    <div>
          
            <br>
            <home-title></home-title>
            <!-- <br>
            <home-info></home-info> -->
            <br>
           <home-products></home-products>

    </div>
</template>

<script>

import homeInfo from './info.vue'
import homeProducts from './products.vue'
import homeTitle from './title.vue'
export default {
    components: {
        homeInfo,
        homeProducts,
        homeTitle
        
        
    }
}
</script>
