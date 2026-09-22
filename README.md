# CitaSalud – Sistema de Gestión de Citas Médicas

## Proyecto académico

**Asignatura:** SM26_CSE6061 – Human-Computer Interaction and Digital Citizenship  
**Actividad:** Asignación No. 2 – Caso de Estudio: Sistema de Gestión de Citas de Especialidades Médicas centrado en HCI  
**Tipo:** Prototipo de alta fidelidad  
**Institución:** Broward International University (BIU)

---

# 1. Descripción

CitaSalud es un prototipo de alta fidelidad orientado a la gestión de citas médicas de especialidades.

El sistema fue diseñado aplicando principios de **Interacción Humano-Computador (HCI)**, con énfasis en facilidad de uso, navegación consistente, prevención de errores, retroalimentación del sistema, accesibilidad y diseño responsive.

El prototipo permite al paciente:

- Iniciar sesión.
- Consultar especialidades médicas.
- Consultar médicos.
- Consultar disponibilidad.
- Programar citas.
- Consultar próximas citas.
- Consultar historial.
- Consultar el detalle de una cita.
- Cancelar citas.
- Consultar su información personal.
- Actualizar su perfil.

---

# 2. Objetivo

Diseñar e implementar un prototipo funcional de alta fidelidad para facilitar la gestión de citas médicas mediante una interfaz centrada en las necesidades y características de los usuarios.

---

# 3. Tecnologías

## Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- PHP Views
- Fetch API
- Bootstrap Icons

## Backend

- PHP 7.4
- Arquitectura MVC
- PDO
- API REST
- JSON

## Base de datos

- MySQL 8
- UTF-8 / utf8mb4

## Servidor

- Apache
- XAMPP

## Control de versiones

- Git
- GitHub

---

# 4. Arquitectura

El sistema utiliza una arquitectura MVC integrada con una API REST para la comunicación entre la interfaz y el backend.

```text
                        Usuario
                           │
                           ▼
                       Navegador
                           │
                           ▼
                       Frontend
                 HTML / CSS / JS
                           │
                           ▼
                       API REST
                           │
                           ▼
                         Router
                           │
                           ▼
                      Controllers
                           │
                           ▼
                        Models
                           │
                           ▼
                          PDO
                           │
                           ▼
                         MySQL
```

La separación de responsabilidades permite organizar la presentación, la lógica de negocio y el acceso a datos.

---

# 5. Estructura del proyecto

```text
CitaSalud/
├── Fase_Diseño/
│   └── Documentación del diseño y prototipo
│
├── app/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Core/
│   │   └── Middleware/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── routes/
│   └── views/
│
├── Backend/
│   └── README.md
│
├── Frontend/
│   └── README.md
│
├── Pruebas/
│   └── Evidencias y documentación de pruebas
│
└── README.md
```

---

# 6. Funcionalidades principales

## 6.1 Autenticación

- Inicio de sesión.
- Validación de credenciales.
- Cierre de sesión.
- Control de sesión.
- Autenticación mediante token para operaciones API protegidas.

## 6.2 Programación de citas

La programación se desarrolla mediante un flujo de cuatro pasos:

```text
Paso 1
Especialidad
      ↓
Paso 2
Profesional médico
      ↓
Paso 3
Fecha y hora
      ↓
Paso 4
Confirmación
```

El usuario puede consultar dinámicamente la información disponible mediante la API REST.

## 6.3 Mis citas

Permite:

- Consultar próximas citas.
- Consultar historial.
- Consultar detalle.
- Cancelar citas.

## 6.4 Perfil

Permite:

- Consultar información personal.
- Actualizar información.
- Actualizar información de contacto.

## 6.5 Documentación

Desde el dashboard se dispone de una sección de **Documentación y guías de uso**, que permite acceder a los recursos preparados para orientar al usuario sobre el funcionamiento del prototipo.

## 6.6 Accesibilidad

El dashboard incorpora opciones para:

- Cambiar el tamaño del texto.
- Activar modo oscuro.
- Activar alto contraste.
- Resaltar enlaces y botones.
- Reducir animaciones y movimiento.
- Restablecer la configuración.

