
````markdown
# SGDP - Sistema de Gestión de Documentos y Procesos

**SGDP** es una plataforma web desarrollada en **Drupal 10**, diseñada para optimizar y centralizar el manejo de documentos relacionados con proveedores. Con este sistema, tu empresa podrá gestionar de forma eficiente la **recepción, validación, almacenamiento y seguimiento** de toda la documentación requerida para operar con tus proveedores, garantizando el **cumplimiento normativo** y la **trazabilidad** de los procesos.

---

## 🚀 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalados los siguientes componentes:

- [Docker](https://www.docker.com/)
- [DDEV](https://ddev.readthedocs.io/en/stable/)
- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)

---

## 🛠️ Instalación del Proyecto con DDEV

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/sgdp-drupal.git
cd sgdp-drupal
````

### 2. Configurar DDEV

```bash
ddev config --project-type=drupal10 --docroot=web --create-docroot
```

Esto configura el entorno DDEV para trabajar con Drupal 10 en el directorio `web/`.

### 3. Iniciar los contenedores de DDEV

```bash
ddev start
```

Este comando levanta el entorno de desarrollo local con servicios como PHP, MySQL y nginx.

### 4. Instalar dependencias del proyecto

```bash
ddev composer install
```

Esto instalará Drupal y los módulos necesarios definidos en el archivo `composer.json`.

### 5. Instalar Drupal (solo si no se va a importar una base de datos)

```bash
ddev drush site:install standard \
  --account-name=admin \
  --account-pass=admin \
  --site-name="SGDP"
```

Accede luego a tu sitio con:

* Usuario: `admin`
* Contraseña: `admin`

### 6. Importar base de datos existente (opcional)

Si tienes un archivo de base de datos `.sql.gz`:

```bash
ddev import-db --src=path/to/backup.sql.gz
```

### 7. Importar archivos del sitio (opcional)

Si tienes una copia de `sites/default/files`:

```bash
ddev rsync path/to/files/ web/sites/default/files
```

---

## 🌐 Acceso al Sitio

Una vez el entorno esté listo, puedes acceder a tu sitio Drupal desde:

```
https://sgdp.ddev.site
```

Puedes confirmar la URL de acceso con:

```bash
ddev describe
```

---

## 📁 Estructura del Proyecto

* `/web`: Código fuente de Drupal 10.
* `/modules/custom`: Módulos personalizados desarrollados para SGDP.
* `/themes/custom`: Temas visuales propios del proyecto.
* `/config`: Configuración exportada del sitio (config split).
* `/scripts`: Scripts útiles de automatización e instalación.

---

## 🧪 Comandos Útiles

* **Acceder al contenedor**:

  ```bash
  ddev ssh
  ```

* **Limpiar caché de Drupal**:

  ```bash
  ddev drush cr
  ```

* **Importar configuración exportada**:

  ```bash
  ddev drush cim -y
  ```

* **Exportar configuración del sitio**:

  ```bash
  ddev drush cex -y
  ```

* **Actualizar la base de datos (después de aplicar cambios)**:

  ```bash
  ddev drush updb
  ```
Navegador

Google Chrome
Versión 137.0.7151.55 ( Deseable)
Microsoft Edge
Versión 136.0.3240.92



---

## ✅ Buenas Prácticas

* Siempre exporta la configuración (`drush cex`) después de hacer cambios en el admin de Drupal.
* Usa ramas por funcionalidad si trabajas en equipo.
* Mantén tus módulos personalizados dentro de `/modules/custom`.
* No edites directamente módulos contribuidos.

---

## 🧩 Créditos y Licencia

Este proyecto ha sido desarrollado por el equipo de desarrollo interno.
Drupal es un proyecto de código abierto bajo licencia [GPL](https://www.gnu.org/licenses/gpl-2.0.html).


