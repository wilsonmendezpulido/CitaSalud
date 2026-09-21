# API – CitaSalud

## Descripción

CitaSalud utiliza una arquitectura MVC con comunicación interna entre
Controllers y Models. Adicionalmente se dispone de endpoints HTTP para
consulta de información.

## Endpoint de especialidades

### GET

```text
/especialidades

http://localhost/CitaSalud/public/especialidades

[
    {
        "id": 1,
        "nombre": "Medicina General",
        "descripcion": "Atención médica general"
    }
]