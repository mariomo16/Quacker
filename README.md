# 🦆 Quacker

> Aplicación web estilo X (Twitter) desarrollada con Laravel, con enfoque en backend.

[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://www.php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![SQLite](https://img.shields.io/badge/SQLite-3.26.0+-green.svg)](https://www.sqlite.org)
[![Composer](https://img.shields.io/badge/Composer-2+-blue.svg)](https://getcomposer.org/)
[![Release](https://img.shields.io/github/v/release/mariomo16/Quacker)](https://github.com/mariomo16/Quacker/releases)
[![Last Commit](https://img.shields.io/github/last-commit/mariomo16/Quacker)](https://github.com/mariomo16/Quacker/commits/main)

## Instalación

### Clonar el repositorio

```bash
git clone https://github.com/mariomo16/Quacker.git && cd Quacker
```

### Preparar el proyecto y compilar assets

```bash
composer run setup
```

> [!NOTE]
> Este script prepara el proyecto por primera vez: instala dependencias de PHP y Node.js, copia el archivo `.env`, genera la key de Laravel, ejecuta migraciones y seeders de la base de datos, y compila los assets.

### Iniciar el servidor de desarrollo

```bash
php artisan serve
```

> [!WARNING]
> Para desarrollo activo con compilación de assets, se recomienda usar:
>
> ```bash
> composer run dev:linux || composer run dev
> ```

La aplicación estará disponible en `http://127.0.0.1:8000/`

El usuario para probar es admin@quacker.es y su respectiva contraseña es Admin123(Si algo falla estan todos los datos en el login del Quacker)

## Gestión de base de datos

Puedes visualizar la base de datos SQLite (`database/database.sqlite`) con:

-   [DBeaver](https://dbeaver.io) (gratuito, multiplataforma)
-   [DB Browser for SQLite](https://sqlitebrowser.org) (gratuito, específico SQLite)
-   [TablePlus](https://tableplus.com) (freemium, interfaz moderna)

## Referencias

-   [Laravel : Carbon shorten diffForHumans()](https://stackoverflow.com/questions/52371097/laravel-carbon-shorten-diffforhumans)
-   [laravel/docs/12.x/validation#rule-unique](https://laravel.com/docs/12.x/validation#rule-unique)

## Equipo de Desarrollo

Desarrollado por [@mariomo16](https://github.com/mariomo16), [@alfonsogomez45](https://github.com/alfonsogomez45) y [@ByAlberto](https://github.com/ByAlberto)
