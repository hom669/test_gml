<template>
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
                            <b>Nombre y Apellido Usuario: </b>{{form_view.name_user}} {{form_view.surname_user}}
                            <br>
                            <b>Identificacion Usuario: </b>{{form_view.identification_user}}
                            <br>
                            <b>Email Usuario: </b>{{form_view.email_user}}
                            <br>
                            <b>Pais Usuario: </b>{{form_view.country_user}}
                            <br>
                            <b>Dirección Usuario: </b>{{form_view.address_user}}
                            <br>
                            <b>Celular Usuario: </b>{{form_view.movil_user}}
                            <br>
                            <b>Categoria Usuario: </b>{{form_view.name_category}}
                            <br>
                            
                        </div>
                    </div>
                    </div>
                </div>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";

export default {
  components: {
    AppLayout, Head, Link, JetButton
  },
  props: {
    user_view: Array
  },
  created() {
        console.log(this.$props.user_view);
        this.form_view.name_user = this.$props.user_view[0].name_user;
        this.form_view.surname_user = this.$props.user_view[0].surname_user;
        this.form_view.identification_user = this.$props.user_view[0].identification_user;
        this.form_view.email_user = this.$props.user_view[0].email_user;
        this.form_view.country_user = this.$props.user_view[0].country_user;
        this.form_view.address_user = this.$props.user_view[0].address_user;
        this.form_view.movil_user = this.$props.user_view[0].movil_user;
        this.form_view.id_category = this.$props.user_view[0].id_category;
        this.form_view.name_category = this.$props.user_view[0].name_category;
    },
    data() {
        return {
            form_view: {
                name_user: this.$props.user_view[0].name_user,
                surname_user: this.$props.user_view[0].surname_user,
                identification_user: this.$props.user_view[0].identification_user,
                email_user: this.$props.user_view[0].email_user,
                country_user: this.$props.user_view[0].country_user,
                address_user: this.$props.user_view[0].address_user,
                movil_user: this.$props.user_view[0].movil_user,
                id_category: this.$props.user_view[0].id_category,
                name_category: this.$props.user_view[0].name_category,
            },
        };
    },
};
</script>