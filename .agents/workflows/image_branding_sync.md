# Workflow: Image Branding & Sync

Asegura que cada producto tenga una imagen premium alineada con el color Índigo.

// turbo-all

## Pasos

1. **Generación de Imagen**:
   - Usar `generate_image` con prompts enfocados en "almohadas premium, luz de luna, entorno índigo".

2. **Optimización y Almacenamiento**:
   - Mover la imagen a `public/images/products/`.
   - Renombrar siguiendo el slug del producto.

3. **Vinculación BD**:
   - Actualizar el campo `image_path` en la tabla `products`.

4. **Verificación Visual**:
   - Comprobar que la imagen se renderiza correctamente en la vista de catálogo.
