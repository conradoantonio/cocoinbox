/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.21-MariaDB : Database - cocoinbox
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cocoinbox` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cocoinbox`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`categoria`,`created_at`,`updated_at`) values (1,'Proteina','2017-10-23 15:36:17','2017-09-29 20:16:21'),(2,'Carbohidratos','2017-10-23 15:36:21','2017-09-29 20:16:44'),(3,'Ensaladas','2017-10-23 15:36:24','2017-09-29 20:16:36'),(4,'Bebidas','2017-10-23 15:36:25','0000-00-00 00:00:00');

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `estado` */

insert  into `estado`(`id`,`nombreEstado`,`created_at`,`updated_at`) values (1,'Aguascalientes','2017-02-04 18:45:43','2017-02-04 18:49:42'),(2,'Baja California',NULL,'2017-02-02 10:49:34'),(3,'Baja California Sur',NULL,NULL),(4,'Campeche',NULL,'2017-01-25 23:32:12'),(5,'Chiapas',NULL,NULL),(6,'Chihuahua',NULL,NULL),(7,'Coahuila',NULL,NULL),(8,'Colima',NULL,NULL),(9,'Distrito Federal',NULL,NULL),(10,'Durango',NULL,NULL),(11,'Estado de México',NULL,NULL),(12,'Guanajuato',NULL,NULL),(13,'Guerrero',NULL,'2017-01-25 23:32:35'),(14,'Hidalgo',NULL,NULL),(15,'Jalisco',NULL,'2017-01-25 23:32:31'),(16,'Michoacán',NULL,NULL),(17,'Morelos',NULL,NULL),(18,'Nayarit',NULL,NULL),(19,'Nuevo León',NULL,NULL),(20,'Oaxaca',NULL,NULL),(21,'Puebla',NULL,NULL),(22,'Querétaro',NULL,NULL),(23,'Quintana Roo',NULL,NULL),(24,'San Luis Potosí',NULL,NULL),(25,'Sinaloa',NULL,'2017-01-25 23:33:35'),(26,'Sonora',NULL,NULL),(27,'Tabasco',NULL,NULL),(28,'Tamaulipas',NULL,'2017-01-25 23:32:56'),(29,'Tlaxcala',NULL,NULL),(30,'Veracruz',NULL,NULL),(31,'Yucatán',NULL,NULL),(32,'Zacatecas',NULL,'2017-01-25 23:32:45');

/*Table structure for table `favoritos_detalles` */

DROP TABLE IF EXISTS `favoritos_detalles`;

CREATE TABLE `favoritos_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_favorito_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `porciones_adicionales` int(11) DEFAULT NULL,
  `medida_bebida` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `favoritos_detalles` */

insert  into `favoritos_detalles`(`id`,`pedido_favorito_id`,`producto_id`,`cantidad`,`porciones_adicionales`,`medida_bebida`) values (1,1,1,2,2,'Chico'),(2,1,4,2,0,'Chico');

/*Table structure for table `genero` */

DROP TABLE IF EXISTS `genero`;

CREATE TABLE `genero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreGenero` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `genero` */

insert  into `genero`(`id`,`nombreGenero`,`status`,`created_at`,`updated_at`) values (1,'Femenino',1,'2017-01-23 17:13:32','2017-01-23 17:13:30'),(2,'Masculino',1,'2017-01-23 17:13:35','2017-01-23 17:13:33');

/*Table structure for table `horarios` */

DROP TABLE IF EXISTS `horarios`;

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `horarios` */

insert  into `horarios`(`id`,`hora_inicio`,`hora_fin`,`dia`,`status`,`created_at`,`updated_at`) values (1,'10:00:00','23:00:00',0,1,'2017-11-16 16:02:48','0000-00-00 00:00:00'),(2,'08:00:00','20:00:00',1,0,'2017-11-16 16:04:28','0000-00-00 00:00:00'),(3,'07:00:00','20:00:00',2,0,'2017-11-16 16:12:13','2017-11-16 22:12:13'),(4,'08:00:00','20:00:00',3,0,'2017-11-16 16:09:16','0000-00-00 00:00:00'),(5,'08:00:00','20:00:00',4,1,'2017-11-16 16:09:16','0000-00-00 00:00:00'),(6,'08:00:00','20:00:00',5,0,'2017-11-16 16:09:18','0000-00-00 00:00:00'),(7,'09:00:00','22:00:00',6,1,'2017-11-16 16:09:19','0000-00-00 00:00:00');

/*Table structure for table `informacion_empresa` */

DROP TABLE IF EXISTS `informacion_empresa`;

CREATE TABLE `informacion_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text,
  `telefono` varchar(18) DEFAULT NULL,
  `numeroExt` varchar(20) DEFAULT NULL,
  `numeroInt` varchar(20) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `informacion_empresa` */

