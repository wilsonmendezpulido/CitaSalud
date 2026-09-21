# Mapa de Navegación – CitaSalud

## Flujo principal

```text
                         INICIO
                           │
                           ▼
                 Ingresar al sistema
                           │
                           ▼
                         LOGIN
                           │
                  ┌────────┴────────┐
                  │                 │
             Credenciales      Credenciales
              incorrectas         válidas
                  │                 │
                  ▼                 ▼
              Mensaje           DASHBOARD
                                    │
             ┌──────────────────────┼──────────────────────┐
             │                      │                      │
             ▼                      ▼                      ▼
       Programar cita           Mis citas             Mi perfil
             │                      │                      │
             ▼                      ▼                      ▼
       Especialidades           Próximas              Consultar
             │                   citas                 perfil
             ▼                      │                      │
          Médicos                   ▼                      ▼
             │                   Detalle                Editar
             ▼                      │                      │
       Disponibilidad               ▼                      ▼
             │                 Cancelar                Guardar
             ▼
          Horario
             │
             ▼
       Confirmación
             │
             ▼
        Cita creada
             │
             ▼
        Mis citas