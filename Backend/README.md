# Backend – CitaSalud

## Tecnología

- PHP 7.4
- Arquitectura MVC
- PDO
- MySQL 8
- Apache
- XAMPP

## Arquitectura

El backend implementa una arquitectura MVC compuesta por:

### Controllers

Ubicación:

`app/Controllers/`

Principales controladores:

- AuthController
- HomeController
- PacienteController
- CitaController
- PerfilController
- EspecialidadController

### Models

Ubicación:

`app/Models/`

Principales modelos:

- Usuario
- Paciente
- Especialidad
- Medico
- Disponibilidad
- Cita

### Core

Ubicación:

`app/Core/`

Componentes:

- Router
- Controller
- Model
- Database
- Security

## Base de datos

La conexión se realiza mediante PDO y utiliza MySQL.

Base de datos:

`citasalud`

## Seguridad

El backend incorpora:

- Password hashing mediante `password_hash()`.
- Verificación mediante `password_verify()`.
- Regeneración de sesión después de autenticación.
- Control de acceso mediante sesión.
- Protección CSRF para operaciones POST.
- Consultas preparadas mediante PDO.
- Validación de datos de entrada.

## Módulos implementados

### Autenticación

- Login
- Logout
- Control de sesión

### Gestión de pacientes

- Crear
- Consultar
- Actualizar
- Eliminar lógicamente

### Gestión de citas

- Consultar especialidades
- Consultar médicos
- Consultar disponibilidad
- Programar cita
- Consultar citas
- Consultar detalle
- Cancelar cita

### Perfil

- Consultar información
- Actualizar información personal