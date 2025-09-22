### README — Doctor Appointment App

Un sistema de citas médicas construido con Laravel, Jetstream/Fortify, Livewire y Tailwind CSS. Proporciona autenticación, gestión de perfil, panel de administración y módulos para gestionar citas, doctores y pacientes.

---

### Características principales
- Registro, inicio de sesión y cierre de sesión (Laravel Fortify/Jetstream)
- Actualización de perfil, cambio de contraseña y 2FA opcional
- Cierre de sesiones en otros navegadores
- Eliminación de cuenta (si está habilitado en Jetstream)
- Vistas con Blade + Livewire
- Panel de administración con navegación lateral
- Estilos con Tailwind CSS y assets manejados por Vite/NPM

---

### Requisitos previos
- PHP 8.1+ (se recomienda 8.2/8.3)
- Composer 2.x
- MySQL/MariaDB o PostgreSQL (o SQLite para desarrollo)
- Node.js 18+ y NPM 8+
- Extensiones PHP típicas: `OpenSSL`, `PDO`, `Mbstring`, `Tokenizer`, `JSON`, `BCMath`, `Ctype`, `Fileinfo`

En Windows:
- PowerShell
- Servidor local (Laravel `php artisan serve`) o Apache/Nginx con PHP-FPM

---

### Instalación y configuración
1. Clonar el repositorio
   ```bash
   git clone <URL_DEL_REPO> doctor-appointment-app-4a
   cd doctor-appointment-app-4a
   ```

2. Copiar variables de entorno
   ```bash
   copy .env.example .env   # En PowerShell también puedes usar: cp .env.example .env
   ```

3. Configurar `.env`
    - `APP_NAME="Doctor Appointment"`
    - `APP_URL=http://localhost`
    - Base de datos (ejemplo MySQL):
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=doctor_appointments
      DB_USERNAME=tu_usuario
      DB_PASSWORD=tu_password
      ```
    - Archivos y almacenamiento:
      ```
      FILESYSTEM_DISK=public
      ```
    - Email (opcional para notificaciones y recuperación de contraseña):
      ```
      MAIL_MAILER=smtp
      MAIL_HOST=smtp.tu_proveedor.com
      MAIL_PORT=587
      MAIL_USERNAME=usuario
      MAIL_PASSWORD=clave
      MAIL_ENCRYPTION=tls
      MAIL_FROM_ADDRESS=notificaciones@tudominio.com
      MAIL_FROM_NAME="Doctor Appointment"
      ```

4. Instalar dependencias
   ```bash
   composer install
   npm install
   ```

5. Generar la clave de la app
   ```bash
   php artisan key:generate
   ```

6. Migraciones (y seeders si existen)
   ```bash
   php artisan migrate  # agrega --seed si hay seeders
   ```

7. Enlazar almacenamiento público
   ```bash
   php artisan storage:link
   ```

8. Compilar assets
    - Desarrollo:
      ```bash
      npm run dev
      ```
    - Producción:
      ```bash
      npm run build
      ```

9. Iniciar el servidor de desarrollo
   ```bash
   php artisan serve
   ```
   Abre: http://127.0.0.1:8000

---

### Scripts NPM útiles
- `npm run dev`: compila assets en modo desarrollo y observa cambios
- `npm run build`: compila y minifica para producción
- `npm run watch` (si está disponible): observa cambios continuamente

Nota: El proyecto usa Tailwind CSS; los cambios en `resources/css/app.css` requerirán recompilación.

---

### Estructura relevante
- `resources/views/layouts/admin.blade.php`: layout principal del panel
- `resources/views/layouts/includes/admin/navigation.blade.php`: navegación superior
- `resources/views/layouts/includes/admin/sidebar.blade.php`: menú lateral
- `resources/views/admin/dashboard.blade.php`: dashboard del admin
- `resources/views/profile/*.blade.php`: formularios de perfil (actualización, password, 2FA, etc.)
- `config/filesystems.php`: configuración de discos (usar `public` para uploads)
- `.env`: configuración de entorno

---

### Autenticación y perfil
El proyecto usa Jetstream/Fortify con Livewire:
- Actualización de perfil: `@livewire('profile.update-profile-information-form')`
- Cambio de contraseña
- 2FA opcional
- Cierre de otras sesiones
- Eliminación de cuenta (si está activado en Jetstream)

Para habilitar/deshabilitar características, revisa `config/fortify.php` y `config/jetstream.php`.

---

### Carga de archivos
- Asegura `FILESYSTEM_DISK=public` en `.env` y ejecuta `php artisan storage:link`.
- Verifica permisos de escritura en `storage/` y `bootstrap/cache/`.

---

### Despliegue (producción)
1. Configurar variables de entorno de producción (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://tu-dominio`)
2. Ejecutar migraciones: `php artisan migrate --force`
3. Compilar assets: `npm ci && npm run build`
4. Cachear configuración y rutas:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
5. Configurar cron (si hay tareas programadas):
   ```
   * * * * * php /ruta/a/artisan schedule:run >> /dev/null 2>&1
   ```
6. Servidor web: configurar la raíz del sitio en `public/` y HTTPS

---

### Pruebas
- Si existen pruebas: `php artisan test` o `vendor\bin\phpunit`

---

### Solución de problemas
- Error 500 tras clonar: falta `php artisan key:generate` o permisos en `storage/`
- Archivos no visibles: ejecutar `php artisan storage:link` y verificar `FILESYSTEM_DISK`
- Estilos/JS no aplican: correr `npm run dev` o `npm run build` y confirmar que Vite esté insertado en la plantilla (`@vite(['resources/css/app.css','resources/js/app.js'])`)
- Migraciones fallan: revisar credenciales DB en `.env` y que el usuario tenga permisos
- Error CSRF en formularios: confirma `@csrf` y dominio correcto en `APP_URL`

---

### Hoja de ruta (sugerida)
- Gestión completa de citas (CRUD, calendario, estados, recordatorios por email)
- Roles y permisos (Admin/Doctor/Paciente) con políticas y middleware
- Notificaciones (email/SMS) y recordatorios automáticos
- Reportes y exportaciones (CSV/PDF)
- Integración con pasarelas de pago (si aplica)

---

### Licencia
Este proyecto se distribuye bajo la licencia que definas en el repositorio (MIT, GPL, privativa, etc.). Actualiza esta sección según corresponda.

---

### Créditos
- Laravel, Jetstream, Fortify, Livewire, Tailwind CSS
