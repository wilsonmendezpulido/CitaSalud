# Modelo Relacional – CitaSalud

## 1. Base de datos

**Nombre:** `citasalud`

**Motor:** MySQL

**Codificación:** UTF-8 / utf8mb4

## 2. Tablas

### usuarios

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| nombre_usuario | VARCHAR | NOT NULL |
| email | VARCHAR | UNIQUE |
| password | VARCHAR | NOT NULL |
| rol | ENUM | NOT NULL |
| estado | TINYINT | NOT NULL |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

### pacientes

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| usuario_id | INT | FK, UNIQUE |
| documento | VARCHAR | UNIQUE |
| nombre | VARCHAR | NOT NULL |
| apellido | VARCHAR | NOT NULL |
| fecha_nacimiento | DATE | |
| telefono | VARCHAR | |
| direccion | VARCHAR | |
| email | VARCHAR | |
| eps | VARCHAR | |
| sexo | ENUM | |
| discapacidad | VARCHAR | |
| estado | TINYINT | |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

### especialidades

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| nombre | VARCHAR | UNIQUE |
| descripcion | TEXT | |
| estado | TINYINT | |

### medicos

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| usuario_id | INT | FK |
| especialidad_id | INT | FK |
| nombre | VARCHAR | |
| apellido | VARCHAR | |
| registro_medico | VARCHAR | UNIQUE |
| telefono | VARCHAR | |
| email | VARCHAR | |
| perfil | TEXT | |
| estado | TINYINT | |

### disponibilidad

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| medico_id | INT | FK |
| fecha | DATE | |
| hora_inicio | TIME | |
| hora_fin | TIME | |
| estado | ENUM | |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

### citas

| Campo | Tipo | Restricción |
|---|---|---|
| id | INT | PK |
| paciente_id | INT | FK |
| medico_id | INT | FK |
| disponibilidad_id | INT | FK |
| fecha | DATE | |
| hora | TIME | |
| motivo | TEXT | |
| observaciones | TEXT | |
| estado | ENUM | |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

## 3. Relaciones

```text
usuarios 1 ───── 0..1 pacientes

usuarios 1 ───── 0..1 medicos

especialidades 1 ───── N medicos

medicos 1 ───── N disponibilidad

pacientes 1 ───── N citas

medicos 1 ───── N citas

disponibilidad 1 ───── 0..1 citas