# Workflow: Feature Generation (Laravel Specialist)

Este workflow guía al agente en la creación de nuevas funcionalidades siguiendo los estándares de Reposa+.

// turbo-all

## Pasos

1. **Revisión de Arquitectura**:
   - Consultar `EsquemaBBDD.md` para verificar relaciones.
   - Consultar `reposa_core.md` para reglas de branding.

2. **Andamiaje Artisan**:
   - Ejecutar `php artisan make:model {name} -mfs` (Modelo, Migración, Factory, Seeder).
   - Crear el controlador: `php artisan make:controller {name}Controller`.

3. **Codificación Estandarizada**:
   - Aplicar tipos estrictos (PHP 8.2) según el skill `laravel-specialist`.
   - Implementar relaciones Eloquent.
   - Usar `FormRequest` para validaciones.

4. **Ciclo de Pruebas**:
   - Crear Test de Pest/PHPUnit.
   - Ejecutar `php artisan test`.
   - Verificar que no existan consultas N+1.

5. **Documentación**:
   - Actualizar `Informe_Objetivos_Fases.md`.
