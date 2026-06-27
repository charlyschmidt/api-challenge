# API REST - Gestión de Productos

## Requisitos
- PHP 8+
- MySQL
## Instalación

1. Clonar el proyecto.
2. Crear la base de datos utilizando el archivo `db.sql`.
3. Configurar el archivo `.env`.

Ejemplo:

```env
DB_HOST=localhost
DB_NAME=api_productos
DB_USER=root
DB_PASS=sarasas
PRECIO_USD=1480
```

4. Como correr la API.

Con el servidor embebido de PHP:

```bash
php -S localhost:8000
```

La API va a correr en:

```
http://localhost:8000
```

Con Artisan:

```bash
php artisan serve
```

La API por lo general va a correr en:

```
http://127.0.0.1:8000
```

---

## Endpoints

### Obtener todos los productos

```
GET /productos
```

### Obtener un producto

```
GET /productos/{id}
```

### Crear

```
POST /productos
```

Body:

```json
{
    "nombre":"Mouse",
    "descripcion":"Logitech",
    "precio":35000
}
```

### Actualizar

```
PUT /productos/{id}
```

### Eliminar

```
DELETE /productos/{id}
```