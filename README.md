# Sistema de Ventas

Este es un prototipo de software (MPA) para ventas usando tecnologia web, destinado
para un pequeño negocio que además quiera tener tener un control de stock.
Usando Windows 11, esta hecho en PHP 8.0.3 (emulando a Laravel), Javascript (usando la api fetch para consultas asincronas y la libreria JSPDF para la creación de documento), CSS y Bootstrap 5 para el modelado y Mysql como motor de base de datos.

Se instala en el propio equipo o en un servidor local. Se puede usar XAMPP, pero yo lo realice instalando las tecnologías de manera independiente (Apache, Mysql Y PHP).

Para el correcto uso, a traves de Apache en el archivo httpd-vhosts.conf crear un host virtual.
### Ejemplo:
![](https://github.com/yulito/blob/main/imagenes/vhost.png)

Y además debemos de agregar el nombre del host en el archivo hosts.

### Ejemplo:
![](https://github.com/yulito/blob/main/imagenes/host.png)

## Pasos:
### Ejecutar script de la base de datos en Mysql:
![](https://github.com/yulito/blob/main/imagenes/DB.png)

### Agregar tus credenciales en el archivo databases.php:
![](https://github.com/yulito/blob/main/imagenes/confdb.png)

### Abrir navegador (de preferencia Chrome) e ingresar las credenciales de usuario por defecto (usuario: administrador, contraseña: 1234):
![](https://github.com/yulito/blob/main/imagenes/login.png)

### Perfil administrador:
En este perfil podras cambiar la contraseña del usuario administrativo y además podras crear perfiles de usuario vendedor
que dispondra de un perfil diferente.
Dentro del perfil administrativo deberas, como primera configuración, agregar las comunas donde podras realizar despacho y la direccion de la sucursal del negocio. Luego de esto, podrás agregar y editar categorias, area, subcategoria y productos (Ojo aqui solo se agrega la descripción y no el stock, ya que el perfil encargado de ingresar el stock es el perfil vendedor), revisar mermas y ventas realizadas. 
También cuenta con la opción de Nivelar Stock. Este permitira editar el stock según el producto en caso de haber un desbalance de este o también se puede usar para agregar Stock de un producto en caso de no trabajar con Lotes. Eso si, el valor del Stock al ingresar en esta opción corresponde al nuevo valor total y no una suma de este con el stock existente, POR LO QUE MUCHO OJO.
![](https://github.com/yulito/blob/main/imagenes/admin.png)

### Perfil vendedor:

Este perfil tiene las opciones para realizar ventas, ingresar stock y mermas, agregar usuarios para el registro del despacho u factura y realizar consultas de los productos registrados.
![](https://github.com/yulito/blob/main/imagenes/vendedor.png)

## Nota final:
Este es el primer intendo de realizar un sistema de ventas, por lo que hay muchas cosas que se deben mejorar y otras que no funcionan de una manera muy optima. Pero de todas maneras es un software funcional.
