# Workflow: i18n Localization (Multi-language)

Este workflow asegura que la aplicación sea bilingüe (ES/EN) de acuerdo a la Fase 3.

// turbo-all

## Pasos

1. **Escaneo de Vistas**:
   - Buscar textos planos en archivos `.blade.php`.
   - Reemplazarlos por directivas `{{ __('messages.key') }}`.

2. **Gestión de Archivos JSON/PHP**:
   - Crear o actualizar `lang/es/messages.php`.
   - Crear o actualizar `lang/en/messages.php`.

3. **Traducción con IA**:
   - Traducir las nuevas claves manteniendo el tono "descanso y salud".

4. **Middleware Check**:
   - Verificar que el `SetLocale` middleware esté activo y funcionando según la sesión o URL.