insert  into `informacion_empresa`(`id`,`direccion`,`telefono`,`numeroExt`,`numeroInt`,`codigo_postal`,`logo`,`empresa_id`) values (1,'Paseo del Hospicio','33-1184-0068','22','2044','44360','img/logo_empresa/1497635068.jpg',1);

/*Table structure for table `pedido_favoritos` */

DROP TABLE IF EXISTS `pedido_favoritos`;

CREATE TABLE `pedido_favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pedido_favoritos` */

insert  into `pedido_favoritos`(`id`,`servicio_id`,`usuario_id`) values (1,1,1);

/*Table structure for table `preguntas_frecuentes` */

DROP TABLE IF EXISTS `preguntas_frecuentes`;

CREATE TABLE `preguntas_frecuentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pregunta_id` int(11) NOT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `respuesta` text NOT NULL,
  `imagen` varchar(100) DEFAULT 'img/preguntas/default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `preguntas_frecuentes` */

insert  into `preguntas_frecuentes`(`id`,`tipo_pregunta_id`,`pregunta`,`respuesta`,`imagen`,`created_at`,`updated_at`) values (1,1,'¿La aplicación está disponible para android y ios?','Claro, la aplicación está disponible para ser instalada en cualquiera de las dos plataformas.','img/default.jpg',NULL,NULL),(2,2,'¿Cuánto tiempo tardan en aprobar mi usuario para usar la aplicación?','Nos tardamos hasta 48 horas máximo en revisar tu solicitud y aprobar tu usuario en la aplicación.','img/default.jpg',NULL,NULL),(3,3,'¿Que pasa si me tarjeta no cuenta con el saldo suficiente?','Si tu tarjeta no cuenta con el saldo suficiente para realizar la compra, se lanzara un mensaje con la leyenda de: el crédito de esta cuenta ha sido alcanzado.','img/default.jpg',NULL,'2017-11-02 22:27:36'),(4,4,'¿Que hacer cuando tu tarjeta no ha podido ser verificada?','Cuando tu tarjeta no puede ser verificada aparece un mensaje que dice: ¡Cuidado! Datos del cliente incorrectos: El token no existe.\r\n\r\nEste problema se puede presentar cuando nuestra conexión a internet no es tan buena, ya sea por medio de wifi o datos.\r\n\r\nPara corregir esto es muy importante corroborar que estemos con una buena conexión a internet y posterior a esto hay que pulsar nuevamente en la tarjeta con la cual vamos a realizar la compra y dar comprar.\r\n','img/default.jpg',NULL,NULL),(5,5,'¿Cuando saber si se realizo mi cobro? ','Cuando tu compra se realizo correctamente deberá aparecer un mensaje que diga: ¡Gracias por tu pago! En la opción de pedidos, puede visualizarse sus compras. \r\n\r\n','img/default.jpg',NULL,NULL);

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `foto_producto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `categoria_id` int(11) DEFAULT '0',
  `gramos_base` varchar(50) DEFAULT NULL,
  `precio_porcion` decimal(10,2) DEFAULT NULL,
  `cantidad_porcion` varchar(100) DEFAULT NULL,
  `precio_chico` decimal(10,2) DEFAULT NULL,
  `precio_grande` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre`,`precio`,`foto_producto`,`descripcion`,`categoria_id`,`gramos_base`,`precio_porcion`,`cantidad_porcion`,`precio_chico`,`precio_grande`,`status`,`created_at`,`updated_at`) values (1,'Pozole','89.00','img/productos/carbohidratos1.jpg','Rico pozole tradicional de México, el plato incluye 500gr.',2,'400','20.00','100',NULL,NULL,1,'2017-11-17 10:49:38','2017-11-17 16:49:38'),(2,'Ensalada de patatas','90.00','img/productos/ensaladaverde.jpg','Rica ensalada que incluye lechuga, tomate, patata y un rico queso parmezano. El plato incluye 400gr.',3,'500','15.00','125',NULL,NULL,1,'2017-11-17 10:40:06','2017-10-27 22:18:11'),(3,'Corte de arrachera con camarones cocidos.','300.00','img/productos/proteina1.png','Delicioso corte de carne de arrachera acompañado de camarones cocidos y verduras. El plato incluye 500gr.',1,'375','50.00','50',NULL,NULL,1,'2017-11-17 10:40:10','2017-10-27 22:20:41'),(4,'Mezcal',NULL,'img/productos/bebida1.jpg','Exquisita bebida elaborada a partir de la destilación del corazón del maguey.',4,NULL,NULL,NULL,'45.00','55.00',1,'2017-11-17 10:52:08','2017-11-17 16:52:08');