Las preferencias de accesibilidad se almacenan mediante `localStorage`.

---

# 7. Integración Frontend – Backend

La comunicación entre frontend y backend se realiza mediante una API REST.

El cliente de API se encuentra en:

```text
public/js/api.js
```

Las operaciones principales incluyen:

```text
login()
getEspecialidades()
getMedicos()
getDisponibilidad()
getCitas()
getDetalleCita()
```

La comunicación utiliza solicitudes HTTP y respuestas en formato JSON.

El flujo general es:

```text
Usuario
   ↓
Interfaz CitaSalud
   ↓
JavaScript / Fetch API
   ↓
API REST
   ↓
Controllers
   ↓
Models
   ↓
MySQL
   ↓
Respuesta JSON
   ↓
Actualización de interfaz
```

---

# 8. API REST

Principales endpoints utilizados por el frontend:

| Método | Endpoint | Función |
|---|---|---|
| POST | `/api/login` | Autenticación |
| GET | `/api/especialidades` | Consultar especialidades |
| GET | `/api/medicos?especialidad_id=1` | Consultar médicos |
| GET | `/api/disponibilidad?medico_id=1&fecha=2026-10-01` | Consultar disponibilidad |
| GET | `/api/citas` | Consultar citas |
| GET | `/api/citas/detalle?id=1` | Consultar detalle |
| POST | `/api/citas` | Programar cita |
| POST | `/api/citas/cancelar` | Cancelar cita |

Las operaciones protegidas utilizan autenticación mediante:

```http
Authorization: Bearer {token}
```

---

# 9. Diseño HCI

CitaSalud aplica principios de HCI para facilitar la interacción del usuario.

Entre los criterios considerados se encuentran:

- Consistencia visual.
- Jerarquía de información.
- Navegación sencilla.
- Visibilidad del estado del sistema.
- Retroalimentación inmediata.
- Prevención de errores.
- Mensajes claros.
- Formularios estructurados.
- Reducción de carga cognitiva.
- Diseño responsive.
- Accesibilidad.

El proceso de programación de citas utiliza indicadores de progreso para mostrar al usuario el paso actual.

---

# 10. Diseño responsive

La interfaz utiliza Bootstrap 5 y CSS personalizado para adaptarse a diferentes tamaños de pantalla.

Se contemplan:

- Computadores.
- Portátiles.
- Tablets.
- Dispositivos móviles.

Los componentes utilizan:

- Grid responsive.
- Cards.
- Formularios adaptables.
- Botones responsive.
- Modales.
- Contenedores fluidos.
- Media queries.

---

# 11. Estados de interfaz

El frontend contempla diferentes estados durante la interacción:

### Cargando

Se presenta un indicador mientras se procesa una solicitud.

### Éxito

Se muestra la información obtenida o el resultado de la operación.

### Vacío

Se informa cuando no existen registros disponibles.

### Error

Se muestra un mensaje explicativo y, cuando corresponde, una opción para reintentar.

### Confirmación

Las acciones críticas, como cancelar una cita, requieren confirmación antes de ejecutarse.

Estos estados proporcionan retroalimentación y mejoran la comprensión del funcionamiento del sistema.

---

# 12. Seguridad

El backend incorpora mecanismos de seguridad como:

- `password_hash()`.
- `password_verify()`.
- Regeneración de sesión.
- Control de acceso mediante sesión.
- Protección CSRF para operaciones POST.
- Consultas preparadas mediante PDO.
- Validación de datos de entrada.
- Autenticación mediante Bearer Token para recursos API protegidos.

Las contraseñas no se almacenan en texto plano.

---

# 13. Usabilidad y accesibilidad

Se realizaron consideraciones preliminares de usabilidad y accesibilidad sobre:

### Usabilidad

- Claridad de textos.
- Facilidad de navegación.
- Visibilidad de botones.
- Comprensión del flujo.
- Retroalimentación ante acciones.
- Mensajes de error.
- Identificación del paso actual.

### Accesibilidad

- Tamaño configurable del texto.
- Contraste.
- Modo oscuro.
- Alto contraste.
- Resaltado de enlaces y botones.
- Reducción de animaciones.
- Visibilidad de controles.

