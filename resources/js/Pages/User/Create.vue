<template>
    <form class="form" @submit.prevent="checkForm" action="/usersgml" method="post">
        <div class="font-sans">
            <div class="flex flex-col sm:justify-center items-center bg-white">
                <div class="relative sm:max-w-sm w-full">
                    <div
                        class="card bg-blue-400 shadow-lg w-full h-full rounded-3xl absolute transform -rotate-6"
                    ></div>
                    <div
                        class="card bg-red-400 shadow-lg w-full h-full rounded-3xl absolute transform rotate-6"
                    ></div>
                    <div
                        class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md"
                    >
                        <div>
                            <div v-if="submitted === true">
                                <div v-if="hasErrors" class="bg-red-300 border-red-500">
                                    <strong
                                        >Se han producido los siguientes
                                        errores:</strong
                                    >
                                    <ul>
                                        <li
                                            v-for="error in errors"
                                            :key="error"
                                        >
                                            {{ error }}
                                        </li>
                                    </ul>
                                </div>
                                <div v-else class="bg-green-300 border-green-500">
                                    <strong>Usuario Creado Correctamente!</strong>
                                </div>
                            </div>
                            <div v-else class="nocompleto">
                                <strong>Completa este formulario</strong>
                            </div>
                        </div>

                        <div>
                            <input
                                v-model="form.name_user"
                                type="text"
                                placeholder="Nombre Usuario"
                                id="name_user"
                                name="name_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>

                        <div>
                            <input
                                v-model="form.surname_user"
                                type="text"
                                placeholder="Apellido Usuario"
                                id="surname_user"
                                name="surname_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>
                        <div>
                            <input
                                v-model="form.email_user"
                                type="text"
                                placeholder="Email Usuario"
                                id="email_user"
                                name="email_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>
                        <div>
                            <input
                                v-model="form.identification_user"
                                type="text"
                                placeholder="Identificación Usuario"
                                id="identification_user"
                                name="identification_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>

                        <div>
                            <input
                                v-model="form.address_user"
                                type="text"
                                placeholder="Dirección Usuario"
                                id="address_user"
                                name="address_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>

                        <div>
                            <input
                                v-model="form.movil_user"
                                type="text"
                                placeholder="Celular Usuario"
                                id="movil_user"
                                name="movil_user"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                            />
                        </div>
                        <div>
                            <select
                              v-model="form.country_user"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            >
                                <option value="">Seleccione un País</option>
                                <option
                                    v-for="country in data_countries"
                                    :key="country.text"
                                    :value="country.text"
                                >
                                    {{ country.text }}
                                </option>
                            </select>
                        </div>

                        <div>
                            <select
                            v-model="form.id_category"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            >
                                <option value="">
                                    Seleccione una Categoria
                                </option>
                                <option
                                    v-for="category in data_categories"
                                    :key="category.id_category"
                                    :value="category.id_category"
                                >
                                    {{ category.name_category }}
                                </option>
                            </select>
                        </div>
                        <div
                            class="oj-flex oj-sm-flex-items-initial oj-sm-justify-content-center"
                        >
                            <div
                                class="oj-flex-item oj-sm-padding-2x-horizontal"
                            >
                                <jet-button
                                    class="bg-green-400 mt-7"
                                    @click="createUser = false"
                                >
                                    Agregar
                                </jet-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import { ModelListSelect } from "vue-search-select";
