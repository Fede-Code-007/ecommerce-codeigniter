# 🛒 E-commerce con CodeIgniter 4

Aplicación web de comercio electrónico desarrollada con **CodeIgniter 4**, **PHP**, **MySQL**, **HTML**, **CSS** y **Bootstrap**, utilizando el patrón arquitectónico **MVC (Modelo-Vista-Controlador)**.

El proyecto fue desarrollado como una práctica académica de desarrollo web y permite gestionar productos, usuarios, carrito de compras y ventas, diferenciando las funcionalidades disponibles según el tipo de usuario.

> 📌 **Nota:** Este proyecto fue desarrollado aproximadamente en 2024 como práctica de desarrollo web. Se trata de una implementación básica con fines educativos y no incluye funcionalidades avanzadas como pasarelas de pago.

---

## 📋 Características

### 👤 Usuarios

El sistema contempla tres situaciones de acceso:

* **Administrador**

  * Gestionar productos.
  * Gestionar usuarios.
  * Consultar ventas realizadas.
  * Visualizar mensajes enviados por clientes y visitantes.
  * Consultar facturas.
  * Modificar perfiles de usuarios.

* **Cliente**

  * Consultar el catálogo de productos.
  * Agregar productos al carrito.
  * Modificar cantidades.
  * Eliminar productos del carrito.
  * Vaciar el carrito.
  * Realizar compras.
  * Consultar el historial de compras y facturas.
  * Enviar mensajes al administrador.

* **Visitante**

  * Consultar el catálogo.
  * Enviar consultas o mensajes al administrador sin iniciar sesión.

### 📦 Gestión de productos

El administrador puede:

* Dar de alta productos.
* Modificar productos.
* Dar de baja productos.
* Reactivar productos dados de baja.
* Gestionar información como nombre, imagen, categoría, precio y stock.

### 🛒 Carrito de compras

Los clientes pueden:

* Agregar productos al carrito.
* Modificar la cantidad de productos.
* Eliminar productos individualmente.
* Vaciar el carrito.
* Confirmar la compra.

### 🧾 Ventas y facturación

El sistema registra las compras realizadas y permite:

* Registrar la cabecera de una venta.
* Registrar el detalle de los productos vendidos.
* Consultar compras realizadas.
* Visualizar el detalle de las compras mediante facturas.

### 💬 Mensajes

Los usuarios pueden enviar mensajes al administrador, mientras que el administrador puede consultar los mensajes recibidos.

---

## 🛠️ Tecnologías utilizadas

| Tecnología          | Uso                                |
| ------------------- | ---------------------------------- |
| **PHP**             | Lenguaje de programación principal |
| **CodeIgniter 4**   | Framework de desarrollo web        |
| **MySQL**           | Sistema gestor de base de datos    |
| **HTML5**           | Estructura de las páginas          |
| **CSS3**            | Estilos y presentación             |
| **Bootstrap**       | Diseño y componentes de interfaz   |
| **Apache**          | Servidor web local                 |
| **XAMPP**           | Entorno de desarrollo local        |
| **MVC**             | Arquitectura del proyecto          |

---

## 🏗️ Arquitectura

El proyecto utiliza el patrón **MVC (Modelo-Vista-Controlador)** proporcionado por CodeIgniter 4.

```text
┌─────────────────┐
│      Vista      │
│ HTML + Bootstrap│
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│   Controlador   │
│   CodeIgniter   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│     Modelo      │
│  Acceso a datos │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│     MySQL       │
└─────────────────┘
```

Esta separación permite organizar la lógica de negocio, la presentación y el acceso a los datos en diferentes componentes.

---

## 📁 Estructura del repositorio

El repositorio está organizado de la siguiente manera:

```text
ecommerce-codeigniter/
│
├── bd-ecommerce-codeigniter4.sql
│  
│
└── ecommerce-model-codeigniter4/
    └── Aplicación web desarrollada con CodeIgniter 4
```

