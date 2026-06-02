Proyecto Intermodular DAW - Sistema Bancario Corporativo
Descripción

Este proyecto consiste en una aplicación web desarrollada como proyecto intermodular de primer curso del ciclo de Desarrollo de Aplicaciones Web (DAW).

La aplicación simula el funcionamiento de un entorno corporativo orientado al sector bancario, permitiendo gestionar usuarios, operaciones y distintos niveles de acceso mediante roles.

El objetivo principal ha sido aplicar de forma práctica los conocimientos adquiridos durante el curso en las asignaturas de Programación, Bases de Datos, Entornos de Desarrollo y Lenguajes de Marcas.

Funcionalidades principales
Página principal
Presentación de la entidad.
Información corporativa.
Imágenes almacenadas en base de datos.
Sistema de autenticación
Inicio de sesión mediante identificador y contraseña.
Gestión de sesiones.
Redirección automática según el rol del usuario.
Gestión de roles

El sistema dispone de tres perfiles:

Director
Administrador
Cliente
Dashboard interno

Zona privada para usuarios internos de la organización.

Gestión de operaciones

Permite:

Consultar operaciones.
Crear nuevas operaciones.
Eliminar operaciones.

Los permisos dependen del rol del usuario.

Gestión de usuarios

Permite:

Visualizar usuarios registrados.
Consultar roles asignados.
Crear nuevos usuarios.
Eliminar usuarios.
Zona clientes

Los clientes disponen de una zona privada donde pueden:

Consultar su historial de operaciones.
Acceder a información de contacto.
Atención al cliente

Sección destinada a mostrar:

Teléfono de contacto.
Correo electrónico.
Horario de atención.
Tecnologías utilizadas
HTML5
CSS3
PHP
MySQL
phpMyAdmin
Visual Studio Code
Base de datos

La aplicación utiliza una base de datos MySQL formada por las siguientes tablas:

roles

Almacena los diferentes perfiles del sistema.

usuarios

Contiene los datos de acceso e información básica de los usuarios.

operaciones

Registra las operaciones realizadas dentro del sistema.

fotos

Almacena imágenes utilizadas en la aplicación.

Control de acceso

La aplicación implementa un sistema de permisos basado en roles.

Director
Acceso al dashboard.
Gestión de usuarios.
Gestión de operaciones.
Administrador
Acceso al dashboard.
Consulta de operaciones.
Cliente
Acceso a la zona privada de clientes.
Consulta de historial.
Información de contacto.
Instalación
Clonar o descargar el proyecto.
Copiar la carpeta en el directorio de XAMPP:
htdocs/
Crear la base de datos en MySQL.
Importar las tablas necesarias.
Configurar la conexión en:
config/db.php
Iniciar Apache y MySQL desde XAMPP.
Acceder al proyecto desde:
http://localhost/nombre_proyecto/public
Mejoras futuras
Cifrado de contraseñas mediante hash.
Edición de usuarios.
Edición de operaciones.
Sistema de mensajería entre clientes y agentes.
Diseño responsive para dispositivos móviles.
Registro de auditoría de acciones realizadas por los usuarios.
Autor

Andrés Sánchez

Proyecto Intermodular DAW - Primer Curso
