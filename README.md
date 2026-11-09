# Catálogo de productos en PHP

## Descripción

Este proyecto consiste en una pequeña aplicación web desarrollada en PHP para gestionar y mostrar un catálogo de productos. Permite buscar artículos por nombre, filtrarlos por categoría, ordenarlos por precio y acceder a la vista detallada de cada producto.

Se ha desarrollado como ejercicio de aprendizaje para practicar conceptos básicos de programación web con PHP, formularios, tratamiento de datos y maquetación con HTML y Bootstrap.

## Objetivo

Crear una interfaz de catálogo de productos funcional y visualmente clara, con una estructura simple y reusable, siguiendo buenas prácticas básicas en PHP.

## Funcionalidades

- Visualización de productos en una página principal.
- Búsqueda por nombre de producto.
- Filtro por categoría.
- Ordenación por precio ascendente o descendente.
- Vista detallada de cada artículo.
- Cálculo del precio con IVA.
- Gestión de datos en memoria mediante arrays.
- Diseño responsive mediante Bootstrap 5.

## Tecnologías utilizadas

- PHP 8+
- HTML5
- CSS
- Bootstrap 5

## Estructura del proyecto

```text
dwes-catalogo-php/
├── catalogo/
│   ├── datos.php
│   ├── detalle.php
│   ├── funciones.php
│   └── index.php
├── README.md
└── .gitignore
```

### Archivos principales

- `catalogo/index.php`: página principal con el catálogo, buscador y filtros.
- `catalogo/detalle.php`: vista detallada de cada producto.
- `catalogo/datos.php`: conjunto de productos utilizados por la aplicación.
- `catalogo/funciones.php`: funciones auxiliares para sanitización, búsquedas, filtros y precios.

## Uso

### Página principal

En la vista inicial se pueden realizar las siguientes acciones:

- Buscar un producto por nombre.
- Filtrar por una categoría concreta.
- Ordenar los resultados por precio.
- Consultar el detalle de cualquier producto.

### Detalle del producto

La vista de detalle muestra información como:

- nombre del producto
- categoría
- descripción
- precio
- precio con IVA
- disponibilidad en stock

## Funciones implementadas

El proyecto incluye varias funciones para organizar la lógica de la aplicación, entre ellas:

- `e()`: escapado de cadenas para evitar problemas con HTML.
- `precio()`: formateo de valores numéricos como euros.
- `categorias()`: obtención de las categorías disponibles.
- `buscar()`: búsqueda de productos por nombre.
- `filtrarPorCategoria()`: filtrado por categoría.
- `ordenarPorPrecio()`: ordenación ascendente/descendente.
- `buscarPorId()`: búsqueda de un producto por su identificador.

## Notas

Este proyecto se ha desarrollado con fines educativos y de práctica en el desarrollo web con PHP. Los datos se mantienen en memoria dentro de `datos.php` y no se conectan a una base de datos.

## Autor

Manuel Hurtado Montllor

## Instrucciones para XAMPP

### Requisitos previos

- XAMPP con PHP 8 o superior.
- Navegador web moderno.

### Instalación y ejecución

1. Copia el proyecto dentro de la carpeta `htdocs` de XAMPP.
2. Inicia Apache desde el panel de control de XAMPP.
3. Abre el navegador y accede a la siguiente URL:

```text
http://localhost/dwes/dwes-catalogo-php/catalogo/index.php
```

Si la ruta del proyecto en tu equipo es distinta, adapta la URL según la ubicación exacta del proyecto.
