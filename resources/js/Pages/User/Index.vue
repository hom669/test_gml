<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado de Usuarios
                <jet-button
                    class="bg-green-500 float-right"
                    @click="createUser = true"
                    >Crear Usuario</jet-button
                >

                <jet-dialog-modal :show="createUser" @close="closeUser()">
                    <template #title> Creación de Usuarios </template>

                    <template #content>
                        <user-create
                            :countries="countries"
                            :categories="categories"
                            :identifications="identifications"
                            :emails="emails"
                        >
                        </user-create>
                    </template>

                    <template #footer>
                        <jet-button class="bg-orange-400" @click="closeUser()">
                            Cancelar
                        </jet-button>
                    </template>
                </jet-dialog-modal>

                <jet-dialog-modal :show="editUser" @close="closeEdit()">
                    <template #title> Edición de Usuario </template>

                    <template #content>
                        <user-edit
                            :countries="countries"
                            :categories="categories"
                            :user="userToEdits"
                        >
                        </user-edit>
                    </template>

                    <template #footer>
                        <jet-button class="bg-orange-400" @click="closeEdit()">
                            Cancelar
                        </jet-button>
                    </template>
                </jet-dialog-modal>

                <jet-dialog-modal :show="viewUser" @close="closeView()">
                    <template #title> Información de Usuario </template>

                    <template #content>
                        <user-show-info :user_view="userToViews">
                        </user-show-info>
                    </template>

                    <template #footer>
                        <jet-button class="bg-orange-400" @click="closeView()">
                            Cancelar
                        </jet-button>
                    </template>
                </jet-dialog-modal>

                <!-- Delete User Confirmation Modal -->
                <jet-confirmation-modal
                    :show="UserDeleted"
                    @close="UserDeleted = null"
                >
                    <template #title> Eliminar Usuario </template>

                    <template #content>
                        Esta seguro de Eliminar el Usuario?
                    </template>

                    <template #footer>
                        <jet-button
                            class="bg-gray-300"
                            @click="UserDeleted = null"
                        >
                            Cancelar
                        </jet-button>

                        <jet-button
                            class="ml-3 bg-red-500"
                            @click="deleteUser(id_user_delete)"
                            :class="{ 'opacity-25': deleteUserForm.processing }"
                            :disabled="deleteUserForm.processing"
                        >
                            Eliminar
                        </jet-button>
                    </template>
                </jet-confirmation-modal>
            </h2>
        </template>

<!-- Create By Joker Banny -->
<div class="py-3 bg-gray-100 flex justify-center items-center px-2">
  <div class="space-y-1">
     <div class="flex items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
      <div class="flex bg-gray-100 p-4 w-72 space-x-4 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input v-model="filter" class="bg-gray-100 outline-none" type="text" placeholder="Ingrese valor para Filtrar..." />
      </div>
      <div class="flex py-3 px-4 rounded-lg text-gray-500 font-semibold cursor-pointer">
        <div>
                            <select
                              v-model="type_filter"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            >
                                <option value="">Todos los Campos</option>
                                <option value="name_user">Nombre</option>
                                <option value="surname_user">Apellidos</option>
                                <option value="email_user">Emails</option>
                                <option value="identification_user">Identifiaciones</option>
                                <option value="country_user">Paises</option>
                                <option value="movil_user">Celulares</option>
                                <option value="address_user">Direcciones</option>
                                <option value="name_category">Categorias</option>
      
                            </select>
                        </div>
      </div>
      <div class="bg-indigo-600 py-3 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
        <j-button @click="searchUser()">Buscar</j-button>
      </div>
    </div>
  </div>
