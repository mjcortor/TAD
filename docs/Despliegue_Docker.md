# Documentación de Despliegue con Docker

Este documento detalla el proceso de despliegue de la aplicación `Reposa+`, la arquitectura de contenedores utilizada y las justificaciones sobre las decisiones tomadas en cuanto al manejo de la base de datos y la infraestructura.

## 1. Proceso de Despliegue

El despliegue de la aplicación se ha estandarizado utilizando Docker Compose, lo cual permite levantar todo el entorno de desarrollo con unos pocos comandos, garantizando la homogeneidad entre distintos equipos.

Los pasos de inicialización de un entorno nuevo consisten en:
1. `docker compose up -d --build`: Construye la imagen personalizada de PHP y levanta todos los servicios en segundo plano.
2. `docker compose exec app bash -c "php artisan key:generate"`: Genera la clave única de la aplicación.
3. `docker compose exec app bash -c "php artisan migrate --seed"`: Construye la estructura de la base de datos y carga los datos de prueba o catálogo base.
4. `docker compose exec app bash -c "php artisan storage:link"`: Crea el enlace simbólico para que los archivos del almacenamiento sean accesibles de forma pública (ej. imágenes de productos).

## 2. Gestión de Base de Datos: Por qué no se incluye un `.sql` en el repositorio

Durante el despliegue, **no se ha utilizado ningún archivo de volcado `.sql` (como un backup tradicional)** para levantar la base de datos. En su lugar, el proyecto se basa íntegramente en el sistema de **Migraciones y Seeders** de Laravel.

### Justificación:
*   **Versionado seguro y granular:** Las migraciones actúan como un control de versiones de la base de datos. Permiten que múltiples desarrolladores modifiquen la estructura (añadiendo tablas o columnas) sin generar los conflictos insalvables que ocurren al fusionar (merge) archivos estáticos `.sql`.
*   **Seguridad y Privacidad:** Un archivo `.sql` exportado suele contener datos reales. Almacenarlo en el repositorio expondría información sensible de usuarios (contraseñas, emails) a cualquier persona con acceso al código fuente.
*   **Reproducibilidad y Contexto:** Un archivo `.sql` solo muestra el estado actual de la base de datos, pero no *cómo* se llegó ahí. Las migraciones mantienen el historial y permiten recrear la base de datos paso a paso en cualquier momento o entorno (local, testing, producción).
*   **Velocidad en el desarrollo:** Los Seeders permiten generar miles de registros falsos (mediante _factories_) bajo demanda, facilitando el trabajo local sin necesidad de mover pesados volcados de un lado a otro. 

El uso de archivos `.sql` queda estrictamente reservado para copias de seguridad de producción (Disaster Recovery), las cuales deben almacenarse de forma encriptada y fuera del control de versiones (Git).

## 3. Arquitectura de Servicios

El entorno local se define a través de `docker-compose.yml`, donde se levantan múltiples contenedores, cada uno con una responsabilidad única, siguiendo los principios de la arquitectura de microservicios:

*   **`app` (Laravel / PHP-FPM):** Es el corazón del proyecto. Contiene el código fuente de Laravel, ejecuta PHP y atiende las peticiones procesando la lógica de negocio. Se basa en una imagen personalizada (`docker/php/Dockerfile`) para incluir las extensiones necesarias.
*   **`nginx` (Servidor Web):** Actúa como proxy inverso. Recibe las peticiones HTTP externas (por el puerto 8080) y sirve los archivos estáticos directamente para mayor velocidad. Las peticiones dinámicas las reenvía al contenedor `app` por el puerto 9000.
*   **`mysql` (Base de datos):** Almacena de forma persistente y relacional toda la información de usuarios, pedidos y catálogo. Se ejecuta en la versión 8.0 y su almacenamiento se mapea a un volumen persistente (`mysql_data`) para no perder datos si se apaga el contenedor.
*   **`redis` (Caché y Colas):** Se utiliza como almacenamiento clave-valor en memoria. Es ideal para gestionar sesiones, acelerar consultas frecuentes mediante caché y procesar colas de tareas asíncronas en segundo plano (ej. envío masivo de correos).
*   **`mailhog` (Servidor SMTP simulado):** Intercepta todos los correos salientes que envía la aplicación sin que lleguen realmente a las bandejas de entrada de los usuarios. Proporciona una interfaz web (puerto 8025) para que los desarrolladores puedan previsualizar y depurar la maquetación y el envío de emails de forma segura y local.

## 4. Consideraciones del Despliegue con Contenedores

La decisión de empaquetar la aplicación en Docker conlleva ciertas ventajas y desventajas frente a alternativas tradicionales.

### Pros (Ventajas)
*   **"En mi máquina funciona":** Se elimina el clásico problema de diferencias entre el ordenador del desarrollador y el servidor. Todos operan sobre exactamente el mismo sistema operativo, versiones de PHP, extensiones y dependencias de base de datos.
*   **Aislamiento:** La aplicación no interfiere con otras aplicaciones del ordenador host. No necesitas instalar MySQL o PHP de forma global en tu Mac/PC.
*   **Onboarding rápido:** Un nuevo desarrollador solo necesita tener Docker instalado. Ejecuta un comando y en 2 minutos tiene todo el entorno de la empresa listo para empezar a programar.
*   **Escalabilidad en Producción:** Facilita el paso a orquestadores en la nube (como Kubernetes o AWS ECS), permitiendo escalar el servidor web independientemente de la base de datos si la demanda crece.

### Contras (Desventajas)
*   **Curva de Aprendizaje:** Requiere que el equipo tenga conocimientos básicos sobre Docker, redes de contenedores y mapeo de volúmenes.
*   **Consumo de Recursos en Local:** Docker puede consumir significativamente más CPU y memoria RAM que soluciones nativas (como Laravel Valet o XAMPP), especialmente en sistemas macOS y Windows debido a la máquina virtual intermedia.
*   **Rendimiento del disco (macOS/Windows):** Al montar volúmenes locales dentro del contenedor de Linux, el sistema de archivos puede ser ligeramente más lento en estos sistemas operativos en proyectos con miles de archivos (como la carpeta `vendor` de Laravel).
*   **Complejidad en CI/CD:** El sistema de despliegue continuo requiere pasos adicionales (construir imágenes Docker y subirlas a un registro privado) respecto a simplemente hacer un `git pull` y `composer install` mediante FTP/SSH clásico.
