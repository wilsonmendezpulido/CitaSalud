# Diseño Conceptual – CitaSalud

## 1. Descripción general

CitaSalud es un prototipo de alta fidelidad para la gestión de citas
médicas de especialidades, desarrollado bajo principios de Interacción
Humano-Computador (HCI).

El sistema permite al paciente autenticarse, consultar especialidades
médicas, seleccionar un profesional, consultar fechas y horarios
disponibles, programar una cita, consultar sus citas, cancelar una cita
y administrar su información personal.

## 2. Actores

### Paciente

Es el usuario principal del sistema. Puede:

- Autenticarse.
- Consultar especialidades.
- Consultar médicos.
- Consultar disponibilidad.
- Programar citas.
- Consultar sus citas.
- Consultar el detalle de una cita.
- Cancelar citas.
- Consultar y actualizar su información personal.

### Médico

Representa al profesional asociado a una especialidad médica y a una
agenda de disponibilidad.

### Administrador

Representa el rol encargado de la administración de información del
sistema, como usuarios, médicos, especialidades y disponibilidad.

## 3. Entidades principales

### Usuario

Representa las credenciales y datos básicos de autenticación.

Atributos principales:

- id
- nombre_usuario
- email
- password
- rol
- estado

### Paciente

Representa al usuario que solicita y gestiona citas médicas.

Atributos principales:

- id
- usuario_id
- documento
- nombre
- apellido
- fecha_nacimiento
- teléfono
- dirección
- email
- EPS
- sexo
- discapacidad
- estado

### Especialidad

Representa el área médica ofrecida por CitaSalud.

Atributos:

- id
- nombre
- descripción
- estado

### Médico

Representa al profesional encargado de prestar el servicio médico.

Atributos:

- id
- usuario_id
- especialidad_id
- nombre
- apellido
- registro_medico
- teléfono
- email
- perfil
- estado

### Disponibilidad

Representa los espacios de tiempo disponibles de cada médico.

Atributos:

- id
- medico_id
- fecha
- hora_inicio
- hora_fin
- estado

### Cita

Representa la reserva realizada por un paciente con un médico.

Atributos:

- id
- paciente_id
- medico_id
- disponibilidad_id
- fecha
- hora
- motivo
- observaciones
- estado

## 4. Relaciones

Las principales relaciones del modelo son:

- Un usuario puede estar asociado a un paciente.
- Un usuario puede estar asociado a un médico.
- Una especialidad puede tener varios médicos.
- Un médico puede tener múltiples disponibilidades.
- Un paciente puede tener múltiples citas.
- Un médico puede atender múltiples citas.
- Una disponibilidad puede ser utilizada para una cita.
- Una cita pertenece a un paciente y a un médico.

## 5. Flujo conceptual

El flujo principal del sistema es:

Página inicial
→ Autenticación
→ Dashboard
→ Selección de especialidad
→ Selección de médico
→ Selección de fecha
→ Selección de horario
→ Confirmación
→ Registro de cita
→ Consulta de citas

## 6. Principios HCI considerados

El diseño considera:

- Consistencia de la interfaz.
- Visibilidad del estado del sistema.
- Retroalimentación inmediata.
- Prevención de errores.
- Reconocimiento antes que memorización.
- Navegación sencilla.
- Jerarquía visual.
- Diseño responsive.
- Mensajes claros.
- Reducción de carga cognitiva.

## 7. Alcance del prototipo

El prototipo implementa principalmente los procesos relacionados con:

1. Autenticación.
2. Gestión de pacientes.
3. Programación de citas.
4. Consulta de citas.
5. Cancelación de citas.
6. Gestión del perfil.