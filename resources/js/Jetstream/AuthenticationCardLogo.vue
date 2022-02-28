<template>
    <Link :href="'/'">
        <img src="imgs/logo.png" width="150" height="100">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
