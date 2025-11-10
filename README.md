# Sistema de Gestión de Siniestros Viales  
**Autor:** Adriano Raffaulte  
**Profesor:** Miranda Christian

---
Incluye:
- Autenticación de usuarios (Administrador y Operador).  
- Operaciones CRUD sobre Personas, Siniestros y Detalles.  
- Dashboard con reportes y gráficos estadísticos.  
- Exportación de reportes a PDF.  

---

 Requisitos previos

Antes de iniciar el proyecto, asegurarse de tener instalado:

- [PHP 8.2 o superior](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- [MySQL o MariaDB](https://dev.mysql.com/downloads/workbench/)
- [Git](https://git-scm.com/)
---
### 1) Clonar el repositorio

git clone https://github.com/AdrianoRaffaulte/TP-FINAL-Siniestros-Raffaulte.git
cd TP-FINAL-Siniestros-Raffaulte

### 2) Importar la base de datos enviada por correo a workbench


--- El proyecto tiene 2 usuarios cargados por defecto (ya incluidos por defecto)
- USUARIO ADMINISTRADOR: usuario: admin, contraseña: 123
- USUARIO OPERADOR: usuario: operador, contraseña: 123

### 3) Correr el programa: Symfony server:start

---

### 4) Funcionalidades principales
 ### Personas

Registrar, editar y eliminar personas.

Consultar listado general.

 ### Siniestros

Registrar nuevos siniestros con fecha, hora, clima y observaciones.

Consultar listado de siniestros registrados.

 ### Detalles de siniestros

Asociar personas a siniestros con un rol determinado (autor, víctima, testigo).

Ver todas las relaciones existentes.

 Dashboard

Visualizar gráficos estadísticos de los siniestros.

Exportar los reportes en formato PDF.





