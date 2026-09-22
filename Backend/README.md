# Backend – CitaSalud

## 1. Descripción

El backend de **CitaSalud** corresponde a una solución web desarrollada para gestionar de manera interactiva el proceso de programación y consulta de citas médicas.

La implementación utiliza una arquitectura **Modelo-Vista-Controlador (MVC)** y permite la comunicación entre el frontend, la lógica de negocio y la base de datos mediante una API REST.

El backend soporta los siguientes procesos:

- Autenticación de usuarios.
- Gestión de pacientes.
- Consulta de especialidades médicas.
- Consulta de médicos.
- Consulta de disponibilidad.
- Programación de citas.
- Consulta de citas.
- Consulta del detalle de una cita.
- Cancelación de citas.
- Gestión de información del perfil.

---

## 2. Tecnología

- **PHP 7.4**
- **Arquitectura MVC**
- **PDO**
- **MySQL 8**
- **Apache**
- **XAMPP**
- **API REST**
- **JSON**
- **Git / GitHub**

---

## 3. Arquitectura

El backend implementa una arquitectura MVC compuesta por controladores, modelos y componentes centrales para el enrutamiento, acceso a datos y seguridad.

### Controllers

Ubicación:

```text
app/Controllers/
```

Principales controladores:

- `AuthController`
- `HomeController`
- `PacienteController`
- `CitaController`
- `PerfilController`
- `EspecialidadController`
- `ApiController`

### Models

Ubicación:

```text
app/Models/
```

Principales modelos:

- `Usuario`
- `Paciente`
- `Especialidad`
- `Medico`
- `Disponibilidad`
- `Cita`

### Core

Ubicación:

```text
app/Core/
```

Componentes:

- `Router`
- `Controller`
- `Model`
- `Database`
- `Security`

### Estructura general

```text
Backend/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Core/
│   └── Middleware/
├── config/
│   └── config.php
├── routes/
│   └── web.php
├── database/
│   └── citasalud.sql
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── css/
│   └── js/
└── README.md
```

---

## 4. Base de datos

La conexión se realiza mediante **PDO** y utiliza **MySQL 8**.

Base de datos:

```text
citasalud
```

El componente encargado de la conexión se encuentra en:

```text
app/Core/Database.php
```

La configuración general se encuentra en:

```text
config/config.php
```

El acceso a la información se realiza mediante consultas parametrizadas.

---

## 5. Módulos implementados

### 5.1 Autenticación

Permite gestionar el acceso de los usuarios al sistema.

Funcionalidades:

- Login.
- Logout.
- Control de sesión.
- Validación de credenciales.
- Regeneración de sesión después de autenticación.

### 5.2 Gestión de pacientes

Permite administrar la información asociada a los pacientes.

Operaciones:

- Crear.
- Consultar.
- Actualizar.
- Eliminar lógicamente.

### 5.3 Gestión de citas

Constituye uno de los módulos principales de CitaSalud.

Funcionalidades:

- Consultar especialidades.
- Consultar médicos.
- Consultar disponibilidad.
- Programar cita.
- Consultar citas.
- Consultar detalle.
- Cancelar cita.

El flujo principal de programación es:

```text
Especialidad
      ↓
Profesional médico
      ↓
Fecha
      ↓
Hora disponible
      ↓
Confirmación
      ↓
Cita programada
```

### 5.4 Perfil

Permite al paciente consultar y actualizar su información.

Funcionalidades:

- Consultar información.
- Actualizar información personal.
- Actualizar información de contacto.

---

## 6. API REST

El backend incorpora una API REST para la comunicación con el frontend.

Las respuestas utilizan formato **JSON**.

### 6.1 Autenticación

#### Login

```http
POST /api/login
```

Parámetros:

```json
{
    "email": "usuario@citasalud.local",
    "password": "********"
}
```

Respuesta:

```json
{
    "success": true,
    "message": "Autenticación exitosa",
    "data": {
        "token": "..."
    }
}
```

### 6.2 Especialidades

```http
GET /api/especialidades
```

Permite consultar las especialidades médicas disponibles.

### 6.3 Médicos

```http
GET /api/medicos?especialidad_id=1
```

Parámetro:

- `especialidad_id`: identificador de la especialidad.

### 6.4 Disponibilidad

```http
GET /api/disponibilidad?medico_id=1&fecha=2026-10-01
```

Parámetros:

- `medico_id`: identificador del médico.
- `fecha`: fecha que se desea consultar.

### 6.5 Citas

Consultar las citas del paciente:

```http
GET /api/citas
```

Consultar detalle:

```http
GET /api/citas/detalle?id=1
```

