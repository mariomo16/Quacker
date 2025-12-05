# Proyecto Laravel Quacker

## Instalación

1. Clonar el repositorio y entrar en la carpeta:

    ```bash
    git clone https://github.com/mariomo16/Quacker
    cd Quacker
    ```

2. Instalar dependencias de PHP y JavaScript:

    ```bash
    composer install
    npm install
    ```

3. Configurar archivo `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generar la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

5. Editar `.env` para ajustar la URL de la app:

    ```env
    APP_URL=http://localhost:8000
    ```

6. Ejecutar migraciones:

    ```bash
    php artisan migrate
    ```

---

## Visualización de la base de datos

Para inspeccionar y modificar la base de datos SQLite puedes usar cualquiera de estas aplicaciones:

-   **DB Browser for SQLite**: [sqlitebrowser.org ↗](https://sqlitebrowser.org)
-   **DBeaver**: [dbeaver.io ↗](https://dbeaver.io)
