# CitaSalud – Sistema de Gestión de Citas Médicas

## Proyecto académico

**Asignatura:** SM26_CSE6061 – Human-Computer Interaction and Digital Citizenship  
**Actividad:** Asignación No. 2 – Caso de Estudio: Sistema de Gestión de Citas de Especialidades Médicas centrado en HCI  
**Tipo:** Prototipo de alta fidelidad  
**Institución:** Broward International University (BIU)

---

## 1. Descripción

CitaSalud es un prototipo de alta fidelidad orientado a la gestión de
citas médicas de especialidades.

El sistema fue diseñado aplicando principios de Interacción
Humano-Computador (HCI), con énfasis en facilidad de uso, navegación
consistente, prevención de errores, retroalimentación del sistema,
accesibilidad y diseño responsive.

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

Diseñar e implementar un prototipo funcional de alta fidelidad para
facilitar la gestión de citas médicas mediante una interfaz centrada
en las necesidades y características de los usuarios.

---

# 3. Tecnologías

## Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- PHP Views

## Backend

- PHP 7.4
- Arquitectura MVC
- PDO

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

El sistema utiliza una arquitectura MVC:

```text
Usuario
   │
   ▼
Navegador
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