# test_gml
Repositorio para preuba Tecnica en la compañia GML.

Sistema de Administración de Usuarios GML

# Especificaciones Tecnicas:

Laravel: 8.82.0
VueJs: 3
Postgresql: v 14

Otras Tecnologias Usadas:
JetStream e Inertia.js

# Descripcion Sistema:

El Sistema Cuenta con los siguientes modulos:

1. Pagina de Inicio descripcion del Proyecto con opciones de Registro y Login del Administrador del Sistema.
2. Dasboard Info del Sistemas
3. Administracion de Usuarios: Modulo para realizar CRUD de Usuarios.
4. Modulo de Administración de Usuario Administrador.

Modelo Entidad Relacion de Base de Datos:

    ![image](https://user-images.githubusercontent.com/78924776/155909220-d14aaa25-7538-4a71-994c-f0ac25c67e40.png)

# Inicio Proyecto

Pasos para arrancar proyecto administración de usuarios GML:

1. Descargar Poryecto desde GitHub
  git clone https://github.com/hom669/test_gml.git
2. Crear Base de Datos para el aplicativo en mi caso su nombre es:
    test_gml y esta creada en postgresql
3.  Realizar configuración a la BD de datos modificando las siguientes lineas en el archivo .env con sus credenciales de Base de datos:
    ![image](https://user-images.githubusercontent.com/78924776/155913350-c44a1f4d-fd2b-4967-b8ae-a6d8b4be8568.png)
3. Al cambiar la conexion ejecute las migraciones y seeders antes de iniciar el aplicativo con los siguientes comandos:
    # Ejecutar Migraciones 
    # php artisan migrate
    
    Obteniendo el siguiente resultado:
    
    ![image](https://user-images.githubusercontent.com/78924776/155914074-6aee5ee6-3f91-4d33-808b-774f7143d87e.png)
    
    # Ejejutar Seeder
    # php artisan db:seed
    
    Obteniendo el siguiente resultado
    
    ![image](https://user-images.githubusercontent.com/78924776/155914191-a42b322e-2235-4b4a-a0ad-8a0f226b02f7.png)

4. Finalmente Daremos inicio al aplicativo con el siguiente comando:
    # php artisan serve
    
    Obteniendo el Siguiente resultado la url para poder acceder a la aplicación:
    
    ![image](https://user-images.githubusercontent.com/78924776/155914286-d6de94f2-f6d3-4a34-8373-6802a7ea0edb.png)

5. Ya con esto tendremos acceso al aplicativo para realizar las pruebas pertinentes

    ![image](https://user-images.githubusercontent.com/78924776/155914350-94e75084-ee50-48d7-b01d-8c73e2bc03a2.png)

