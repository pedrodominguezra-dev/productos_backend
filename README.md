# Proyecto de productos

Este proyecto tiene como fin desarollar una prueba de evaluación.

## Pasos para instalar y ejecutar el proyecto

Antes de empezar con la instalación, el equipo debe tener instalado PHP con una versión 8.2 o superior. Además del paquete de composer ya que es fundamental para la instalación de paquetes

### Instalar las dependencias
```
composer  i
```

### Copiar el .env.example a .env
Al clonar el repositorio debe de copiar el .env.example a cambiar el nombre a .env, para configurar la base de datos asi como otra configuración necesaria con las credenciales correspondientes, estas configuraciones se mencionan a continuación

* Credenciales de mysql
    * DB_PORT=3306
    * DB_DATABASE
    * DB_USERNAME
    * DB_PASSWORD

* Meiliserach
    * Meilisearch tiene una configuración base, en caso de que desee cambiarla, deberá cambiarla en el archivo de docker-compose.yml
    * MEILISEARCH_KEY generar una llave segura
* Otra configuración necesaria a sus necesidades

### Ejecutar el docker-composer
Debera ejecutar el archivo de docker-composer.yml con el siguiente comando:
```
 docker-compose up --build
```

Esto descargara los contenedores necesarios, en caso de que quiera cambiar algun puerto en específico, es necesario revisar el docker-compose.yml y modificar las variables de entorno.

Es importante ejecutar los contenedores antes de ejecutar las migraciones y seeders

### Ejecutar las migraciones
```
php artisan migrate
```

### Ejecutar los seeders
Esto ayudara a cargar un usuario para ingresar a la plataforma además de ingresar productos a mostrar
```
php artisan db:seed
```

### Crear nueva key para el sistema
Este token ofrece un candado de seguridad 

```
php artisan key:generate
```

### Ejecutar el comando para crear índices
Esto permitirá a meilisearch funcionar 
```
php artisan app:rebuild-all
```

### Ejecutar el sistema
```
php artisan serve
```

El sistema api se encontrá alojado en la url
```
http://127.0.0.1:8000/api
```