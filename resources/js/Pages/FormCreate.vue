<template>
<app-layout>
    <div class="font-sans">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    Crear Producto
                </label>
                <form @submit.prevent="submit" class="mt-10">
                                    
                    <div>
                        <input v-model="form.description" type="text" placeholder="Nombre Producto" id="description" name="description" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>
        
                    <div class="mt-7">                
                        <input v-model="form.price" type="number" placeholder="Precio Producto"  id="price" name="price" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">                           
                    </div>

                   
                    
        
                    <div class="mt-7">
                        <button type="submit" class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Guardar
                        </button>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
</div>
  </app-layout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

export default {
  components: { AppLayout,Head,Link },
  props:{
      errors: Object
  },
  data(){
      return{
          form:{
              description:null,
              price:null
          }
      }
  },
  methods:{
      submit(){
          console.log("Enviooo");
          this.$inertia.post('/products',this.form);
      }
  }
}
</script>