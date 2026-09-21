# Resultados de Pruebas – CitaSalud

## 1. Información general

**Proyecto:** CitaSalud  
**Tipo:** Prototipo de alta fidelidad centrado en HCI  
**Tecnología:** PHP 7.4, MySQL, Bootstrap 5 y JavaScript  
**Servidor:** Apache – XAMPP  
**Fecha de ejecución:** 21/09/2026

---

## 2. Resultados

| ID | Resultado | Evidencia | Observaciones |
|---|---|---|---|
| CP-001 | PASS | Captura de pantalla | El botón conduce correctamente al Login. |
| CP-002 | PASS | Captura de pantalla | El usuario accede correctamente al Dashboard. |
| CP-003 | PASS | Captura de pantalla | Las credenciales inválidas son rechazadas. |
| CP-004 | PASS | Captura de pantalla | Las rutas protegidas requieren autenticación. |
| CP-005 | PASS | Captura de pantalla | Se muestran las especialidades disponibles. |
| CP-006 | PASS | Captura de pantalla | Los médicos corresponden a la especialidad seleccionada. |
| CP-007 | PASS | Captura de pantalla | Se muestran fechas y horarios disponibles. |
| CP-008 | PASS | Captura de pantalla | La cita se registra correctamente. |
| CP-009 | PASS | Captura de pantalla | Se muestran las citas del paciente. |
| CP-010 | PASS | Captura de pantalla | Se muestra el detalle de la cita. |
| CP-011 | PASS | Captura de pantalla | La cita se cancela y el horario vuelve a estar disponible. |
| CP-012 | PASS | Captura de pantalla | Se muestra correctamente el perfil del paciente. |
| CP-013 | PASS | Captura de pantalla | La información del perfil puede actualizarse. |
| CP-014 | PASS | Captura de pantalla | Se validan los campos obligatorios. |
| CP-015 | PASS | Evidencia de seguridad | Las solicitudes sin token CSRF válido son rechazadas. |
| CP-016 | PASS | Captura de pantalla | La sesión se cierra correctamente. |
| CP-017 | PASS | Captura de pantalla | La navegación mantiene una estructura consistente. |
| CP-018 | PASS | Captura de pantalla | La interfaz se adapta a diferentes tamaños de pantalla. |

---

## 3. Resumen estadístico

| Indicador | Resultado |
|---|---:|
| Casos ejecutados | 18 |
| Casos exitosos | 18 |
| Casos fallidos | 0 |
| Casos bloqueados | 0 |
| Porcentaje de éxito | 100 % |

---

## 4. Evaluación

La ejecución de los casos de prueba permitió comprobar el funcionamiento
de los principales módulos implementados en el prototipo CitaSalud.

Los procesos de autenticación, navegación, programación de citas,
consulta y cancelación de citas, gestión del perfil y validación de
formularios presentaron el comportamiento esperado.

También se verificaron aspectos básicos de seguridad, particularmente
la protección de las operaciones POST mediante tokens CSRF y el control
de acceso a las rutas que requieren autenticación.

Desde la perspectiva HCI, se verificó la consistencia de navegación,
la organización de las opciones principales y la adaptación de la
interfaz a diferentes tamaños de pantalla.

## 5. Conclusión de las pruebas

Los 18 casos de prueba ejecutados fueron satisfactorios, alcanzando un
resultado de cumplimiento del 100 % de los escenarios definidos para
esta etapa del prototipo.

No se identificaron errores funcionales que impidieran completar los
flujos evaluados.