export default {
    components: { AppLayout, Head, Link, ModelListSelect, JetButton },
    props: {
        countries: Array,
        categories: Array,
        emails: Array,
        identifications: Array
    },
    async created() {
        console.log("Iniciando");
    },
    data() {
        return {
            errors: [],
            submitted: false,
            form: {
                name_user: null,
                surname_user: null,
                identification_user: null,
                email_user: null,
                country_user: "",
                address_user: null,
                movil_user: null,
                id_category: "",
            },
            data_countries: this.$props.countries,
            data_categories: this.$props.categories,
        };
    },
    computed: {
        hasErrors: function () {
            return this.errors.length; // Devuelve true en el caso de contener                                       algún error
        },
    },
    methods: {
        async init() {
            console.log("AQUII");
        },
        enviar() {
          console.log(this.form);
            this.$inertia.post("/usersgml", this.form);
            this.clean();
        },
        clean() {
          this.form.name_user= null;
          this.form.surname_user= null;
          this.form.identification_user= null;
          this.form.email_user= null;
          this.form.address_user= null;
          this.form.movil_user= null;
          this.form.id_category= "";
          this.form.country_user= "";
        },
        checkForm: function (e) {

            this.submitted = true;
            this.errors = [];

            if (this.form.name_user && this.form.surname_user && this.form.identification_user && this.form.email_user && this.form.country_user && this.form.id_category) {
                this.errors = [];

              
              let identifications = this.$props.identifications;
              let emails = this.$props.emails;
              console.log(emails);
              if(identifications.length > 0){

                const identification_find = this.form.identification_user;  
                var error_identification = "";
                var foundIdentification = identifications.map(function(identification){
                    if(identification.identification_user === identification_find){
                      error_identification = "La Identificación Ya existe registrada en el Sistema";
                    }
                });

                if(error_identification){
                  this.errors.push(error_identification);
                }
              }

              if(emails.length > 0){
                const email_find = this.form.email_user;  
                var error_mail = "";
                var foundMail = emails.map(function(email){
                    if(email.email_user === email_find){
                      error_mail = "El Email Ya existe registrada en el Sistema";
                    }
                });

                if(error_mail){
                  this.errors.push(error_mail);
                }
              }
                
              const esCorreoElectronico = esCorreoElectronico  => /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(esCorreoElectronico);

              const patternLetters = new RegExp('^[A-ZñÑ ]+$', 'i');

              const patternNumbers = new RegExp('^[0-9]+$', 'i');

              if(!patternLetters.test(this.form.name_user)){ 
                this.errors.push("El Nombre de Usuario solo debe contener letras");
              }

              if(!patternLetters.test(this.form.surname_user)){ 
                this.errors.push("El Apellido de Usuario solo debe contener letras");
              }

              if(this.form.movil_user){
                if(!patternNumbers.test(this.form.movil_user)){ 
                  this.errors.push("El Telefono de Usuario solo debe contener Números");
                }
              }
              

               if(!esCorreoElectronico(this.form.email_user)){
                 this.errors.push("El Email no tiene la estructura Correcta");
               }


                if(this.form.name_user.length < 5){
                  this.errors.push("El Nombre del Usuario debe por lo menos tener 5 Caracteres");
                }
                if(this.form.name_user.length > 100){
                  this.errors.push("El Nombre del Usuario no debe tener mas de 100 Caracteres");
                }
                if(this.form.surname_user.length > 100){
                  this.errors.push("El Apellido del Usuario no debe tener mas de 100 Caracteres");
                }
                if(this.form.email_user.length > 150){
                  this.errors.push("El Email del Usuario no debe tener mas de 150 Caracteres");
                }

                if(this.form.address_user.length > 180){
                  this.errors.push("La Dirección del Usuario no debe tener mas de 180 Caracteres");
                }

                if(this.form.movil_user.length !== 10){
                  this.errors.push("El Celular del Usuario debe tener 10 Caracteres");
                }

                this.submitted = true;

            }

            if (!this.form.name_user) {
                this.errors.push("El nombre del usuario es obligatorio.");
            }
            if (!this.form.surname_user) {
                this.errors.push("El Apellido del usuario es obligatoria.");
            }
            if (!this.form.identification_user) {
                this.errors.push("La Identificación del usuario es obligatoria.");
            }
            if (!this.form.email_user) {
                this.errors.push("El Email del usuario es obligatoria.");
            }
            if (!this.form.country_user) {
                this.errors.push("El Pais del usuario es obligatoria.");
            }
            if (!this.form.id_category) {
                this.errors.push("La Categoria del usuario es obligatoria.");
            }

            e.preventDefault();

            console.log(this.errors);
                if(this.errors.length === 0){
                  this.enviar();
                }

            
        },
    },
};
</script>
