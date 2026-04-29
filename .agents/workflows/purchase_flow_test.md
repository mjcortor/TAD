# Workflow: Purchase Flow Validation

Garantiza que el núcleo del negocio (la venta de almohadas) sea funcional.

// turbo-all

## Pasos

1. **Simulación de Carrito**:
   - Añadir productos al carrito mediante tests de integración.
   - Verificar cálculo de totales e impuestos.

2. **Proceso de Checkout**:
   - Validar selección de dirección (CRUD Direcciones).
   - Simular pasarela de pago (si aplica) o validación de orden.

3. **Creación de Pedido**:
   - Comprobar que se generen registros en `orders` y `order_items`.
   - Reducción de stock en `products`.

4. **Notificación**:
   - Verificar en logs o Mailtrap que se dispare el correo de confirmación.
