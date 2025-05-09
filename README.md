<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Application

Esta pequeña aplicacion o modulo permite registrar datos asociados a turnos de trabajo (día y noche),
así como gestionar los turnos. Desarrollado usando Laravel 12.8 y JavaScript sin frameworks usando blade de laravel para las vistas.

Tecnologías Usadas
PHP 8.2
Laravel 12.8
Blade (Laravel views)
JavaScript puro (sin frameworks)
MySQL / MariaDB (migraciones en laravel)
HTML + CSS básicos + Boostrap

Estructura del Proyecto
Modelos:
-Turno: contiene los turnos configurables.
-Registro: guarda los datos de producción vinculados a un turno.

Controladores:
-RegistroController: gestiona la vista principal, el registro y la consulta de datos.
-TurnoController: permite crear, editar, eliminar y listar turnos.

Rutas:
Route::post('/turnos', [TurnoController::class, 'store']);
Route::put('/turnos/{turno}', [TurnoController::class, 'update']);
Route::delete('/turnos/{turno}', [TurnoController::class, 'destroy']);
Route::get('/turnos/{turno}', [TurnoController::class, 'show']);
Route::post('/registro', [RegistroController::class, 'store']);
Route::get('/registros', [RegistroController::class, 'filtrar']);
Route::get('/registros/{id}', [RegistroController::class, 'show']);
Route::put('/registros/{id}', [RegistroController::class, 'update']);
Route::delete('/registros/{id}', [RegistroController::class, 'destroy']);

Funcionalidades
-Crear Turnos: Modal para agregar los turnos, permite editar y eliminar turnos

Formulario con campos:
Fecha
Máquina
Proyecto
Turno (seleccionado desde un select dinámico)
Validación básica del lado del servidor

Almacenamiento del registro en la base de datos

Gestión de Turnos
Crear, editar, eliminar turnos desde interfaz
Listado de turnos existentes
Visualización con filtro de turnos día y noche
Filtro por turno (Día / Noche) mediante JavaScript puro
Resultados mostrados en tabla HTML dinámica

Base de Datos
Ejecutar las migraciones
php artisan migrate

Tabla turnos:
id	nombre	created_at	updated_at
1	Día
2	Noche

Tabla registros:
id	fecha	maquina	proyecto	turno_id	created_at updated_at
1	2025-04-03	Maquina 1	Proyecto 1		2025-04-11 14:53:45	2025-04-11 14:53:45


Instrucciones para ejecutar
Clona o descomprime el proyecto.

Crea una base de datos en MySQL.

Copia el archivo .env.example a .env y configura los datos de conexión.

Ejecuta los siguientes comandos:
composer install
composer global require laravel/installer
php artisan migrate
php artisan serve
Accede a:
http://localhost:8000


Estructura y Fiabilidad
Código modular separado por responsabilidades.
Validación en el servidor para evitar datos corruptos.
Sin frameworks JS.
Compatible con navegadores modernos.