/*Table structure for table `registro_logs` */

DROP TABLE IF EXISTS `registro_logs`;

CREATE TABLE `registro_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fechaLogin` date DEFAULT NULL,
  `realTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `registro_logs` */

insert  into `registro_logs`(`id`,`user_id`,`fechaLogin`,`realTime`) values (1,2,'2017-09-20',NULL),(2,2,'2017-09-20','2017-09-20 12:49:48'),(3,2,'2017-09-21','2017-09-21 16:21:45'),(4,2,'2017-09-21','2017-09-21 16:44:27'),(5,3,'2017-09-21',NULL),(6,2,'2017-09-21','2017-09-21 16:57:53'),(7,2,'2017-09-24','2017-09-24 14:28:00'),(8,2,'2017-09-25','2017-09-25 10:17:12'),(9,2,'2017-09-25','2017-09-25 10:36:02'),(10,1,'2017-09-25','2017-09-25 10:50:26'),(11,2,'2017-09-25','2017-09-25 15:30:48'),(12,2,'2017-09-25','2017-09-25 15:43:12'),(13,2,'2017-09-26','2017-09-26 10:35:55'),(14,2,'2017-09-26','2017-09-26 12:26:54'),(15,2,'2017-09-26','2017-09-26 17:38:38'),(16,2,'2017-09-27','2017-09-27 11:43:05'),(17,2,'2017-09-27','2017-09-27 16:25:49'),(18,2,'2017-09-27','2017-09-27 16:43:07'),(19,2,'2017-09-27','2017-09-27 17:49:37'),(20,2,'2017-09-27','2017-09-27 18:16:37'),(21,2,'2017-09-27','2017-09-27 22:29:12'),(22,4,'2017-09-28','2017-09-28 10:32:23'),(23,2,'2017-09-28','2017-09-28 11:11:39'),(24,4,'2017-09-28','2017-09-28 11:12:37'),(25,1,'2017-10-17','2017-10-17 16:10:10'),(26,1,'2017-10-17','2017-10-17 16:11:10'),(27,1,'2017-10-17','2017-10-17 16:12:36'),(28,1,'2017-10-23','2017-10-23 18:15:24'),(29,1,'2017-10-23','2017-10-23 18:18:51'),(30,2,'2017-10-24','2017-10-24 17:14:41'),(31,4,'2017-10-24','2017-10-24 17:27:07'),(32,1,'2017-10-24','2017-10-24 17:40:40'),(33,1,'2017-10-25','2017-10-25 11:58:47');

/*Table structure for table `repartidores` */

DROP TABLE IF EXISTS `repartidores`;

CREATE TABLE `repartidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `comprobante_domicilio` varchar(100) DEFAULT NULL,
  `licencia` varchar(100) DEFAULT NULL,
  `solicitud_trabajo` varchar(100) DEFAULT NULL,
  `credencial_elector` varchar(100) DEFAULT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `repartidores` */

insert  into `repartidores`(`id`,`usuario_id`,`comprobante_domicilio`,`licencia`,`solicitud_trabajo`,`credencial_elector`,`latitud`,`longitud`,`created_at`,`updated_at`) values (1,2,'img/repartidores/comprobante_domicilio/2/1512166169.jpg','img/repartidores/licencia/2/1512166169.jpg','img/repartidores/solicitud_trabajo/2/1512166169.jpg','img/repartidores/credencial_elector/2/1512166169.png','20.667601','-103.398731','2017-12-01 16:09:29','2017-12-01 16:09:29'),(2,3,'img/repartidores/comprobante_domicilio/3/1512166200.jpg','img/repartidores/licencia/3/1512424627.pdf','img/repartidores/solicitud_trabajo/3/1512166200.jpg','img/repartidores/credencial_elector/3/1512166200.jpg','20.666392231','-103.392815432','2017-12-04 15:57:07','2017-12-04 15:57:07');

/*Table structure for table `servicio_detalles` */

DROP TABLE IF EXISTS `servicio_detalles`;

