# Workflow: Admin Panel CRUD Generation

Estandariza la creación de interfaces de gestión para el administrador.

// turbo-all

## Pasos

1. **Controlador de Recursos**:
   - Crear controlador con `--resource`.

2. **Vistas Administrativas**:
   - Crear `index`, `create`, `edit` dentro de `resources/views/admin/`.
   - Usar componentes de tabla y formulario estandarizados.

3. **Políticas de Acceso**:
   - Crear `Gate` o `Policy` para asegurar que solo usuarios con rol 'admin' accedan.

4. **Sidebar Integration**:
   - Añadir el nuevo enlace al menú de navegación del administrador.
