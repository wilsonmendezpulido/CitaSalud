# Casos de Prueba – CitaSalud

## 1. Objetivo

Validar el funcionamiento del prototipo de alta fidelidad CitaSalud,
verificando los procesos principales de autenticación, gestión de
pacientes, programación de citas, consulta y cancelación de citas,
gestión del perfil y mecanismos básicos de seguridad.

---

## 2. Alcance

Las pruebas comprenden:

- Autenticación de usuarios.
- Control de acceso.
- Gestión de información del paciente.
- Consulta de especialidades.
- Selección de médico.
- Consulta de disponibilidad.
- Programación de citas.
- Consulta de citas.
- Cancelación de citas.
- Gestión del perfil.
- Validación de formularios.
- Protección CSRF.
- Navegación y usabilidad.
- Diseño responsive.

---

## 3. Casos de prueba

### CP-001 – Acceso al sistema

**Objetivo:** Verificar que el botón "Ingresar al sistema" dirija al
formulario de autenticación.

**Precondición:** El usuario se encuentra en la página inicial.

**Pasos:**
1. Ingresar a la página principal.
2. Seleccionar "Ingresar al sistema".

**Resultado esperado:** El sistema muestra el formulario de inicio de sesión.

---

### CP-002 – Inicio de sesión exitoso

**Objetivo:** Verificar el acceso con credenciales válidas.

**Precondición:** Usuario registrado y activo.

**Datos:**

- Correo: `wilson@citasalud.local`
- Contraseña: `123456`

**Pasos:**
1. Ingresar correo.
2. Ingresar contraseña.
3. Seleccionar "Ingresar".

**Resultado esperado:** El sistema autentica al usuario y lo dirige al
Dashboard.

---

### CP-003 – Inicio de sesión con credenciales incorrectas

**Objetivo:** Validar el rechazo de credenciales inválidas.

**Pasos:**
1. Ingresar un correo válido.
2. Ingresar una contraseña incorrecta.
3. Seleccionar "Ingresar".

**Resultado esperado:** El sistema no permite el acceso y muestra un
mensaje de autenticación fallida.

---

### CP-004 – Protección de rutas

**Objetivo:** Verificar que un usuario no autenticado no pueda acceder
a módulos protegidos.

**Pasos:**
1. Cerrar sesión.
2. Intentar acceder directamente a `/dashboard`.

**Resultado esperado:** El sistema redirige al usuario hacia el login.

---

### CP-005 – Consulta de especialidades

**Objetivo:** Verificar la visualización de especialidades disponibles.

**Pasos:**
1. Iniciar sesión.
2. Seleccionar "Programar cita".

**Resultado esperado:** Se muestran las especialidades médicas activas.

---

### CP-006 – Selección de médico

**Objetivo:** Verificar que los médicos correspondan a la especialidad
seleccionada.

**Pasos:**
1. Seleccionar una especialidad.
2. Seleccionar un médico.

**Resultado esperado:** El sistema muestra los médicos asociados a la
especialidad seleccionada.

---

### CP-007 – Consulta de disponibilidad

**Objetivo:** Verificar la disponibilidad de fechas y horarios.

**Pasos:**
1. Seleccionar médico.
2. Seleccionar una fecha disponible.
3. Consultar los horarios.

**Resultado esperado:** El sistema muestra los horarios disponibles.

---

### CP-008 – Programación de cita

**Objetivo:** Verificar el registro de una nueva cita.

**Pasos:**
1. Seleccionar especialidad.
2. Seleccionar médico.
3. Seleccionar fecha.
4. Seleccionar horario.
5. Confirmar la cita.
6. Ingresar el motivo.
7. Registrar la cita.

**Resultado esperado:** La cita es registrada correctamente y el horario
queda reservado.

---

### CP-009 – Consulta de mis citas

**Objetivo:** Verificar la visualización de las citas del paciente.

**Pasos:**
1. Iniciar sesión.
2. Seleccionar "Mis citas".

**Resultado esperado:** El sistema muestra las próximas citas y el
historial del paciente.

---

### CP-010 – Consulta del detalle de una cita

**Objetivo:** Verificar la visualización detallada de una cita.

**Pasos:**
1. Ingresar a "Mis citas".
2. Seleccionar "Ver detalle".

**Resultado esperado:** Se muestran médico, especialidad, fecha, hora,
estado y demás información disponible.

---

### CP-011 – Cancelación de una cita

**Objetivo:** Verificar la cancelación de una cita programada.

**Pasos:**
1. Ingresar a "Mis citas".
2. Seleccionar cancelar.
3. Confirmar la operación.

**Resultado esperado:** La cita cambia a estado CANCELADA y el horario
vuelve a estar disponible.

---

### CP-012 – Consulta del perfil

**Objetivo:** Verificar la visualización de la información personal.

**Pasos:**
1. Seleccionar "Mi perfil".

**Resultado esperado:** Se muestra la información registrada del paciente.

---

### CP-013 – Actualización del perfil

**Objetivo:** Verificar la modificación de información personal.

**Pasos:**
1. Ingresar a "Mi perfil".
2. Seleccionar "Editar".
3. Modificar teléfono, dirección u otro dato permitido.
4. Guardar.

**Resultado esperado:** El sistema almacena la información actualizada.

---

### CP-014 – Validación de campos obligatorios

**Objetivo:** Verificar la validación de formularios.

**Pasos:**
1. Abrir un formulario.
2. Dejar campos obligatorios vacíos.
3. Intentar guardar.

**Resultado esperado:** El sistema informa los campos que deben ser
completados.

---

### CP-015 – Protección CSRF

**Objetivo:** Verificar la protección de las operaciones POST.

**Pasos:**
1. Enviar manualmente una solicitud POST sin token CSRF válido.

**Resultado esperado:** El sistema rechaza la solicitud y muestra un
mensaje indicando que la solicitud no es válida.

---

### CP-016 – Cierre de sesión

**Objetivo:** Verificar el cierre correcto de la sesión.

**Pasos:**
1. Seleccionar "Cerrar sesión".

**Resultado esperado:** La sesión es destruida y el usuario retorna al
inicio o login.

---

### CP-017 – Navegación

**Objetivo:** Evaluar la consistencia de navegación.

**Pasos:**
1. Recorrer las opciones del menú.
2. Acceder a Inicio.
3. Acceder a Programar cita.
4. Acceder a Mis citas.
5. Acceder a Mi perfil.

**Resultado esperado:** Todos los enlaces conducen al módulo correspondiente.

---

### CP-018 – Diseño responsive

**Objetivo:** Verificar la adaptación de la interfaz a diferentes
resoluciones.

**Pasos:**
1. Abrir la aplicación en escritorio.
2. Reducir el ancho del navegador.
3. Simular una pantalla móvil mediante las herramientas del navegador.

**Resultado esperado:** Los contenidos permanecen legibles y utilizables.

---

## 4. Criterio de aceptación

Un caso de prueba se considera satisfactorio cuando el comportamiento
observado coincide con el resultado esperado y no se presentan errores
que impidan completar el flujo funcional evaluado.