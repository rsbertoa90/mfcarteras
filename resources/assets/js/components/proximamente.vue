<template>
<div>
    <div :class="{'mobile':$mq != 'lg',
                'web':$mq == 'lg'}">
        <img v-if="$mq == 'lg'" src="/storage/images/app/proximamente-web.png" alt="proximanente">
        <img v-else src="/storage/images/app/proximamente-mobile.png" alt="proximanente">
    </div>

    

    <div>
        <upnexxPreview></upnexxPreview>
    </div>
</div>
</template>

<script>
import upnexxPreview from './upnext/preview.vue';
export default {
    components:{upnexxPreview}
}
</script>


<style scoped lang="scss">
    .mobile{
        width: 100vw;
    }

    .web{
        width:90vw;
        margin-left: 5vw;
    }
</style>