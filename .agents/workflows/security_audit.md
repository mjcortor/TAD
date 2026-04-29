# Workflow: Security & Access Audit

Garantiza que la plataforma sea segura para los usuarios.

// turbo-all

## Pasos

1. **Revisión de Rutas**:
   - Ejecutar `php artisan route:list`.
   - Verificar que las rutas `/admin` y `/profile` tengan middleware `auth`.

2. **Validación de Inputs**:
   - Asegurar que no haya `$request->all()` en controladores sin un `FormRequest` previo.

3. **Protección CSRF**:
   - Verificar que todos los formularios Blade tengan la directiva `@csrf`.

4. **Escaneo de Vulnerabilidades**:
   - Revisar que los campos sensibles (passwords) estén siempre encriptados.
