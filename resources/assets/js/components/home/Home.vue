<template>
    <div>
            <home-banner></home-banner>
            <br>
            <br>
           <home-products></home-products>

    </div>
</template>

<script>
import homeBanner from './banner.vue'
import homeInfo from './info.vue'
import homeOffers from './offers.vue'
import homeProducts from './products.vue'
export default {
    components: {
        homeBanner,
        homeProducts,
        
        
    }
}
</script>
