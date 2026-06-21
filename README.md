# Proyecto PWD - Sistema de Gestión de Usuarios

Este proyecto es una aplicación web desarrollada en PHP que implementa la arquitectura MVC (Modelo-Vista-Controlador). Está diseñado para ejecutarse de manera local sobre un entorno XAMPP, utilizando Apache como servidor web y MariaDB o MySQL como motor de base de datos.

## 📂 Estructura del Proyecto

A continuación se detalla la organización de los directorios y la función de cada capa dentro del sistema:

```bash
├── controller/                     # Capa control (logica & ABM)
│   ├── usuario/                    
│   │   ├── abmusuario.php          # ABM usuario (Alta, baja, Modificacion & Logica)
│   │   └── validadorusuario.php    # validador de los inputs (validador por el lado del servidor)    
├── model/                          # Capa modelo (ORM & Conector)
│   ├── conector/                   
│   │   └── dataBase.php            # Archivo para conectarse con la BD (XAMPP/MySQL)
│   ├── estructura/                 
│   │   └── infousuarios.sql        # Estructura de las tablas SQL
│   └── usuario.php                 # ORM de la tabla 'usuario'
├── utils/
│   └── funciones.php               # Funciones de uso global
├── view/                           # Capa vista (UX/UI)
│   ├── action/ 
│   │   ├── ejercicio2.php          # Enrutador para dar de alta un usuario
│   │   ├── ejercicio3.php          # Enrutador para dar de baja a un usuario
│   │   └── ejercicio4.php          # Enrutador para modificar un usuario
│   ├── assets/                     
│   │   ├── css/
│   │   ├── js/
│   │   │   ├── ejercicio2.js       # Validador del formulario altaUsuario (validador del cliente)
│   │   │   └── ejercicio4.js       # Validador del formulario modifUsuario (validador del cliente)
│   │   └── logo_unco.png 
│   ├── layouts/    
│   │   ├── footer.php              # footer 
│   │   └── header.php              # header (navbar & links)
│   ├── pages/    
│   │   ├── ejercicio1.php          # Ver todos los usuarios
│   │   ├── ejercicio2.php          # Formulario para dar de alta un usuario
│   │   ├── ejercicio4.php          # Formulario para modificar un usuario
│   │   └── home.php                # Inicio
├── .gitignore           
└── README.md            
```

## 🧠 Conceptos Clave del Sistema

### ¿Qué es un ORM?

ORM significa Object-Relational Mapping (Mapeo Objeto-Relacional). Es una técnica de programación que permite interactuar con una base de datos usando objetos del lenguaje (en este caso, PHP) en lugar de consultas SQL directas dispersas por el código.

### ¿Para qué sirve en este proyecto?

El archivo `model/usuario.php` actúa como ORM. Representa la tabla `usuario` de la base de datos y convierte cada columna —como `nroDni`, `nombre`, `apellido` y `telefono`— en atributos y métodos de una clase PHP. De esta manera, trabajar con usuarios se vuelve más simple y organizado: se instancia un objeto de la clase y se usa para enviar o recibir datos.

### ¿Qué es un ABM?

ABM significa Alta, Baja y Modificación. Es equivalente al concepto CRUD (Create, Read, Update, Delete) y define las operaciones principales para gestionar registros.

### ¿Para qué sirve en este proyecto?

El archivo `controller/usuario/abmusuario.php` centraliza las acciones que modifican la información:

- **Alta:** Inserta un nuevo usuario en la base de datos.
- **Baja:** Elimina un usuario existente.
- **Modificación:** Actualiza los datos de un usuario cargado.
- **Buscar:** Consulta y lista registros.

El ABM no valida los datos de entrada en sí mismo; esa responsabilidad recae en `controller/usuario/validadorusuario.php`. El ABM asume que los datos ya llegaron limpios y utiliza el ORM para operar con la base de datos de forma segura y eficiente.
