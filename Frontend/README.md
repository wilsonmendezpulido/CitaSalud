# Frontend – CitaSalud

## 1. Descripción

El frontend de **CitaSalud** corresponde a la implementación de la interfaz de usuario del prototipo de gestión de citas médicas.

La interfaz fue desarrollada considerando principios de **Interacción Humano-Computador (HCI)**, buscando facilitar la navegación, reducir la carga cognitiva y proporcionar retroalimentación clara durante las diferentes operaciones del sistema.

El frontend se integra con el backend mediante una **API REST**, permitiendo consultar y gestionar dinámicamente la información requerida para el proceso de programación de citas.

---

## 2. Tecnología

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- PHP Views
- Fetch API
- API REST
- Bootstrap Icons
- LocalStorage para preferencias de accesibilidad

---

## 3. Características HCI

La interfaz fue diseñada considerando:

- Consistencia visual.
- Navegación sencilla.
- Jerarquía visual.
- Retroalimentación de acciones.
- Mensajes claros.
- Formularios estructurados.
- Diseño responsive.
- Contraste adecuado.
- Reducción de carga cognitiva.
- Prevención de errores.
- Visibilidad del estado del sistema.
- Flujo de navegación progresivo.
- Confirmación de acciones críticas.

El proceso de programación de citas utiliza una navegación por pasos para que el usuario pueda identificar claramente en qué etapa del proceso se encuentra.

---

## 4. Principales vistas

El frontend contempla las siguientes vistas:

- Página inicial.
- Login.
- Dashboard.
- Especialidades.
- Médicos.
- Disponibilidad.
- Confirmación de cita.
- Resultado de cita.
- Mis citas.
- Detalle de cita.
- Perfil.
- Edición de perfil.
- CRUD de pacientes.

### Flujo de programación de citas

```text
Especialidad
      ↓
Profesional médico
      ↓
Fecha y hora
      ↓
Confirmación
      ↓
Cita programada
```

Este flujo permite orientar al usuario de manera progresiva durante la programación de una cita.

---

## 5. Navegación

El sistema utiliza una navegación consistente mediante un menú superior que permite acceder a:

- Inicio.
- Programar cita.
- Mis citas.
- Mi perfil.
- Documentación y guía de uso.
- Accesibilidad.
- Cerrar sesión.

La navegación busca mantener una estructura uniforme entre las diferentes vistas del sistema.

---

## 6. Integración con API REST

El frontend consume los servicios REST implementados en el backend.

El cliente de comunicación se encuentra en:

```text
public/js/api.js
```

La comunicación se realiza mediante `fetch()` y respuestas en formato JSON.

### Operaciones principales

```text
login()
getEspecialidades()
getMedicos()
getDisponibilidad()
getCitas()
getDetalleCita()
```

La autenticación de las solicitudes protegidas utiliza el token obtenido durante el inicio de sesión.

Las vistas de programación de citas consumen la API de forma dinámica para obtener:

1. Especialidades.
2. Médicos.
3. Disponibilidad.
4. Información necesaria para la confirmación.

---

## 7. Estados de la interfaz

Las vistas incorporan diferentes estados para proporcionar retroalimentación al usuario.

### Estado de carga

Se muestran indicadores mientras se consulta información mediante la API.

### Estado exitoso

Se presenta la información obtenida o la confirmación de la operación realizada.

### Estado vacío

Cuando no existen registros disponibles, se muestra un mensaje explicativo y una alternativa de navegación cuando corresponde.

### Estado de error

Cuando ocurre un problema durante la comunicación con la API, se muestra un mensaje y se proporciona la opción de reintentar la operación.

### Estado de confirmación

Las operaciones sensibles, como la cancelación de una cita, utilizan ventanas de confirmación antes de ejecutar la acción.

---

## 8. Responsive

La interfaz utiliza **Bootstrap 5** y CSS personalizado para adaptar componentes y contenedores a diferentes resoluciones de pantalla.

Se contemplan:

- Computadores de escritorio.
- Portátiles.
- Tablets.
- Dispositivos móviles.

Los componentes se adaptan mediante:

- Grid responsive.
- Cards.
- Formularios adaptables.
- Botones responsive.
- Modales.
- Contenedores fluidos.
- Media queries.

---

## 9. Accesibilidad

CitaSalud incorpora opciones de accesibilidad disponibles desde el dashboard.

El usuario puede configurar:

### Tamaño del texto

- Normal.
- Texto grande.
- Texto extra grande.

### Colores

- Normal.
- Modo oscuro.
- Alto contraste.

### Lectura y navegación

- Resaltar enlaces y botones.
- Reducir animaciones y movimiento.

Las preferencias seleccionadas se almacenan mediante `localStorage`, permitiendo conservar la configuración del usuario entre sesiones del navegador.

---

## 10. Usabilidad

