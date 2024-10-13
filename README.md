
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Proyecto Laravel

Este proyecto está desarrollado utilizando el framework **Laravel**, una plataforma poderosa y flexible para crear aplicaciones web modernas. Laravel facilita las tareas comunes en proyectos web como el enrutamiento, la gestión de bases de datos, procesamiento en segundo plano, entre otras.

## Características

- Sistema de enrutamiento eficiente y fácil de usar.
- Potente contenedor de inyección de dependencias.
- Soporte para múltiples backends de sesiones y caché.
- ORM intuitivo para manejo de bases de datos (Eloquent).
- Sistema de migraciones de bases de datos.
- Procesamiento robusto de trabajos en segundo plano.
- Emisión de eventos en tiempo real.

## Requisitos del Sistema

Asegúrate de tener instaladas las siguientes dependencias antes de empezar:

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js y npm (para compilación de activos)

## Instalación

Sigue estos pasos para clonar y configurar el proyecto:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/ErickGranda3756/EduLaravel.git
   cd tu_proyecto
   ```

2. Instala las dependencias de PHP utilizando Composer:
   ```bash
   composer install
   ```

3. Copia el archivo `.env.example` a `.env` y configura las variables de entorno:
   ```bash
   cp .env.example .env
   ```

4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

5. Configura la base de datos en el archivo `.env`, luego migra las tablas:
   ```bash
   php artisan migrate
   ```

6. Instala las dependencias de Node.js y compila los archivos front-end:
   ```bash
   npm install
   npm run dev
   ```

7. Inicia el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## Comandos Útiles

Algunos comandos comunes que podrías utilizar durante el desarrollo:

- **Iniciar el servidor de desarrollo:**
  ```bash
  php artisan serve
  ```

- **Ejecutar migraciones de base de datos:**
  ```bash
  php artisan migrate
  ```

- **Revertir migraciones:**
  ```bash
  php artisan migrate:rollback
  ```

- **Compilar activos de front-end:**
  ```bash
  npm run dev
  ```

- **Ejecutar tests:**
  ```bash
  php artisan test
  ```

## Documentación y Recursos

- [Documentación de Laravel](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts](https://laracasts.com)

## Licencia

Este proyecto está licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).