---

# 14. Pruebas

El proyecto contempla pruebas sobre los principales procesos.

## Pruebas funcionales

- Login.
- Consulta de especialidades.
- Consulta de médicos.
- Consulta de disponibilidad.
- Programación de citas.
- Consulta de citas.
- Consulta de detalle.
- Cancelación.
- Actualización de perfil.

## Pruebas de interfaz

- Visualización responsive.
- Estados de carga.
- Estados vacíos.
- Mensajes de error.
- Confirmaciones.
- Navegación entre pasos.

## Pruebas de usabilidad y accesibilidad

- Comprensión de textos.
- Navegación.
- Contraste.
- Tamaño del texto.
- Accesibilidad visual.
- Reducción de movimiento.

---

# 15. Optimización

Se incorporaron prácticas orientadas a mejorar la experiencia de usuario:

- Carga dinámica mediante API.
- Uso de `async/await`.
- Reutilización del cliente API.
- Separación de estilos y scripts.
- Uso de componentes Bootstrap.
- Manejo de estados de carga.
- Evitar solicitudes innecesarias.
- Almacenamiento local de preferencias de accesibilidad.
- Diseño adaptable.

---

# 16. Documentación y guías de uso

El proyecto incorpora documentación para facilitar la comprensión y utilización del prototipo.

Los recursos contemplados incluyen:

- README general.
- README del Backend.
- README del Frontend.
- Guía de uso.
- Video explicativo.
- Evidencias de pruebas.

---

# 17. Ejecución local

El prototipo puede ejecutarse mediante **XAMPP**.

## Requisitos

```text
PHP 7.4
MySQL 8
Apache
XAMPP
Navegador web
```

## Instalación

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
Backend/database/citasalud.sql
```

4. Verificar la configuración de conexión en:

```text
Backend/config/config.php
```

5. Iniciar Apache y MySQL desde XAMPP.

6. Abrir:

```text
http://localhost/CitaSalud/public
```

---

# 18. Control de versiones

El proyecto utiliza Git para el control de versiones y GitHub como repositorio remoto.

La organización contempla las diferentes fases de la actividad:

```text
Fase_Diseño
Backend
Frontend
Pruebas
```

Esto permite mantener separadas las evidencias, implementación y documentación correspondientes a cada etapa.

---

# 19. Cumplimiento de la actividad

El proyecto integra los componentes principales solicitados para las fases de implementación:

| Componente | Estado |
|---|---|
| Prototipo de alta fidelidad | ✅ Implementado |
| Diseño HCI | ✅ Implementado |
| Backend MVC | ✅ Implementado |
| Base de datos MySQL | ✅ Implementado |
| API REST | ✅ Implementado |
| Frontend responsive | ✅ Implementado |
| Integración Frontend–Backend | ✅ Implementado |
| Estados de interfaz | ✅ Implementado |
| Accesibilidad | ✅ Implementado |
| Usabilidad preliminar | ✅ Implementado |
| Optimización | ✅ Implementado |
| Documentación | ✅ Implementado |
| Guías de uso | ✅ Implementado |
| AWS Cloud9 / Google Cloud | ⚪ Opcional / no utilizado en la ejecución local |

---

# 20. Resultado del proyecto

CitaSalud integra una interfaz de alta fidelidad con un backend MVC, una base de datos MySQL y una API REST para gestionar el proceso de citas médicas.

El prototipo permite recorrer el flujo completo de programación:

```text
Inicio de sesión
       ↓
Dashboard
       ↓
Especialidad
       ↓
Profesional
       ↓
Fecha y hora
       ↓
Confirmación
       ↓
Cita programada
       ↓
Consulta / detalle / cancelación
```

La solución incorpora principios de HCI, diseño responsive, estados de interfaz, accesibilidad, seguridad e integración entre frontend y backend, proporcionando una base funcional para la evaluación del prototipo de alta fidelidad.

---

# 21. Autores

**Proyecto académico – CitaSalud**

**Estudiante:** Wilson Rolando Mendez Pulido  
**Asignatura:** SM26_CSE6061 – Human-Computer Interaction and Digital Citizenship  
**Institución:** Broward International University (BIU)