CREATE TABLE `servicio_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `foto_producto` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `gramos_base` varchar(80) DEFAULT NULL,
  `porciones_adicionales` varchar(100) DEFAULT NULL,
  `precio_porcion` decimal(10,2) DEFAULT NULL,
  `peso_porcion` varchar(100) DEFAULT NULL,
  `drink` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `servicio_detalles` */

insert  into `servicio_detalles`(`id`,`servicio_id`,`producto_id`,`categoria_id`,`nombre_producto`,`foto_producto`,`precio`,`cantidad`,`gramos_base`,`porciones_adicionales`,`precio_porcion`,`peso_porcion`,`drink`,`created_at`,`updated_at`) values (1,1,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00',NULL,0,'2017-10-30 15:41:00','2017-10-30 15:41:00'),(2,1,4,4,'Mezcal (Chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-10-30 15:41:00','2017-10-30 15:41:00'),(3,2,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00',NULL,0,'2017-10-30 15:41:13','2017-10-30 15:41:13'),(4,2,4,4,'Mezcal (Chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-10-30 15:41:13','2017-10-30 15:41:13'),(5,3,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00',NULL,0,'2017-10-31 10:59:09','2017-10-31 10:59:09'),(6,3,4,4,'Mezcal (Chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-10-31 10:59:09','2017-10-31 10:59:09'),(7,4,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00','100',0,'2017-11-14 12:23:09','2017-11-14 12:23:09'),(8,4,4,4,'Mezcal (Chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-11-14 12:23:09','2017-11-14 12:23:09'),(9,5,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00','100',0,'2017-11-15 16:37:12','2017-11-15 16:37:12'),(10,5,4,4,'Mezcal (chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-11-15 16:37:12','2017-11-15 16:37:12'),(11,6,1,2,'Pozole','img/productos/carbohidratos1.jpg','8900.00',2,NULL,'2','20.00','100',0,'2017-11-15 16:55:51','2017-11-15 16:55:51'),(12,6,4,4,'Mezcal (chico)','img/productos/bebida1.jpg','4500.00',2,NULL,'',NULL,NULL,1,'2017-11-15 16:55:52','2017-11-15 16:55:52');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `conekta_order_id` varchar(255) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` text,
  `colonia` text,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(5) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `latitud` varchar(30) DEFAULT NULL,
  `longitud` varchar(30) DEFAULT NULL,
  `comentarios` text,
  `repartidor_id` int(11) DEFAULT '0',
  `status` varchar(20) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '0',
  `notificado` tinyint(4) DEFAULT '0',
  `tipo_pago` varchar(10) DEFAULT NULL,
  `is_finished` tinyint(4) DEFAULT '0',
  `puntuacion` int(11) DEFAULT NULL,
  `codigo_liberacion` varchar(10) DEFAULT NULL,
  `last_digits` varchar(10) DEFAULT NULL,
  `datetime_formated` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

