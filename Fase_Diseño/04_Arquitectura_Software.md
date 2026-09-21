# Arquitectura de Software – CitaSalud

## 1. Arquitectura utilizada

CitaSalud utiliza una arquitectura MVC (Model-View-Controller)
implementada en PHP 7.4.

La arquitectura separa:

- Lógica de presentación.
- Lógica de negocio.
- Acceso a datos.
- Enrutamiento.
- Seguridad.

## 2. Capas

### Presentación

Representada por:

```text
views/

┌──────────────────────────────┐
│          Usuario             │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│       Navegador Web          │
│ HTML5 + Bootstrap + JS       │
└──────────────┬───────────────┘
               │ HTTP
               ▼
┌──────────────────────────────┐
│           Router             │
│       public/index.php       │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│        Controllers           │
│ Auth / Cita / Paciente /     │
│ Perfil / Especialidad        │
└──────────────┬───────────────┘
               │
               ▼
┌──────────────────────────────┐
│           Models             │
│ Usuario / Cita / Paciente /  │
│ Médico / Disponibilidad      │
└──────────────┬───────────────┘
               │ PDO
               ▼
┌──────────────────────────────┐
│          MySQL               │
│         citasalud            │
└──────────────────────────────┘