Las interfaces fueron diseñadas considerando principios de HCI orientados a:

- Claridad de la información.
- Consistencia de controles.
- Reconocimiento antes que recuerdo.
- Retroalimentación inmediata.
- Prevención de errores.
- Visibilidad del estado del sistema.
- Navegación progresiva.
- Jerarquía visual.
- Reducción de carga cognitiva.

La programación de citas utiliza indicadores de progreso que muestran:

```text
Paso 1 → Especialidad
Paso 2 → Profesional
Paso 3 → Fecha y hora
Paso 4 → Confirmación
```

Esto permite que el usuario conozca el avance del proceso.

---

## 11. Formularios

Se implementaron formularios y controles para:

- Inicio de sesión.
- Edición de perfil.
- Programación de citas.
- Confirmación de citas.
- Cancelación de citas.
- Gestión de información de pacientes.

Los formularios incorporan validaciones y mensajes de retroalimentación para facilitar la corrección de datos.

---

## 12. Documentación y guía de uso

Desde el dashboard se incorporó un espacio de **Documentación y guías de uso**.

La interfaz permite acceder a:

- Guía de uso de CitaSalud.
- Video explicativo.
- Documento PDF.

El objetivo es facilitar el aprendizaje y comprensión de las funcionalidades principales del prototipo.

---

## 13. Optimización de rendimiento

Se aplicaron prácticas orientadas a mejorar el rendimiento y la experiencia de usuario:

- Carga dinámica de información mediante API REST.
- Uso de `async/await`.
- Reutilización del cliente API.
- Separación de estilos y scripts.
- Uso de componentes de Bootstrap.
- Manejo de estados de carga.
- Evitar solicitudes innecesarias.
- Uso de `localStorage` para preferencias de accesibilidad.
- Diseño adaptable para diferentes dispositivos.

---

## 14. Pruebas preliminares de usabilidad y accesibilidad

Las pruebas preliminares del frontend contemplan:

### Pruebas funcionales

- Inicio de sesión.
- Consulta de especialidades.
- Consulta de médicos.
- Consulta de disponibilidad.
- Programación de citas.
- Consulta de mis citas.
- Consulta de detalle.
- Cancelación de citas.
- Actualización del perfil.

### Pruebas de usabilidad

Se verifica:

- Claridad de textos.
- Facilidad de navegación.
- Visibilidad de botones.
- Comprensión del flujo de programación.
- Retroalimentación ante acciones.
- Comprensión de mensajes de error.
- Facilidad para identificar el estado actual del proceso.

### Pruebas de accesibilidad

Se verifica:

- Tamaño del texto.
- Contraste.
- Modo oscuro.
- Alto contraste.
- Resaltado de enlaces y botones.
- Reducción de animaciones.
- Visibilidad de los controles.

---

## 15. Despliegue

El frontend está preparado para ejecutarse junto con el backend mediante **XAMPP y Apache** en un entorno local.

La actividad contempla como posibilidad el despliegue en **AWS Cloud9 o Google Cloud para pruebas**, en caso de ser pertinente.

La ejecución local permite validar la integración entre:

```text
Frontend
    ↓
API REST
    ↓
Backend MVC
    ↓
MySQL
```

---

## 16. Estructura

La organización del frontend contempla los recursos de interfaz y comunicación:

```text
Frontend/
├── README.md
├── css/
│   └── citasalud.css
├── js/
│   ├── api.js
│   └── accesibilidad.js
├── views/
│   ├── auth/
│   ├── dashboard/
│   ├── citas/
│   └── perfil/
├── docs/
│   └── Guia_de_Uso_CitaSalud.pdf
├── videos/
│   └── guia-citasalud.mp4
└── pruebas/
    ├── usabilidad.md
    └── accesibilidad.md
```

---

## 17. Cumplimiento de la Fase 3

| Requisito | Estado |
|---|---|
| Diseño de formularios y vistas | ✅ Implementado |
| API-REST para consumir la base de datos | ✅ Implementado |
| Página responsive | ✅ Implementado |
| Estado de la interfaz | ✅ Implementado |
| AWS Cloud9 / Google Cloud | ⚪ Opcional / no requerido para la ejecución local |
| Integración con la API | ✅ Implementado |
| Pruebas preliminares de usabilidad y accesibilidad | ✅ Implementado |
| Optimización de rendimiento | ✅ Implementado |
| Documentación y guías de uso | ✅ Implementado |

---

## 18. Resultado

El frontend de **CitaSalud** proporciona una interfaz interactiva, responsive y orientada al usuario.

La implementación integra las vistas del prototipo con los servicios REST del backend, incorpora diferentes estados de interfaz y considera principios de HCI, usabilidad y accesibilidad.

De esta manera, la implementación cubre los principales elementos establecidos para la **Fase 3: Implementación Frontend**.
