# Proyecto de Prueba Técnica

Este repositorio contiene dos proyectos:

* API (Laravel 10) - Ubicada en la carpeta `api`

* Frontend (Vue 3) - Ubicado en la carpeta `web`

## Requisitos Previos

Asegúrate de tener instalado:

* PHP 8.1+ (recomendado 8.2)

* Composer

* Node.js 22+

* NPM o Yarn

* MySQL (para la base de datos)


## 🔧 Configuración del Backend (API - Laravel 10)

### 1️⃣ Acceder a la carpeta del backend

```bash
cd api
```

### 2️⃣ Instalar dependencias
```bash
composer install
```

### 3️⃣ Configurar el entorno
```bash
cp .env.example .env
```

Edita el archivo .env y configura los valores de la base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba_tecnica
DB_USERNAME=root
DB_PASSWORD=secret
```

### 4️⃣ Generar clave de aplicación y ejecutar migraciones

```bash
php artisan key:generate
php artisan migrate --seed
```

### 5️⃣ Iniciar el servidor

```bash
php artisan serve
```

El backend estará disponible en: http://127.0.0.1:8000

## 🎨 Configuración del Frontend (Vue 3)

### 1️⃣ Acceder a la carpeta del frontend
```bash
cd web
```

### 2️⃣ Instalar dependencias
```bash
npm install
```

### 3️⃣ Iniciar el servidor de desarrollo
```bash
npm run serve
```

El frontend estará disponible en: http://localhost:5173

## 🚀 Prueba rápida

Una vez que ambos servidores están corriendo, abre http://localhost:5173 en tu navegador y verifica que el frontend se conecta correctamente con el backend.

## 📌 Notas adicionales

Si necesitas autenticación, Laravel proporciona Sanctum como una opción sencilla para API Tokens.

Para modificar los estilos en el frontend, revisa la documentación de Vuetify: https://vuetifyjs.com/en/.

¡Listo para desarrollar 🚀! Si tienes dudas, revisa la documentación oficial de [Laravel](https://laravel.com/docs/10.x/documentation) y [Vue](https://vuejs.org/guide/introduction).