El archivo `bd-ecommerce-codeigniter4.sql` contiene el sql necesario para importar la base de datos.

La carpeta `ecommerce-model-codeigniter4` contiene el proyecto que debe copiarse dentro de la carpeta `htdocs` de XAMPP.

---

## ⚙️ Requisitos

Para ejecutar el proyecto localmente se necesita:

* **XAMPP**
* **Apache**
* **MySQL**
* Navegador web moderno
* Extensión `intl` de PHP habilitada

---

## 🚀 Instalación y ejecución

### 1. Instalar XAMPP

Descargar e instalar XAMPP en el equipo.

Una vez instalado, iniciar los servicios:

* **Apache**
* **MySQL**

### 2. Copiar el proyecto

Copiar la carpeta:

```text
ecommerce-model-codeigniter4
```

dentro de:

```text
C:\xampp\htdocs\
```

La estructura debería quedar aproximadamente así:

```text
C:\xampp\htdocs\ecommerce-model-codeigniter4\
```

### 3. Importar la base de datos

Abrir **phpMyAdmin** desde:

```text
http://localhost/phpmyadmin
```

Crear/importar la base de datos utilizando el archivo incluido en:

```text
bd-ecommerce-codeigniter4
```

### 4. Habilitar la extensión `intl`

Abrir el archivo:

```text
C:\xampp\php\php.ini
```

Buscar:

```ini
;extension=intl
```

y eliminar el `;` para dejarlo como:

```ini
extension=intl
```

Guardar los cambios y reiniciar Apache.

Este paso es necesario para que CodeIgniter 4 pueda ejecutarse correctamente.

### 5. Acceder a la aplicación

Con Apache y MySQL ejecutándose, abrir el navegador y acceder a:

```text
http://localhost/ecommerce-model-codeigniter4/
```

---

## 🔐 Usuario administrador

El proyecto incluye un usuario administrador para acceder a las funcionalidades de gestión.

```text
Usuario:     Admin
Contraseña:  admin
```

> ⚠️ Estas credenciales corresponden al entorno académico original del proyecto y no deberían utilizarse en un entorno de producción.

---

## 🗃️ Base de datos

La aplicación utiliza una base de datos relacional para almacenar, entre otros elementos:

* Usuarios.
* Productos.
* Categorías.
* Mensajes.
* Ventas.
* Detalles de ventas.

Las compras se registran mediante una estructura de **cabecera y detalle**, permitiendo asociar cada venta con los productos adquiridos.

---

## 🎯 Objetivo del proyecto

El proyecto tuvo como objetivo desarrollar una aplicación web de comercio electrónico que permitiera poner en práctica conceptos relacionados con:

* Desarrollo web con PHP.
* Framework CodeIgniter 4.
* Arquitectura MVC.
* Diseño de interfaces web.
* Integración con bases de datos relacionales.
* Operaciones CRUD.
* Gestión de usuarios y roles.
* Gestión de productos y stock.
* Carrito de compras.
* Registro y consulta de ventas.

---

## 🚧 Limitaciones

Al tratarse de un proyecto académico, presenta algunas limitaciones respecto de una plataforma de comercio electrónico de producción:

* No cuenta con una pasarela de pagos online.
* Está pensado para ejecutarse en un entorno local mediante XAMPP.
* Las credenciales de demostración son básicas.
* No está orientado actualmente a un entorno productivo.
* Algunas características podrían requerir actualización para utilizar versiones modernas de PHP, CodeIgniter y las dependencias asociadas.

---

## 🔮 Posibles mejoras

Entre las mejoras que podrían incorporarse se encuentran:

* Integración con una pasarela de pagos.
* Recuperación de contraseña mediante correo electrónico.
* Modernización de la interfaz.
* Mejora de los filtros y búsqueda de productos.
* Implementación de medidas de seguridad adicionales.
* Adaptación a versiones actuales de las tecnologías utilizadas.
* Despliegue en un servidor web.
