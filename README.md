# Laravel REST API con Docker

API desarrollada con Laravel y MySQL, containerizada con Docker para entornos de desarrollo y producción.

## 🛠️ Prerrequisitos

- Docker 20.10+
- Docker Compose 2.0+
- Git (opcional)

## 🚀 Configuración inicial

### 1. Clonar el repositorio
```bash
git clone [URL_DEL_REPOSITORIO]
cd laravel-rest-api
```

### 2. Configurar variables de entorno
cp .env.example .env

Editar el archivo .env con estos valores:

```
APP_NAME="Laravel API"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=ciisa_backend
DB_USERNAME=myuser
DB_PASSWORD=mypassword
```

### 3. Construir y levantar los contenedores
```bash
docker-compose up -d --build
```

### 4. Instalar dependencias de PHP
```bash
docker-compose exec app composer install
```

### 5. Ejecutar migraciones y seeders (Datos iniciales)
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

## 🔍 Acceso a los servicios

| Servicio       | Tipo          | URL/Endpoint                     | Credenciales                  |
|----------------|---------------|----------------------------------|-------------------------------|
| API Laravel    | REST API      | `http://localhost:8000/api/*`    | -                             |
| MySQL          | Base de datos | `127.0.0.1:3306`                 | Usuario: `myuser`             |
|                |               |                                  | Contraseña: `mypassword`      |
| Logs           | Monitorización| `docker-compose logs -f [servicio]` | -                          |

## 🚀 Comandos esenciales

```bash
# Iniciar todos los servicios (modo detached)
docker-compose up -d


# Detener y eliminar contenedores (conserva volúmenes)
docker-compose down

# Detener y eliminar TODO (incluyendo volúmenes)
docker-compose down -v

# Acceder al contenedor Laravel (bash)
docker-compose exec app bash

# Ver logs en tiempo real
docker-compose logs -f app
```

## 🛠️ Comandos Artisan clave

```bash
# Ejecutar migraciones + seeders
docker-compose exec app php artisan migrate --seed

# Listar todas las rutas disponibles
docker-compose exec app php artisan route:list

# Limpiar cache de la aplicación
docker-compose exec app php artisan optimize:clear

# Generar clave de aplicación (solo si no es automático)
docker-compose exec app php artisan key:generate

### 🧪 Tests unitarios

Este proyecto utiliza **PHPUnit** junto con **Laravel Test Suite** para pruebas automatizadas. Las pruebas se ubican en `tests/Feature` y cubren los siguientes recursos:

- `Equipo`
- `Historia`
- `Imagen`
- `InfoContacto`
- `MantenimientoInfo`
- `PreguntaFrecuente`

#### ✅ Ejecutar los tests

Con Docker:

```bash
docker-compose exec app php artisan test

### Crear un nuevo test

Para generar un archivo de prueba en la carpeta Feature:

```bash
php artisan make:test NombreDelModeloTest --feature

### Crear un factory

Si tu modelo aún no tiene un factory, necesario para Model::factory(), puedes generarlo con:

```bash
php artisan make:factory NombreDelModeloFactory --model=NombreDelModelo
