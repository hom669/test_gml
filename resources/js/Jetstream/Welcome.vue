<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
               Bienvenido a la Aplicacion Para Administrar Usuarios GML!
            </div>

            <div class="mt-6 text-gray-500">
               Esta es la aplicación desarrollada para la prueba técnica para el puesto de desarrollo el modulo desarrollado se encuentra en el menu principal Administrar Usuarios
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

    export default defineComponent({
        components: {
            JetApplicationLogo,
        },
    })
</script>