</div>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-200"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Nombre y Apellido
                                                </th>

                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Identificacion
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Email
                                                </th>
                                                <!--  <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Dirección
                        </th>
                         <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Telefono Celular
                        </th> -->
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Pais Usuario
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Categoria Usuario
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200"
                                        >
                                            <tr v-if="!users.length">
                                                <td
                                                    class="p-6 text-center text-gray-900"
                                                    colspan="6"
                                                >
                                                    Sin Informacion
                                                </td>
                                            </tr>
                                            <tr
                                                v-for="user in users"
                                                :key="user.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    user.name_user
                                                                }}
                                                                {{
                                                                    user.surname_user
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    user.identification_user
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    user.email_user
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--  <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                                {{ user.address_user }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                                {{ user.movil_user }}
                              </div>
                            </div>
                          </div>
                        </td> -->
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    user.country_user
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    user.name_category
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                <jet-button
                                                                    @click="
                                                                        enableView(
                                                                            user.id_user
                                                                        )
                                                                    "
                                                                    class="uppercase p-1 flex items-center bg-blue-600 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-12 h-12"
                                                                >
                                                                    <svg
                                                                        width="32"
                                                                        height="32"
                                                                        viewBox="0 0 32 32"
                                                                        style="
                                                                            transform: rotate(
                                                                                360deg
                                                                            );
                                                                        "
                                                                    >
                                                                        <path
                                                                            d="M29 27.586l-7.552-7.552a11.018 11.018 0 1 0-1.414 1.414L27.586 29zM4 13a9 9 0 1 1 9 9a9.01 9.01 0 0 1-9-9z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                    </svg>
                                                                </jet-button>
                                                                <jet-button
                                                                    @click="
                                                                        enableEdit(
                                                                            user.id_user
                                                                        )
                                                                    "
                                                                    class="uppercase p-3 flex items-center bg-yellow-500 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-12 h-12"
                                                                >
                                                                    <svg
                                                                        width="32"
                                                                        height="32"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 32 32"
                                                                        style="
                                                                            transform: rotate(
                                                                                360deg
                                                                            );
                                                                        "
                                                                    >
                                                                        <path
                                                                            d="M26 18A10 10 0 1 1 16 8h6.182l-3.584 3.585L20 13l6-6l-6-6l-1.402 1.414L22.185 6H16a12 12 0 1 0 12 12z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                    </svg>
                                                                </jet-button>
                                                                <jet-button
                                                                    @click="
                                                                        enableDelete(
                                                                            user.id_user
                                                                        )
                                                                    "
                                                                    class="uppercase p-3 flex items-center bg-red-500 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-12 h-12"
                                                                >
                                                                    <svg
                                                                        width="32"
                                                                        height="32"
                                                                        preserveAspectRatio="xMidYMid meet"
                                                                        viewBox="0 0 32 32"
                                                                        style="
                                                                            transform: rotate(
                                                                                360deg
                                                                            );
                                                                        "
                                                                    >
                                                                        <path
                                                                            d="M12 12h2v12h-2z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                        <path
                                                                            d="M18 12h2v12h-2z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                        <path
                                                                            d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                        <path
                                                                            d="M12 2h8v2h-8z"
                                                                            fill="currentColor"
                                                                        ></path>
                                                                    </svg>
                                                                </jet-button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { pickBy } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import UserCreate from "../User/Create.vue";
import UserEdit from "../User/Edit.vue";
import UserShowInfo from "../User/Show.vue";
export default {
    components: {
        AppLayout,
        Head,
        Link,
        JetButton,
        JetInput,
        JetDialogModal,
        JetConfirmationModal,
        UserCreate,
        UserEdit,
        Inertia,
        UserShowInfo,
    },
    props: {
        users: Object,
        filters: Object,
        countries: Array,
        categories: Array,
        identifications: Array,
        emails: Array,
    },
    data() {
        return {
            createUser: false,
            editUser: false,
            viewUser: false,
            userToEdits: [],
            userToViews: [],
            usersAll: this.$props.users,
            UserDeleted: false,
            deleteUserForm: {
                processing: false,
            },
            id_user_delete: null,
            type_filter:"",
            filter:null
        };
    },
    methods: {
        openModal() {
            this.createUser = true;
        },
        closeUser() {
            this.createUser = false;
            location.reload();
        },
        closeEdit() {
            this.editUser = false;
            location.reload();
        },
        closeView() {
            this.viewUser = false;
        },
        enableEdit(userToEdit) {
            this.editUser = true;
            let result = this.usersAll.filter(
                (user) => user.id_user == userToEdit
            );
            this.userToEdits = result;
            /* this.userToEdits.map(function (user) {
                user.id_category = user.categories_gml.id_category;
            }); */
        },
        enableView(userToView) {
            this.viewUser = true;
            let result = this.usersAll.filter(
                (user) => user.id_user == userToView
            );
            this.userToViews = result;
            /* this.userToViews.map(function (user) {
                user.id_category = user.categories_gml.id_category;
                user.name_category = user.categories_gml.name_category;
            }); */
        },
        enableDelete(UserDelete) {
            this.UserDeleted = true;
            this.id_user_delete = UserDelete;
        },
        deleteUser(UserDelete) {
            this.$inertia.delete(route("usersgml.destroy", UserDelete));
            this.UserDeleted = false;
        },
        searchUser(){
          let filters = new Object();
          filters.type_filter = this.type_filter;
          filters.filter = this.filter;

          this.$inertia.get("usersgml", filters);
        }
    },
};
</script>