insert  into `servicios`(`id`,`usuario_id`,`nombre_cliente`,`correo_cliente`,`conekta_order_id`,`customer_id_conekta`,`costo_total`,`telefono`,`recibidor`,`calle`,`colonia`,`num_ext`,`num_int`,`ciudad`,`estado`,`pais`,`codigo_postal`,`latitud`,`longitud`,`comentarios`,`repartidor_id`,`status`,`activo`,`notificado`,`tipo_pago`,`is_finished`,`puntuacion`,`codigo_liberacion`,`last_digits`,`datetime_formated`,`created_at`,`updated_at`) values (1,1,'Conrado','anton_con@hotmail.com',NULL,NULL,34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,'Le quitan la cebolla al pozole por favor.',2,'pending_payment',1,NULL,'efectivo',0,NULL,'TJ7IRHCJ',NULL,NULL,'2017-10-30 15:41:00','2017-11-02 00:09:04'),(2,1,'Conrado','anton_con@hotmail.com','ord_2hUGBQehMzbBQcomF','cus_2hUD9SwS135vWZXJw',34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,'Le quitan la cebolla al pozole por favor.',2,'paid',0,NULL,'tarjeta',1,NULL,'PUR4QKWR','4242',NULL,'2017-10-30 15:41:02','2017-10-31 15:56:17'),(3,1,'Conrado','anton_con@hotmail.com','ord_2hUXRjZ6WZgWAJveC','cus_2hUD9SwS135vWZXJw',34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,'Le quitan la cebolla al pozole por favor.',2,'paid',0,NULL,'tarjeta',0,NULL,'LTV7RY6P','4242',NULL,'2017-10-31 10:58:58','2017-11-01 18:19:01'),(4,1,'Conrado','anton_con@hotmail.com',NULL,NULL,34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,NULL,0,'pending_payment',0,NULL,'efectivo',0,NULL,'HTWHJERB',NULL,'Viernes 13 de Octubre, 11:30 Hrs','2017-11-14 12:23:09','2017-11-14 12:23:10'),(5,1,'Conrado','anton_con@hotmail.com',NULL,NULL,34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,NULL,0,'pending_payment',0,NULL,'efectivo',0,NULL,'HFI5SW5F',NULL,'Viernes 13 de Octubre, 11:30 Hrs','2017-11-15 16:37:11','2017-11-15 16:37:12'),(6,1,'Conrado','anton_con@hotmail.com',NULL,NULL,34800,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Eqa do queiros','5125','16','Zapopan','Jalisco','MX','45110',NULL,NULL,NULL,0,'pending_payment',0,NULL,'efectivo',0,NULL,'QGLGIXHM',NULL,'Viernes 13 de Octubre, 11:30 Hrs','2017-11-15 16:55:51','2017-11-15 16:55:52');

/*Table structure for table `tipo_pregunta` */

DROP TABLE IF EXISTS `tipo_pregunta`;

CREATE TABLE `tipo_pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_pregunta` */

insert  into `tipo_pregunta`(`id`,`tipo`) values (1,'REVISIÓN DE TARIFAS'),(2,'OPCIONES DE CUENTA'),(3,'ACCESIBILIDAD'),(4,'MÉTODOS DE PAGO'),(5,'REPORTAR UN PROBLEMA');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_usuario` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'conrado.carrillo','$2y$10$hPxSH9GAcKTrI1zqP.beROrfWbsYCoFH7bODs5nZ5XYvL6dX5yTQW','anton_con@hotmail.com','img/user_perfil/default.jpg','R2TtTyXzC5BzRn0pzFdjaRduovALThn2LMbwQsUaTMC8OkHZkAg0rVwqVymu',1,'2017-03-23 11:30:45','2017-10-27 16:11:04'),(5,'admin.cocoinbox','$2y$10$WKY9J1RDcn9/5Va9C9QDWOHCbfWSdXYTAf6akZgQFhJEBfmVh8eL6','admin@cocoinbox.coom','img/user_perfil/default.jpg',NULL,1,'2017-10-24 18:23:27','2017-10-24 18:23:27');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto_perfil` varchar(100) DEFAULT 'http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg',
  `celular` varchar(18) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT '1',
  `red_social` tinyint(4) DEFAULT NULL,
  `player_id` varchar(155) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`password`,`nombre`,`apellido`,`correo`,`foto_perfil`,`celular`,`customer_id_conekta`,`tipo`,`red_social`,`player_id`,`status`,`created_at`,`updated_at`) values (1,'a83f0f76c2afad4f5d7260824430b798','Conrado Antonio','Carrillo Rosales','anton_con@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','9801010','cus_2hUD9SwS135vWZXJw',1,NULL,'76ece62b-bcfe-468c-8a78-839aeaa8c5fa',1,'2017-10-24 22:40:39','2017-11-14 16:29:18'),(2,'a83f0f76c2afad4f5d7260824430b798','Manuel','Rosales','many@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6699333627',NULL,2,NULL,NULL,1,'2017-10-25 13:12:13','2017-11-02 12:17:08'),(3,'a83f0f76c2afad4f5d7260824430b798','Arturo','López','artulo@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','95345645',NULL,2,NULL,NULL,1,'2017-11-22 16:47:35','2017-11-22 16:47:35');

/*Table structure for table `usuario_direcciones` */

DROP TABLE IF EXISTS `usuario_direcciones`;

CREATE TABLE `usuario_direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `recibidor` varchar(255) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `colonia` varchar(80) DEFAULT NULL,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `pais` varchar(10) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `residencial` tinyint(4) DEFAULT NULL,
  `is_main` tinyint(4) DEFAULT NULL,
  `latitud` varchar(30) NOT NULL,
  `longitud` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario_direcciones` */

insert  into `usuario_direcciones`(`id`,`usuario_id`,`recibidor`,`calle`,`colonia`,`num_ext`,`num_int`,`estado`,`ciudad`,`pais`,`codigo_postal`,`residencial`,`is_main`,`latitud`,`longitud`,`created_at`,`updated_at`) values (1,1,'Conrado Antonio Carrillo Rosales','Salvador Madariaga','Jardines de universidad','5125','16','Jalisco','Zapopan','MX','45110',0,0,'','','2017-10-17 21:17:15','2017-10-17 21:17:24');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
