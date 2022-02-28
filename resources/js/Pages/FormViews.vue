<template>
    <app-layout>
        <template #header>
        <h1 class=" sm:rounded-lg bg-sky-400 text-4xl text-white text-center shadow-lg shadow-sky-300 md:shadow-xl md:shadow-sky-200">Listado de Productos</h1>
        </template>
        <div class="py-8">
            <div class="max-w-8x1 mx-auto sm:px-6 lg:px-6">
                <div class="shadow-xl sm:rounded-lg" >
                   <Link :href="route('products.create')" class="py-2 px-4 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                        Nuevo
                    </Link>
                    
                </div>
            </div>
        </div>
    
    </app-layout>
</template>


<script>
import AppLayout from "@/Layouts/AppLayout";
import { Head, Link } from '@inertiajs/inertia-vue3'
import InertiaTable from 'inertia-table'

export default {
    props: {
        products: Array,
        filters: Object,
        order: Object,
    },
    data() {
        return {
        columns: ["description", "price"],
        }
    },
    components: {AppLayout,Head,Link,InertiaTable},
};
</script>
