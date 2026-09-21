# Diagrama de Casos de Uso – CitaSalud

## Actores

- Paciente
- Médico
- Administrador

## Casos de uso principales

### Paciente

- Iniciar sesión
- Consultar especialidades
- Consultar médicos
- Consultar disponibilidad
- Programar cita
- Consultar mis citas
- Consultar detalle de cita
- Cancelar cita
- Consultar perfil
- Actualizar perfil
- Cerrar sesión

### Médico

- Consultar agenda
- Consultar citas asignadas
- Gestionar disponibilidad

### Administrador

- Gestionar usuarios
- Gestionar pacientes
- Gestionar médicos
- Gestionar especialidades
- Gestionar disponibilidad
- Consultar citas

## Código PlantUML

```plantuml
@startuml

left to right direction

actor Paciente
actor Médico
actor Administrador

rectangle CitaSalud {

    usecase "Iniciar sesión" as UC01
    usecase "Consultar especialidades" as UC02
    usecase "Consultar médicos" as UC03
    usecase "Consultar disponibilidad" as UC04
    usecase "Programar cita" as UC05
    usecase "Consultar mis citas" as UC06
    usecase "Consultar detalle de cita" as UC07
    usecase "Cancelar cita" as UC08
    usecase "Consultar perfil" as UC09
    usecase "Actualizar perfil" as UC10
    usecase "Cerrar sesión" as UC11

    usecase "Consultar agenda" as UC12
    usecase "Gestionar disponibilidad" as UC13

    usecase "Gestionar usuarios" as UC14
    usecase "Gestionar pacientes" as UC15
    usecase "Gestionar médicos" as UC16
    usecase "Gestionar especialidades" as UC17
    usecase "Consultar citas" as UC18
}

Paciente --> UC01
Paciente --> UC02
Paciente --> UC03
Paciente --> UC04
Paciente --> UC05
Paciente --> UC06
Paciente --> UC07
Paciente --> UC08
Paciente --> UC09
Paciente --> UC10
Paciente --> UC11

Médico --> UC01
Médico --> UC12
Médico --> UC13
Médico --> UC11

Administrador --> UC01
Administrador --> UC14
Administrador --> UC15
Administrador --> UC16
Administrador --> UC17
Administrador --> UC18
Administrador --> UC11

UC05 ..> UC02 : <<include>>
UC05 ..> UC03 : <<include>>
UC05 ..> UC04 : <<include>>

@enduml