Programar una cita:

```http
POST /api/citas
```

Cancelar una cita:

```http
POST /api/citas/cancelar
```

Las operaciones protegidas requieren autenticación.

---

## 7. Autenticación de API

Las solicitudes protegidas utilizan autenticación mediante token.

El cliente envía:

```http
Authorization: Bearer {token}
```

El backend valida el token antes de permitir el acceso a los recursos protegidos.

---

## 8. Seguridad

El backend incorpora:

- Password hashing mediante `password_hash()`.
- Verificación mediante `password_verify()`.
- Regeneración de sesión después de autenticación.
- Control de acceso mediante sesión.
- Protección CSRF para operaciones POST.
- Consultas preparadas mediante PDO.
- Validación de datos de entrada.
- Autenticación de endpoints protegidos mediante Bearer Token.

Las contraseñas no se almacenan en texto plano.

---

## 9. Rutas

Las rutas de la aplicación se encuentran en:

```text
routes/web.php
```

Las rutas permiten dirigir las solicitudes hacia los controladores correspondientes.

Entre las operaciones implementadas se encuentran:

```text
/login
/logout
/dashboard

/citas/create
/citas/medicos
/citas/disponibilidad
/citas/confirmar
/citas/store
/citas/mis-citas
/citas/detalle
/citas/cancelar

/perfil
/perfil/edit
/perfil/update
```

La API REST utiliza el prefijo:

```text
/api/
```

---

## 10. Pruebas

El backend contempla pruebas funcionales y de integración sobre los principales módulos.

### Autenticación

| Prueba | Resultado esperado |
|---|---|
| Login con credenciales válidas | Acceso permitido |
| Login con contraseña incorrecta | Acceso rechazado |
| Usuario inexistente | Acceso rechazado |
| Logout | Sesión finalizada |

### Citas

| Prueba | Resultado esperado |
|---|---|
| Consultar especialidades | Lista de especialidades |
| Consultar médicos | Lista filtrada por especialidad |
| Consultar disponibilidad | Horarios disponibles |
| Programar cita | Cita registrada |
| Consultar mis citas | Citas del paciente |
| Consultar detalle | Información completa |
| Cancelar cita | Cita actualizada |

### Seguridad

Se verifican:

- Control de sesión.
- Validación de token.
- Protección CSRF.
- Validación de parámetros.
- Consultas parametrizadas.
- Restricción de acceso a recursos protegidos.

---

## 11. Configuración y despliegue

El backend está preparado para ejecutarse en un entorno local mediante **XAMPP**.

### Requisitos

```text
PHP 7.4
MySQL 8
Apache
XAMPP
```

### Instalación

1. Copiar el proyecto dentro de:

```text
C:\xampp\htdocs\
```

2. Crear la base de datos:

```text
citasalud
```

3. Ejecutar el script:

```text
database/citasalud.sql
```

4. Configurar los parámetros de conexión en:

```text
config/config.php
```

5. Iniciar desde XAMPP:

```text
Apache
MySQL
```

6. Acceder a:

```text
http://localhost/CitaSalud/public
```

---

## 12. Control de versiones

El código fuente se gestiona mediante **Git** y se almacena en GitHub.

La estructura general del proyecto contempla:

```text
CitaSalud/
├── Fase_Diseño/
├── Backend/
├── Frontend/
└── Pruebas/
```

Esto permite organizar y documentar las diferentes fases de desarrollo del prototipo.

---

## 13. Cumplimiento de la Fase 2

La implementación del backend cubre los elementos solicitados en la actividad:

| Elemento solicitado | Estado |
|---|---|
| Controladores | ✅ Implementado |
| Modelos | ✅ Implementado |
| Rutas | ✅ Implementado |
| Mínimo dos módulos | ✅ Implementado |
| Conexión de base de datos | ✅ Implementado |
| Especificación de API | ✅ Implementado |
| Endpoints | ✅ Implementado |
| Métodos HTTP | ✅ GET / POST |
| Parámetros | ✅ Documentados |
| Respuestas | ✅ JSON |
| Autenticación | ✅ Sesión + Bearer Token |
| Seguridad | ✅ Implementada |
| Pruebas | ✅ Documentadas |
| Configuración | ✅ Documentada |
| Despliegue | ✅ Documentado |

### Resultado

El backend de **CitaSalud** implementa una solución funcional basada en MVC, con persistencia en MySQL, API REST, autenticación, mecanismos de seguridad y módulos para la gestión de pacientes, citas y perfil.

La implementación permite una experiencia interactiva cercana al producto final y cumple los componentes técnicos establecidos para la **Fase 2: Implementación Backend**.
