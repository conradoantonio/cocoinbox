/*
SQLyog Ultimate v9.63 
MySQL - 5.6.32-78.1 : Database - bsmxtech_cocoinbox
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bsmxtech_cocoinbox` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `bsmxtech_cocoinbox`;

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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

/*Data for the table `favoritos_detalles` */

insert  into `favoritos_detalles`(`id`,`pedido_favorito_id`,`producto_id`,`cantidad`,`porciones_adicionales`,`medida_bebida`) values (55,15,3,3,4,'Chico'),(56,15,1,4,1,'Chico'),(57,15,5,4,1,'Chico'),(58,15,4,2,0,'Chico'),(67,18,3,3,4,'Chico'),(68,18,1,4,1,'Chico'),(69,18,5,4,1,'Chico'),(70,18,4,2,0,'Chico'),(75,20,3,3,4,'Chico'),(76,20,1,4,1,'Chico'),(77,20,5,4,1,'Chico'),(78,20,4,2,0,'Chico'),(79,21,3,3,4,'Chico'),(80,21,1,4,1,'Chico'),(81,21,5,4,1,'Chico'),(82,21,4,2,0,'Chico'),(83,22,3,3,4,'Chico'),(84,22,1,4,1,'Chico'),(85,22,5,4,1,'Chico'),(86,22,4,2,0,'Chico'),(87,23,3,3,4,'Chico'),(88,23,1,4,1,'Chico'),(89,23,5,4,1,'Chico'),(90,23,4,2,0,'Chico'),(91,24,3,3,4,'Chico'),(92,24,1,4,1,'Chico'),(93,24,5,4,1,'Chico'),(94,24,4,2,0,'Chico'),(95,25,3,3,4,'Chico'),(96,25,1,4,1,'Chico'),(97,25,5,4,1,'Chico'),(98,25,4,2,0,'Chico'),(99,26,5,1,0,'Chico'),(100,27,3,3,4,'Chico'),(101,27,1,4,1,'Chico'),(102,27,5,4,1,'Chico'),(103,27,4,2,0,'Chico'),(104,28,3,3,4,'Chico'),(105,28,1,4,1,'Chico'),(106,28,5,4,1,'Chico'),(107,28,4,2,0,'Chico'),(111,2,6,1,0,'chico'),(130,15,19,1,0,'chico'),(134,18,26,2,1,'chico');

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

insert  into `horarios`(`id`,`hora_inicio`,`hora_fin`,`dia`,`status`,`created_at`,`updated_at`) values (1,'10:00:00','23:00:00',0,1,'2017-11-16 16:28:56','2017-11-16 23:28:56'),(2,'08:00:00','20:00:00',1,1,'2017-11-16 16:28:56','2017-11-16 23:28:56'),(3,'08:00:00','23:00:00',2,1,'2017-11-21 19:20:03','2017-11-22 02:20:03'),(4,'08:00:00','20:00:00',3,1,'2017-11-16 16:28:56','2017-11-16 23:28:56'),(5,'08:00:00','21:00:00',4,1,'2017-11-16 19:24:26','2017-11-17 02:24:26'),(6,'08:00:00','20:00:00',5,1,'2017-11-16 16:28:56','2017-11-16 23:28:56'),(7,'09:00:00','22:00:00',6,1,'2017-11-16 16:28:56','2017-11-16 23:28:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `pedido_favoritos` */

insert  into `pedido_favoritos`(`id`,`servicio_id`,`usuario_id`) values (2,12,10),(15,2,3),(18,6,19);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `preguntas_frecuentes` */

insert  into `preguntas_frecuentes`(`id`,`tipo_pregunta_id`,`pregunta`,`respuesta`,`imagen`,`created_at`,`updated_at`) values (1,1,'¿La aplicación está disponible para android y ios?','Claro, la aplicación está disponible para ser instalada en cualquiera de las dos plataformas.','img/default.jpg',NULL,NULL),(2,2,'¿Cuánto tiempo tardan en aprobar mi usuario para usar la aplicación?','Nos tardamos hasta 48 horas máximo en revisar tu solicitud y aprobar tu usuario en la aplicación.','img/default.jpg',NULL,NULL),(3,3,'¿Que pasa si me tarjeta no cuenta con el saldo suficiente?','Si tu tarjeta no cuenta con el saldo suficiente para realizar la compra, se lanzara un mensaje con la leyenda de: el crédito de esta cuenta ha sido alcanzado.','img/default.jpg',NULL,'2017-11-02 22:27:36'),(4,4,'¿Que hacer cuando tu tarjeta no ha podido ser verificada?','Cuando tu tarjeta no puede ser verificada aparece un mensaje que dice: ¡Cuidado! Datos del cliente incorrectos: El token no existe.\r\n\r\nEste problema se puede presentar cuando nuestra conexión a internet no es tan buena, ya sea por medio de wifi o datos.\r\n\r\nPara corregir esto es muy importante corroborar que estemos con una buena conexión a internet y posterior a esto hay que pulsar nuevamente en la tarjeta con la cual vamos a realizar la compra y dar comprar.\r\n','img/default.jpg',NULL,NULL),(5,5,'¿Cuando saber si se realizo mi cobro? ','Cuando tu compra se realizo correctamente deberá aparecer un mensaje que diga: ¡Gracias por tu pago! En la opción de pedidos, puede visualizarse sus compras. \r\n\r\n','img/default.jpg',NULL,NULL),(6,4,'¿Cómo agregar nueva tarjeta de pago?','En el módulo mis pagos, podrás encontrar la opción para añadir o remover tus tarjetas.','img/preguntas/1510611878.jpg','2017-11-13 22:24:38','2017-11-14 00:06:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre`,`precio`,`foto_producto`,`descripcion`,`categoria_id`,`gramos_base`,`precio_porcion`,`cantidad_porcion`,`precio_chico`,`precio_grande`,`status`,`created_at`,`updated_at`) values (19,'chile rojo','30.00','img/productos/Ejemplo.jpg','Chile en salsa de chila pasilla\r\nkcal por porción 50',1,'250','9.00','50',NULL,NULL,1,'2017-11-20 17:22:03','2017-11-20 17:22:03'),(20,'chile en rajas','35.00','img/productos/Ejemplo2.jpg','kcal 1000',2,'150','10.00','50',NULL,NULL,1,'2017-11-20 17:30:42','2017-11-20 17:30:42'),(21,'chile relleno','20.00','img/productos/Ejemplo3.jpg','kcal 4000',3,'150','7.00','50',NULL,NULL,1,'2017-11-20 17:35:44','2017-11-20 17:35:44'),(22,'Jamaica',NULL,'img/productos/Screenshot_1.png','Agua de jamaica recién hecha.',4,NULL,NULL,NULL,'20.00','30.00',1,'2017-12-13 18:52:06','2017-12-13 18:52:06'),(23,'Arroz Blanco','20.00','img/productos/arroz-blanco.jpg','Se llama arroz blanco al arroz molido desprovisto de la gluma (cáscara), el salvado y el germen',2,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:20:24','2017-12-14 19:20:24'),(24,'Arroz Integral','20.00','img/productos/arroz-integral.jpg','El arroz integral es el arroz al que únicamente se le ha retirado la cáscara exterior, por lo que tiene más fibra, minerales y vitaminas que el arroz blanco, y por lo tanto, tiene más nutrientes beneficiosos para nosotros.',2,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:20:36','2017-12-14 19:20:36'),(25,'Carne al horno','30.00','img/productos/carne-al-horno.jpg','a porción a asar se utiliza en una sola pieza, y se suele untar con una capa de aceite de oliva o mantequilla, para que quede dorada, añadiendo algo de agua o caldo a la bandeja del horno para evitar que se reseque',1,'150','20.00','100',NULL,NULL,1,'2017-12-14 12:20:46','2017-12-14 19:20:46'),(26,'Carna Asada','30.00','img/productos/carne-asada.jpg','Corte de carne de res asado al carbón',1,'150','15.00','100',NULL,NULL,1,'2017-12-14 12:21:02','2017-12-14 19:21:02'),(27,'Ensalada Cesar','18.00','img/productos/ensalada-cesaer.jpg','La ensalada César es una ensalada de lechuga romana, trocitos de pan tostado aliñados',3,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:21:15','2017-12-14 19:21:15'),(28,'Ensalada de Verduras','18.00','img/productos/ensalada-de-verduras.jpg','as ensaladas de verduras le aportan a tu organismo grasas saludables. Este tipo de grasas son las que aumentan el colesterol bueno y eliminan el malo y por tanto, al igual que hace el aceite de oliva, son un alimento que ayuda a todo tu organismo y, en especial a tu corazón.',3,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:21:27','2017-12-14 19:21:27'),(29,'Ensalada Dulce','15.00','img/productos/ensalada-dulce.jpg','Es una receta tradicional con un toque casero, perfecta para acompañar el pavo, lomo de cerdo o el platillo que más te guste.',3,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:21:43','2017-12-14 19:21:43'),(30,'Ensalada Italiana','18.00','img/productos/ensalada-italiana.jpg','La ensalada caprese, o simplemente caprese, es una ensalada italiana (concretamente de Capri) compuesta de rodajas de tomate y de mozzarella fresca, y hojas de albahaca fresca, de la variedad \"hoja grande\" y \"superhoja\", regado con aceite de oliva.',3,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:22:02','2017-12-14 19:22:02'),(31,'Ensalada Verde','18.00','img/productos/ensalda-verde.jpg','Una ensalada es, en líneas generales, un plato frío con hortalizas mezcladas, cortadas en trozos y aderezadas, fundamentalmente con sal, jugo de limón, aceite de oliva y vinagre',3,'100','10.00','100',NULL,NULL,1,'2017-12-14 12:22:20','2017-12-14 19:22:20'),(32,'Frijoles','15.00','img/productos/frijoles.jpg','El frijol, pertenece a la familia de las leguminosas o Fabaceae, de la que provienen plantas comestibles',2,'100','10.00','100',NULL,NULL,1,'2017-12-14 19:00:42','2017-12-14 19:00:42'),(33,'Horchata',NULL,'img/productos/horchata.jpg','La horchata de arroz es una bebida refrescante tradicional de amplio consumo',4,NULL,NULL,NULL,'15.00','20.00',1,'2017-12-14 19:01:36','2017-12-14 19:01:36'),(34,'Limón con chía',NULL,'img/productos/limon-con-chia.jpg','Bebida con antioxidantes, refrescante, depurativa, deliciosa y muy útil para acelerar la pérdida de peso. ',4,NULL,NULL,NULL,'15.00','20.00',1,'2017-12-14 12:22:36','2017-12-14 19:22:36'),(35,'Naranjada',NULL,'img/productos/naranjada.jpg','La naranja es una fruta cítrica comestible obtenida del naranjo dulce ',4,NULL,NULL,NULL,'15.00','20.00',1,'2017-12-14 19:03:56','2017-12-14 19:03:56'),(36,'Pasta Blanca','20.00','img/productos/pasta-blanca.jpg','La pasta es un conjunto de alimentos preparados con una masa cuyo ingrediente básico es la harina',2,'100','15.00','100',NULL,NULL,1,'2017-12-14 12:22:57','2017-12-14 19:22:57'),(37,'Pescado','18.00','img/productos/pescado.jpg','Una dieta sana y equilibrada, que sea capaz de reportar efectos positivos sobre la salud, requiere gran variedad de alimentos entre los que debe estar presente el pescado.',1,'100','12.00','100',NULL,NULL,1,'2017-12-14 19:05:53','2017-12-14 19:05:53'),(38,'PIña',NULL,'img/productos/pina.jpg','El agua de piña natural también aporta muchas propiedades curativas',4,NULL,NULL,NULL,'15.00','20.00',1,'2017-12-14 12:15:06','2017-12-14 19:15:06'),(39,'Pollo a la plancha','20.00','img/productos/pollo-a-la-plabcha.jpg','El pollo es una de las carnes más versátiles. Su sabor neutro le permite combinar muy bien con casi cualquier acompañante',1,'100','15.00','100',NULL,NULL,1,'2017-12-14 12:23:15','2017-12-14 19:23:15'),(40,'Salmón ','28.00','img/productos/salmon.jpg','El salmón es un pescado gastronómicamente muy versátil, y además de su sabor delicado, posee un tipo de grasas muy beneficiosas para la salud',1,'100','25.00','100',NULL,NULL,1,'2017-12-14 19:08:58','2017-12-14 19:08:58'),(41,'Spaghetti','18.00','img/productos/spaghetti.jpg','El espagueti es un tipo de pasta italiana elaborada con harina y agua.',2,'100','10.00','100',NULL,NULL,1,'2017-12-14 19:09:49','2017-12-14 19:09:49');

/*Table structure for table `registro_logs` */

DROP TABLE IF EXISTS `registro_logs`;

CREATE TABLE `registro_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fechaLogin` date DEFAULT NULL,
  `realTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=latin1;

/*Data for the table `registro_logs` */

insert  into `registro_logs`(`id`,`user_id`,`fechaLogin`,`realTime`) values (1,2,'2017-09-20',NULL),(2,2,'2017-09-20','2017-09-20 12:49:48'),(3,2,'2017-09-21','2017-09-21 16:21:45'),(4,2,'2017-09-21','2017-09-21 16:44:27'),(5,3,'2017-09-21',NULL),(6,2,'2017-09-21','2017-09-21 16:57:53'),(7,2,'2017-09-24','2017-09-24 14:28:00'),(8,2,'2017-09-25','2017-09-25 10:17:12'),(9,2,'2017-09-25','2017-09-25 10:36:02'),(10,1,'2017-09-25','2017-09-25 10:50:26'),(11,2,'2017-09-25','2017-09-25 15:30:48'),(12,2,'2017-09-25','2017-09-25 15:43:12'),(13,2,'2017-09-26','2017-09-26 10:35:55'),(14,2,'2017-09-26','2017-09-26 12:26:54'),(15,2,'2017-09-26','2017-09-26 17:38:38'),(16,2,'2017-09-27','2017-09-27 11:43:05'),(17,2,'2017-09-27','2017-09-27 16:25:49'),(18,2,'2017-09-27','2017-09-27 16:43:07'),(19,2,'2017-09-27','2017-09-27 17:49:37'),(20,2,'2017-09-27','2017-09-27 18:16:37'),(21,2,'2017-09-27','2017-09-27 22:29:12'),(22,4,'2017-09-28','2017-09-28 10:32:23'),(23,2,'2017-09-28','2017-09-28 11:11:39'),(24,4,'2017-09-28','2017-09-28 11:12:37'),(25,1,'2017-10-17','2017-10-17 16:10:10'),(26,1,'2017-10-17','2017-10-17 16:11:10'),(27,1,'2017-10-17','2017-10-17 16:12:36'),(28,1,'2017-10-23','2017-10-23 18:15:24'),(29,1,'2017-10-23','2017-10-23 18:18:51'),(30,2,'2017-10-24','2017-10-24 17:14:41'),(31,4,'2017-10-24','2017-10-24 17:27:07'),(32,1,'2017-10-24','2017-10-24 17:40:40'),(33,1,'2017-10-25','2017-10-25 11:58:47'),(34,2,'2017-10-30','2017-10-30 13:17:08'),(35,2,'2017-11-01','2017-11-01 02:19:45'),(36,2,'2017-11-01','2017-11-01 02:21:45'),(37,2,'2017-11-01','2017-11-01 02:25:11'),(38,2,'2017-11-01','2017-11-01 10:46:57'),(39,2,'2017-11-01','2017-11-01 19:22:44'),(40,8,'2017-11-02','2017-11-02 11:40:42'),(41,8,'2017-11-02','2017-11-02 11:41:52'),(42,8,'2017-11-02','2017-11-02 11:52:15'),(43,2,'2017-11-02','2017-11-02 12:22:30'),(44,9,'2017-11-02','2017-11-02 14:09:53'),(45,10,'2017-11-02','2017-11-02 14:11:01'),(46,10,'2017-11-02','2017-11-02 14:11:15'),(47,11,'2017-11-02','2017-11-02 18:07:56'),(48,10,'2017-11-02','2017-11-02 18:10:43'),(49,12,'2017-11-02','2017-11-02 18:16:59'),(50,10,'2017-11-02','2017-11-02 18:19:35'),(51,10,'2017-11-02','2017-11-02 18:42:28'),(52,10,'2017-11-02','2017-11-02 21:33:57'),(53,13,'2017-11-02','2017-11-02 21:40:55'),(54,14,'2017-11-02','2017-11-02 21:48:20'),(55,15,'2017-11-02','2017-11-02 21:53:14'),(56,15,'2017-11-02','2017-11-02 21:53:40'),(57,15,'2017-11-02','2017-11-02 21:55:51'),(58,16,'2017-11-02','2017-11-02 22:01:21'),(59,8,'2017-11-03','2017-11-03 17:13:05'),(60,15,'2017-11-04','2017-11-04 17:34:50'),(61,10,'2017-11-05','2017-11-05 01:35:24'),(62,15,'2017-11-05','2017-11-05 17:34:36'),(63,15,'2017-11-05','2017-11-05 17:35:02'),(64,15,'2017-11-07','2017-11-07 16:48:42'),(65,15,'2017-11-07','2017-11-07 16:49:07'),(66,15,'2017-11-07','2017-11-07 17:28:04'),(67,15,'2017-11-07','2017-11-07 17:28:04'),(68,10,'2017-11-07','2017-11-07 20:02:53'),(69,10,'2017-11-07','2017-11-07 20:13:52'),(70,17,'2017-11-08','2017-11-08 11:08:00'),(71,17,'2017-11-08','2017-11-08 16:00:12'),(72,17,'2017-11-08','2017-11-08 16:00:50'),(73,8,'2017-11-08','2017-11-08 16:49:40'),(74,18,'2017-11-08','2017-11-08 16:54:51'),(75,18,'2017-11-08','2017-11-08 16:56:25'),(76,18,'2017-11-08','2017-11-08 16:56:25'),(77,18,'2017-11-08','2017-11-08 16:56:25'),(78,17,'2017-11-08','2017-11-08 17:01:42'),(79,17,'2017-11-08','2017-11-08 17:02:52'),(80,18,'2017-11-08','2017-11-08 17:02:52'),(81,17,'2017-11-08','2017-11-08 17:11:29'),(82,17,'2017-11-08','2017-11-08 17:11:32'),(83,17,'2017-11-08','2017-11-08 17:11:33'),(84,17,'2017-11-08','2017-11-08 17:11:55'),(85,17,'2017-11-08','2017-11-08 17:12:35'),(86,17,'2017-11-08','2017-11-08 17:13:40'),(87,17,'2017-11-08','2017-11-08 17:15:16'),(88,18,'2017-11-08','2017-11-08 17:16:18'),(89,17,'2017-11-08','2017-11-08 17:25:24'),(90,10,'2017-11-08','2017-11-08 17:51:17'),(91,10,'2017-11-08','2017-11-08 19:51:53'),(92,17,'2017-11-08','2017-11-08 22:33:14'),(93,17,'2017-11-08','2017-11-08 22:34:46'),(94,10,'2017-11-08','2017-11-08 22:59:14'),(95,10,'2017-11-08','2017-11-08 23:06:44'),(96,10,'2017-11-09','2017-11-09 00:20:26'),(97,10,'2017-11-09','2017-11-09 00:22:41'),(98,10,'2017-11-09','2017-11-09 00:23:43'),(99,10,'2017-11-09','2017-11-09 13:59:45'),(100,10,'2017-11-09','2017-11-09 20:18:59'),(101,10,'2017-11-09','2017-11-09 20:20:21'),(102,10,'2017-11-09','2017-11-09 22:50:15'),(103,10,'2017-11-09','2017-11-09 23:55:28'),(104,2,'2017-11-10','2017-11-10 00:37:08'),(105,2,'2017-11-10','2017-11-10 02:43:12'),(106,2,'2017-11-10','2017-11-10 02:43:36'),(107,2,'2017-11-10','2017-11-10 02:54:38'),(108,2,'2017-11-10','2017-11-10 08:40:54'),(109,2,'2017-11-10','2017-11-10 12:04:14'),(110,2,'2017-11-10','2017-11-10 16:00:15'),(111,18,'2017-11-10','2017-11-10 17:13:51'),(112,12,'2017-11-10','2017-11-10 22:57:50'),(113,19,'2017-11-10','2017-11-10 23:31:46'),(114,19,'2017-11-12','2017-11-12 12:03:29'),(115,19,'2017-11-12','2017-11-12 17:24:06'),(116,12,'2017-11-12','2017-11-12 18:02:23'),(117,12,'2017-11-12','2017-11-12 18:07:17'),(118,12,'2017-11-12','2017-11-12 18:23:56'),(119,12,'2017-11-12','2017-11-12 18:33:13'),(120,19,'2017-11-12','2017-11-12 18:38:35'),(121,19,'2017-11-12','2017-11-12 18:38:54'),(122,19,'2017-11-12','2017-11-12 18:41:35'),(123,12,'2017-11-12','2017-11-12 18:41:41'),(124,12,'2017-11-12','2017-11-12 18:41:49'),(125,12,'2017-11-12','2017-11-12 18:43:57'),(126,12,'2017-11-12','2017-11-12 18:44:09'),(127,12,'2017-11-12','2017-11-12 18:44:35'),(128,12,'2017-11-12','2017-11-12 18:44:41'),(129,12,'2017-11-12','2017-11-12 18:46:02'),(130,19,'2017-11-13','2017-11-13 09:30:09'),(131,17,'2017-11-13','2017-11-13 09:31:37'),(132,10,'2017-11-13','2017-11-13 09:53:52'),(133,17,'2017-11-13','2017-11-13 10:24:07'),(134,10,'2017-11-13','2017-11-13 10:26:43'),(135,10,'2017-11-13','2017-11-13 10:32:19'),(136,10,'2017-11-13','2017-11-13 10:34:55'),(137,10,'2017-11-13','2017-11-13 11:21:54'),(138,10,'2017-11-13','2017-11-13 11:25:46'),(139,10,'2017-11-13','2017-11-13 11:30:18'),(140,10,'2017-11-13','2017-11-13 14:22:07'),(141,19,'2017-11-13','2017-11-13 14:44:19'),(142,19,'2017-11-13','2017-11-13 14:48:21'),(143,21,'2017-11-13','2017-11-13 15:37:17'),(144,21,'2017-11-13','2017-11-13 15:37:53'),(145,2,'2017-11-13','2017-11-13 17:41:06'),(146,10,'2017-11-13','2017-11-13 17:45:43'),(147,10,'2017-11-13','2017-11-13 22:45:10'),(148,10,'2017-11-14','2017-11-14 02:16:03'),(149,10,'2017-11-14','2017-11-14 04:14:05'),(150,17,'2017-11-14','2017-11-14 04:24:27'),(151,17,'2017-11-14','2017-11-14 04:35:33'),(152,17,'2017-11-14','2017-11-14 04:45:16'),(153,17,'2017-11-14','2017-11-14 04:46:11'),(154,17,'2017-11-14','2017-11-14 08:52:50'),(155,17,'2017-11-14','2017-11-14 09:06:53'),(156,17,'2017-11-14','2017-11-14 09:10:48'),(157,19,'2017-11-14','2017-11-14 11:54:40'),(158,17,'2017-11-14','2017-11-14 12:09:28'),(159,19,'2017-11-14','2017-11-14 14:52:00'),(160,19,'2017-11-14','2017-11-14 15:01:29'),(161,10,'2017-11-14','2017-11-14 20:23:43'),(162,3,'2017-11-15','2017-11-15 12:10:06'),(163,3,'2017-11-15','2017-11-15 12:11:12'),(164,2,'2017-11-15','2017-11-15 14:39:26'),(165,3,'2017-11-15','2017-11-15 14:46:06'),(166,2,'2017-11-15','2017-11-15 15:26:33'),(167,2,'2017-11-15','2017-11-15 16:46:12'),(168,4,'2017-11-15','2017-11-15 20:49:29'),(169,5,'2017-11-15','2017-11-15 21:10:52'),(170,6,'2017-11-16','2017-11-16 11:32:19'),(171,7,'2017-11-16','2017-11-16 11:40:21'),(172,7,'2017-11-16','2017-11-16 11:40:34'),(173,7,'2017-11-16','2017-11-16 11:44:08'),(174,3,'2017-11-16','2017-11-16 11:55:49'),(175,3,'2017-11-16','2017-11-16 15:36:00'),(176,7,'2017-11-16','2017-11-16 15:52:39'),(177,3,'2017-11-16','2017-11-16 16:21:12'),(178,7,'2017-11-16','2017-11-16 16:21:49'),(179,6,'2017-11-16','2017-11-16 16:22:12'),(180,3,'2017-11-16','2017-11-16 16:22:34'),(181,2,'2017-11-16','2017-11-16 16:23:04'),(182,8,'2017-11-16','2017-11-16 16:23:52'),(183,7,'2017-11-16','2017-11-16 16:36:23'),(184,9,'2017-11-16','2017-11-16 16:57:03'),(185,8,'2017-11-16','2017-11-16 16:57:10'),(186,10,'2017-11-16','2017-11-16 17:01:36'),(187,2,'2017-11-16','2017-11-16 18:05:13'),(188,2,'2017-11-16','2017-11-16 18:26:58'),(189,7,'2017-11-16','2017-11-16 18:34:18'),(190,2,'2017-11-16','2017-11-16 18:38:53'),(191,2,'2017-11-16','2017-11-16 18:40:35'),(192,2,'2017-11-16','2017-11-16 18:42:21'),(193,2,'2017-11-16','2017-11-16 18:44:51'),(194,3,'2017-11-16','2017-11-16 18:56:13'),(195,11,'2017-11-16','2017-11-16 18:58:16'),(196,3,'2017-11-16','2017-11-16 19:02:18'),(197,3,'2017-11-16','2017-11-16 19:23:52'),(198,8,'2017-11-16','2017-11-16 19:26:14'),(199,12,'2017-11-16','2017-11-16 19:29:58'),(200,13,'2017-11-16','2017-11-16 19:32:23'),(201,7,'2017-11-16','2017-11-16 19:56:49'),(202,6,'2017-11-16','2017-11-16 19:56:59'),(203,3,'2017-11-17','2017-11-17 09:11:55'),(204,2,'2017-11-17','2017-11-17 10:37:22'),(205,3,'2017-11-17','2017-11-17 10:40:32'),(206,3,'2017-11-17','2017-11-17 12:59:58'),(207,3,'2017-11-17','2017-11-17 13:55:42'),(208,3,'2017-11-17','2017-11-17 15:26:39'),(209,3,'2017-11-17','2017-11-17 15:55:25'),(210,3,'2017-11-17','2017-11-17 16:07:51'),(211,2,'2017-11-17','2017-11-17 17:27:11'),(212,7,'2017-11-17','2017-11-17 17:34:37'),(213,2,'2017-11-17','2017-11-17 17:39:19'),(214,7,'2017-11-17','2017-11-17 17:59:53'),(215,2,'2017-11-17','2017-11-17 18:01:48'),(216,8,'2017-11-17','2017-11-17 18:28:14'),(217,3,'2017-11-17','2017-11-17 18:54:32'),(218,3,'2017-11-17','2017-11-17 19:06:09'),(219,3,'2017-11-17','2017-11-17 19:11:58'),(220,3,'2017-11-17','2017-11-17 19:14:43'),(221,14,'2017-11-18','2017-11-18 20:41:27'),(222,15,'2017-11-19','2017-11-19 14:25:25'),(223,16,'2017-11-19','2017-11-19 14:48:09'),(224,14,'2017-11-20','2017-11-20 10:22:45'),(225,14,'2017-11-20','2017-11-20 10:26:18'),(226,2,'2017-11-21','2017-11-21 10:16:17'),(227,3,'2017-11-21','2017-11-21 10:18:24'),(228,2,'2017-11-21','2017-11-21 10:59:05'),(229,2,'2017-11-21','2017-11-21 11:23:36'),(230,2,'2017-11-21','2017-11-21 11:37:58'),(231,2,'2017-11-21','2017-11-21 11:42:37'),(232,3,'2017-11-21','2017-11-21 13:05:56'),(233,2,'2017-11-21','2017-11-21 16:55:28'),(234,2,'2017-11-21','2017-11-21 17:37:40'),(235,10,'2017-11-21','2017-11-21 18:26:21'),(236,5,'2017-11-21','2017-11-21 19:21:36'),(237,3,'2017-11-22','2017-11-22 11:46:25'),(238,2,'2017-11-22','2017-11-22 12:07:50'),(239,17,'2017-11-22','2017-11-22 13:04:39'),(240,17,'2017-11-22','2017-11-22 13:05:14'),(241,3,'2017-11-22','2017-11-22 14:10:26'),(242,2,'2017-11-22','2017-11-22 15:44:02'),(243,2,'2017-11-22','2017-11-22 16:38:47'),(244,3,'2017-11-22','2017-11-22 17:14:55'),(245,14,'2017-11-22','2017-11-22 21:33:48'),(246,2,'2017-11-23','2017-11-23 08:39:19'),(247,2,'2017-11-23','2017-11-23 10:15:19'),(248,2,'2017-11-23','2017-11-23 10:16:51'),(249,2,'2017-11-23','2017-11-23 10:20:13'),(250,2,'2017-11-23','2017-11-23 10:20:25'),(251,2,'2017-11-23','2017-11-23 10:21:08'),(252,2,'2017-11-23','2017-11-23 10:26:00'),(253,2,'2017-11-23','2017-11-23 10:39:29'),(254,2,'2017-11-23','2017-11-23 10:44:49'),(255,2,'2017-11-23','2017-11-23 10:45:38'),(256,2,'2017-11-23','2017-11-23 10:54:41'),(257,2,'2017-11-23','2017-11-23 11:09:21'),(258,2,'2017-11-23','2017-11-23 11:21:54'),(259,2,'2017-11-23','2017-11-23 11:26:12'),(260,2,'2017-11-23','2017-11-23 11:27:26'),(261,2,'2017-11-23','2017-11-23 11:35:53'),(262,2,'2017-11-23','2017-11-23 11:41:04'),(263,2,'2017-11-23','2017-11-23 11:45:37'),(264,2,'2017-11-23','2017-11-23 11:49:59'),(265,2,'2017-11-23','2017-11-23 11:52:56'),(266,2,'2017-11-23','2017-11-23 11:55:07'),(267,2,'2017-11-23','2017-11-23 11:55:41'),(268,2,'2017-11-23','2017-11-23 12:04:11'),(269,2,'2017-11-23','2017-11-23 12:21:15'),(270,3,'2017-11-23','2017-11-23 12:22:20'),(271,3,'2017-11-23','2017-11-23 12:52:49'),(272,3,'2017-11-23','2017-11-23 15:23:40'),(273,2,'2017-11-23','2017-11-23 15:25:10'),(274,17,'2017-11-23','2017-11-23 16:42:23'),(275,14,'2017-11-25','2017-11-25 16:41:20'),(276,16,'2017-11-26','2017-11-26 14:21:13'),(277,16,'2017-11-26','2017-11-26 14:26:02'),(278,14,'2017-11-28','2017-11-28 13:11:12'),(279,16,'2017-11-28','2017-11-28 15:59:18'),(280,2,'2017-11-29','2017-11-29 15:23:45'),(281,2,'2017-11-30','2017-11-30 09:19:03'),(282,2,'2017-11-30','2017-11-30 11:02:11'),(283,2,'2017-11-30','2017-11-30 11:04:59'),(284,2,'2017-11-30','2017-11-30 11:07:40'),(285,2,'2017-11-30','2017-11-30 14:54:25'),(286,3,'2017-11-30','2017-11-30 14:54:49'),(287,3,'2017-11-30','2017-11-30 16:27:35'),(288,3,'2017-11-30','2017-11-30 16:30:10'),(289,3,'2017-11-30','2017-11-30 16:31:32'),(290,2,'2017-11-30','2017-11-30 16:46:31'),(291,2,'2017-11-30','2017-11-30 16:49:39'),(292,2,'2017-11-30','2017-11-30 16:53:37'),(293,2,'2017-11-30','2017-11-30 16:54:52'),(294,2,'2017-11-30','2017-11-30 16:58:01'),(295,2,'2017-11-30','2017-11-30 16:59:50'),(296,2,'2017-11-30','2017-11-30 17:00:30'),(297,2,'2017-12-01','2017-12-01 09:23:38'),(298,3,'2017-12-01','2017-12-01 09:47:36'),(299,3,'2017-12-01','2017-12-01 11:20:12'),(300,2,'2017-12-01','2017-12-01 11:23:45'),(301,2,'2017-12-01','2017-12-01 15:33:00'),(302,3,'2017-12-01','2017-12-01 15:56:49'),(303,2,'2017-12-01','2017-12-01 16:25:46'),(304,2,'2017-12-01','2017-12-01 16:31:59'),(305,14,'2017-12-07','2017-12-07 15:51:08'),(306,3,'2017-12-13','2017-12-13 11:35:23'),(307,3,'2017-12-13','2017-12-13 12:33:29'),(308,3,'2017-12-13','2017-12-13 14:16:02'),(309,2,'2017-12-13','2017-12-13 15:03:16'),(310,3,'2017-12-14','2017-12-14 10:50:37'),(311,14,'2017-12-16','2017-12-16 18:01:50'),(312,2,'2017-12-18','2017-12-18 09:46:57'),(313,14,'2017-12-18','2017-12-18 09:47:45'),(314,8,'2017-12-18','2017-12-18 11:49:24'),(315,5,'2017-12-18','2017-12-18 12:00:20'),(316,19,'2017-12-18','2017-12-18 13:19:23'),(317,3,'2017-12-18','2017-12-18 15:27:55'),(318,3,'2017-12-18','2017-12-18 15:32:49'),(319,3,'2017-12-18','2017-12-18 15:43:52'),(320,3,'2017-12-18','2017-12-18 15:44:05'),(321,3,'2017-12-19','2017-12-19 09:43:36'),(322,2,'2017-12-19','2017-12-19 10:14:11'),(323,2,'2017-12-19','2017-12-19 11:06:13'),(324,2,'2017-12-19','2017-12-19 11:21:08'),(325,2,'2017-12-19','2017-12-19 11:30:46'),(326,2,'2017-12-19','2017-12-19 12:09:50'),(327,3,'2017-12-19','2017-12-19 13:20:42'),(328,2,'2017-12-19','2017-12-19 14:40:28'),(329,2,'2017-12-19','2017-12-19 14:40:29'),(330,20,'2017-12-19','2017-12-19 15:05:42'),(331,3,'2017-12-19','2017-12-19 16:24:56'),(332,16,'2017-12-19','2017-12-19 17:10:32'),(333,21,'2017-12-19','2017-12-19 17:13:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `repartidores` */

insert  into `repartidores`(`id`,`usuario_id`,`comprobante_domicilio`,`licencia`,`solicitud_trabajo`,`credencial_elector`,`latitud`,`longitud`,`created_at`,`updated_at`) values (1,2,'img/repartidores/comprobante_domicilio/2/1512425735.pdf','img/repartidores/licencia/2/1512425765.jpg','img/repartidores/solicitud_trabajo/2/1510772430.jpg','img/repartidores/credencial_elector/2/1510772430.jpg','20.6651778','-103.3958043','2017-12-19 16:56:57','2017-12-19 17:56:57'),(2,5,'img/repartidores/comprobante_domicilio/5/1510804941.jpeg','img/repartidores/licencia/5/1510804941.jpg','img/repartidores/solicitud_trabajo/5/1510804941.jpg','img/repartidores/credencial_elector/5/1510804941.jpeg','20.6651784','-103.3957795','2017-12-18 15:04:51','2017-12-18 16:04:51'),(3,15,'img/repartidores/comprobante_domicilio/15/1511126511.jpg','img/repartidores/licencia/15/1511126511.jpg','img/repartidores/solicitud_trabajo/15/1511126511.jpg','img/repartidores/credencial_elector/15/1511126511.jpg','0.999999999999','-101.2990294','2017-11-19 14:40:35','2017-11-19 15:40:35'),(4,18,'img/repartidores/comprobante_domicilio/18/1511738856.png','img/repartidores/licencia/18/1511738856.png','img/repartidores/solicitud_trabajo/18/1511738856.png','img/repartidores/credencial_elector/18/1511738856.png',NULL,NULL,'2017-11-26 17:27:36','2017-11-26 17:27:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `servicio_detalles` */

insert  into `servicio_detalles`(`id`,`servicio_id`,`producto_id`,`categoria_id`,`nombre_producto`,`foto_producto`,`precio`,`cantidad`,`gramos_base`,`porciones_adicionales`,`precio_porcion`,`peso_porcion`,`drink`,`created_at`,`updated_at`) values (1,1,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'','9.00','50',0,'2017-12-01 17:33:07','2017-12-01 17:33:07'),(2,1,20,2,'chile en rajas','img/productos/Ejemplo2.jpg','3500.00',1,NULL,'','10.00','50',0,'2017-12-01 17:33:07','2017-12-01 17:33:07'),(3,2,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'','9.00','50',0,'2017-12-13 13:38:53','2017-12-13 13:38:53'),(4,2,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'2','9.00','50',0,'2017-12-13 13:38:53','2017-12-13 13:38:53'),(5,2,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'1','9.00','50',0,'2017-12-13 13:38:53','2017-12-13 13:38:53'),(6,2,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'','9.00','50',0,'2017-12-13 13:38:53','2017-12-13 13:38:53'),(7,3,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'','9.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(8,3,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'1','9.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(9,3,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'','9.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(10,3,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'1','9.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(11,3,20,2,'chile en rajas','img/productos/Ejemplo2.jpg','3500.00',1,NULL,'','10.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(12,3,20,2,'chile en rajas','img/productos/Ejemplo2.jpg','3500.00',1,NULL,'','10.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(13,3,21,3,'chile relleno','img/productos/Ejemplo3.jpg','2000.00',1,NULL,'1','7.00','50',0,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(14,3,22,4,'Jamaica (chico)','img/productos/Screenshot_1.png','2000.00',1,NULL,'',NULL,NULL,1,'2017-12-13 15:25:36','2017-12-13 15:25:36'),(15,4,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'1','9.00','50',0,'2017-12-18 10:51:30','2017-12-18 10:51:30'),(16,5,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,'250','2','9.00','50',0,'2017-12-18 12:57:57','2017-12-18 12:57:57'),(17,5,24,2,'Arroz Integral','img/productos/arroz-integral.jpg','2000.00',1,'100','1','10.00','100',0,'2017-12-18 12:57:57','2017-12-18 12:57:57'),(18,5,27,3,'Ensalada Cesar','img/productos/ensalada-cesaer.jpg','1800.00',1,'100','2','10.00','100',0,'2017-12-18 12:57:57','2017-12-18 12:57:57'),(19,5,33,4,'Horchata (grande)','img/productos/horchata.jpg','2000.00',1,NULL,'',NULL,NULL,1,'2017-12-18 12:57:57','2017-12-18 12:57:57'),(20,6,26,1,'Carna Asada','img/productos/carne-asada.jpg','3000.00',2,NULL,'1','15.00','100',0,'2017-12-18 14:38:49','2017-12-18 14:38:49'),(21,7,21,3,'chile relleno','img/productos/Ejemplo3.jpg','2000.00',2,'150','1','7.00','50',0,'2017-12-18 14:54:06','2017-12-18 14:54:06'),(22,7,27,3,'Ensalada Cesar','img/productos/ensalada-cesaer.jpg','1800.00',2,'100','1','10.00','100',0,'2017-12-18 14:54:06','2017-12-18 14:54:06'),(23,8,37,1,'Pescado','img/productos/pescado.jpg','1800.00',1,NULL,'','12.00','100',0,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(24,8,39,1,'Pollo a la plancha','img/productos/pollo-a-la-plabcha.jpg','2000.00',1,NULL,'','15.00','100',0,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(25,8,32,2,'Frijoles','img/productos/frijoles.jpg','1500.00',2,NULL,'','10.00','100',0,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(26,8,36,2,'Pasta Blanca','img/productos/pasta-blanca.jpg','2000.00',2,NULL,'2','15.00','100',0,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(27,8,34,4,'Limón con chía (grande)','img/productos/limon-con-chia.jpg','2000.00',3,NULL,'',NULL,NULL,1,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(28,8,33,4,'Horchata (undefined)','img/productos/horchata.jpg','1500.00',3,NULL,'',NULL,NULL,1,'2017-12-18 15:12:34','2017-12-18 15:12:34'),(29,9,33,4,'Horchata (grande)','img/productos/horchata.jpg','2000.00',1,NULL,'',NULL,NULL,1,'2017-12-19 12:50:55','2017-12-19 12:50:55'),(30,10,33,4,'Horchata (chico)','img/productos/horchata.jpg','1500.00',1,NULL,'',NULL,NULL,1,'2017-12-19 13:36:43','2017-12-19 13:36:43'),(31,10,33,4,'Horchata (chico)','img/productos/horchata.jpg','1500.00',1,NULL,'',NULL,NULL,1,'2017-12-19 13:36:43','2017-12-19 13:36:43'),(32,11,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'1','9.00','50',0,'2017-12-19 14:25:30','2017-12-19 14:25:30'),(33,11,40,1,'Salmón ','img/productos/salmon.jpg','2800.00',1,NULL,'1','25.00','100',0,'2017-12-19 14:25:30','2017-12-19 14:25:30'),(34,11,27,3,'Ensalada Cesar','img/productos/ensalada-cesaer.jpg','1800.00',1,NULL,'2','10.00','100',0,'2017-12-19 14:25:30','2017-12-19 14:25:30'),(35,11,35,4,'Naranjada (grande)','img/productos/naranjada.jpg','2000.00',1,NULL,'',NULL,NULL,1,'2017-12-19 14:25:30','2017-12-19 14:25:30'),(36,12,25,1,'Carne al horno','img/productos/carne-al-horno.jpg','3000.00',1,NULL,'','20.00','100',0,'2017-12-19 15:24:03','2017-12-19 15:24:03'),(37,12,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'3','9.00','50',0,'2017-12-19 15:24:03','2017-12-19 15:24:03'),(38,13,25,1,'Carne al horno','img/productos/carne-al-horno.jpg','3000.00',1,NULL,'','20.00','100',0,'2017-12-19 15:24:11','2017-12-19 15:24:11'),(39,13,19,1,'chile rojo','img/productos/Ejemplo.jpg','3000.00',1,NULL,'3','9.00','50',0,'2017-12-19 15:24:11','2017-12-19 15:24:11'),(40,14,25,1,'Carne al horno','img/productos/carne-al-horno.jpg','3000.00',1,NULL,'1','20.00','100',0,'2017-12-19 15:32:23','2017-12-19 15:32:23'),(41,14,37,1,'Pescado','img/productos/pescado.jpg','1800.00',1,NULL,'','12.00','100',0,'2017-12-19 15:32:23','2017-12-19 15:32:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

insert  into `servicios`(`id`,`usuario_id`,`nombre_cliente`,`correo_cliente`,`conekta_order_id`,`customer_id_conekta`,`costo_total`,`telefono`,`recibidor`,`calle`,`colonia`,`num_ext`,`num_int`,`ciudad`,`estado`,`pais`,`codigo_postal`,`latitud`,`longitud`,`comentarios`,`repartidor_id`,`status`,`activo`,`notificado`,`tipo_pago`,`is_finished`,`puntuacion`,`codigo_liberacion`,`last_digits`,`datetime_formated`,`created_at`,`updated_at`) values (1,3,'Roberto','prueba@hotmail.com',NULL,NULL,6500,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',2,'pending_payment',1,1,'efectivo',0,NULL,'JQWYVQ7H',NULL,'Viernes 02 Diciembre 2017','2017-12-01 17:33:07','2017-12-19 13:53:24'),(2,3,'Roberto','prueba@hotmail.com',NULL,NULL,14700,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'AS3DYR4E',NULL,'Miercoles 14 Diciembre 2017','2017-12-13 13:38:53','2017-12-13 13:38:53'),(3,3,'Roberto','prueba@hotmail.com',NULL,NULL,25500,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',2,'pending_payment',1,0,'efectivo',0,NULL,'CCE3CUFW',NULL,'Miercoles 14 Diciembre 2017','2017-12-13 15:25:36','2017-12-19 13:53:25'),(4,14,'José ','foudetoi@hotmail.es',NULL,NULL,3900,'4424677440','José Socorro Garcia Pimentel','Río Tecolutla','La Pradera','1576',NULL,'Irapuato2','Guanajuato','MX','36630','20.6983479','-101.3476737','',0,'pending_payment',0,0,'efectivo',0,NULL,'QIWTIPCB',NULL,'Lunes 19 Diciembre 2017','2017-12-18 10:51:30','2017-12-18 10:51:30'),(5,8,'Omar','mcflay5@gmail.com','ord_2hkF8ufNYP9sQWbe8','cus_2hkF8u8epTrne6Y2p',13600,'3333333333','Angel omar mendoza','Cuautitlan','Chapalita','211','','Guadalajara','Jalisco','MX','44500','20.6653785','-103.395953','',5,'paid',0,1,'tarjeta',1,NULL,'CFRAKHKQ','4242','Lunes 19 Diciembre 2017','2017-12-18 12:57:47','2017-12-18 13:06:37'),(6,19,'Luis Colin','luisr.coz@gmail.com',NULL,NULL,9000,'3316016789','Luis Colin prueba','Avenida Tepeyac','Chapalita','54',NULL,'Guadalajara','JAL','MX','44960','20.665608741081','-103.39609575587','',5,'paid',0,0,'efectivo',1,NULL,'SHSO7GJS',NULL,'Lunes 19 Diciembre 2017','2017-12-18 14:38:49','2017-12-18 14:50:04'),(7,19,'Luis Colin','luisr.coz@gmail.com','ord_2hkGfbtQdXX5LDXtX','cus_2hkGfc6WRomgNByJn',11000,'3316016789','Luis Colin prueba','Avenida Tepeyac','Chapalita','54',NULL,'Guadalajara','Jalisco','MX','44960','20.665608741081','-103.39609575587','Prueba',5,'paid',0,1,'tarjeta',1,NULL,'OXW4HEUT','4242','Lunes 19 Diciembre 2017','2017-12-18 14:53:55','2017-12-18 15:02:03'),(8,19,'Luis Colin','luisr.coz@gmail.com',NULL,NULL,27300,'3316016789','Prueba','Avenida Tepeyac','Chapalita','54',NULL,'Guadalajara','JAL','MX','44960','20.665531508363','-103.39578128236','Prueba 3',5,'paid',0,0,'efectivo',1,NULL,'JOYANBCQ',NULL,'Lunes 19 Diciembre 2017','2017-12-18 15:12:34','2017-12-18 16:05:00'),(9,3,'Roberto','prueba@hotmail.com',NULL,NULL,2000,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'6RCJPRN3',NULL,'Martes 20 Diciembre 2017','2017-12-19 12:50:55','2017-12-19 12:50:55'),(10,3,'Roberto','prueba@hotmail.com',NULL,NULL,3000,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'YKEX3KFR',NULL,'Martes 20 Diciembre 2017','2017-12-19 13:36:43','2017-12-19 13:36:43'),(11,3,'Roberto','prueba@hotmail.com',NULL,NULL,15000,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'V695QFPH',NULL,'Martes 20 Diciembre 2017','2017-12-19 14:25:30','2017-12-19 14:25:30'),(12,3,'Roberto','prueba@hotmail.com',NULL,NULL,8700,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'NJCQRUID',NULL,'Martes 20 Diciembre 2017','2017-12-19 15:24:03','2017-12-19 15:24:03'),(13,3,'Roberto','prueba@hotmail.com',NULL,NULL,8700,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'4HKKJROA',NULL,'Martes 20 Diciembre 2017','2017-12-19 15:24:11','2017-12-19 15:24:11'),(14,3,'Roberto','prueba@hotmail.com',NULL,NULL,6800,'6691873649','Juan Diego','Cuautitlan','Chapalita','202',NULL,'Guadalajara','Jalisco','MX','43000','20.666207180292','-103.39689938029','',0,'pending_payment',0,0,'efectivo',0,NULL,'OU9RUQCT',NULL,'Martes 20 Diciembre 2017','2017-12-19 15:32:23','2017-12-19 15:32:23');

/*Table structure for table `tipo_pregunta` */

DROP TABLE IF EXISTS `tipo_pregunta`;

CREATE TABLE `tipo_pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_pregunta` */

insert  into `tipo_pregunta`(`id`,`tipo`) values (1,'REVISIÓN DE TARIFAS'),(2,'OPCIONES DE CUENTA'),(3,'ACCESIBILIDAD'),(4,'MÉTODOS DE PAGO'),(5,'REPORTAR UN PROBLEMA');

/*Table structure for table `tipo_producto` */

DROP TABLE IF EXISTS `tipo_producto`;

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_producto` */

insert  into `tipo_producto`(`id`,`tipo`,`foto`,`created_at`,`updated_at`) values (1,'Shampoo','img/tipo_productos/1506440378.png','2017-09-26 10:39:38','2017-09-26 15:39:38'),(2,'Acondicionador','img/tipo_productos/1506440445.png','2017-09-26 10:40:45','2017-09-26 15:40:45'),(3,'Piojos','img/tipo_productos/1506440346.png','2017-09-26 10:39:06','2017-09-26 15:39:06');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'conrado.carrillo','$2y$10$hPxSH9GAcKTrI1zqP.beROrfWbsYCoFH7bODs5nZ5XYvL6dX5yTQW','anton_con@hotmail.com','img/user_perfil/default.jpg','ciVgGt2baoucpBbGmJi4oCh44gk0gZLrjbj5jAHaNEVz8HbZhtyrASbFPjJe',1,'2017-03-23 11:30:45','2017-12-11 21:10:57'),(2,'admin','$2y$10$f5qOMC5k2fFgKY2tp3tTe.RrB8MqZBfV4BP32NAdidqLJP2Q/K3FK','admin@kidscut.com','img/user_perfil/default.jpg','UQf3D1ahENAZxpxhwbzJFpBqBwkBjTlvrvNomI3ZRcRghuVIXxIM9VyeKles',1,'2017-08-17 17:34:22','2017-08-17 23:14:55'),(4,'Jose Coco ','$2y$10$/zvUaV0ROCYkPROOUbPlfuyS.bR1Ehrmov2bqZHDdxDnb3Qt7gQia','foudetoi@hotmail.es','img/user_perfil/default.jpg',NULL,1,'2017-10-10 22:11:09','2017-10-10 22:11:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`password`,`nombre`,`apellido`,`correo`,`foto_perfil`,`celular`,`customer_id_conekta`,`tipo`,`red_social`,`player_id`,`status`,`created_at`,`updated_at`) values (1,'9094b475d9483db7d8c32a67ddaf4500','Conrado Antonio','Carrillo Rosales','anton_con@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','9801010','cus_2hUD9SwS135vWZXJw',1,NULL,'76ece62b-bcfe-468c-8a78-839aeaa8c5fa',1,'2017-10-17 22:00:05','2017-12-18 13:04:10'),(2,'a83f0f76c2afad4f5d7260824430b798','Arturo rep.','Lizárraga Gutierrez','dominic@gmail.com','img/usuario_app/default.jpg','9801010',NULL,2,NULL,'b2551667-8538-4839-8d6e-d1a987870618',1,'2017-11-15 13:00:30','2017-12-01 17:25:46'),(3,'c893bad68927b457dbed39460e6afd62','Roberto','Garcia Barboza','prueba@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6691873649','cus_2hZUnGt79YUn6cwNB',1,NULL,'5e88dfb0-9cba-4bdb-8366-175c04663ba3',1,'2017-11-15 13:10:06','2017-12-18 16:27:56'),(5,'e10adc3949ba59abbe56e057f20f883e','PRUEBA','PRUEBA','omar@carneslanortena.com','img/usuario_app/default.jpg','1111111111',NULL,2,NULL,'17aeddc6-fcdf-4e12-8f5d-fb45070ad115',1,'2017-11-15 22:02:21','2017-12-18 13:00:20'),(6,NULL,'Roberto','Garcia','robertito.gb23.rg@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg',NULL,NULL,1,1,'fe16ed67-a74f-496b-86e8-c21a6d08752c',1,'2017-11-16 12:32:19','2017-11-24 12:53:09'),(7,'a83f0f76c2afad4f5d7260824430b798','Roberto Garcia Barboza','','roberto_gb23@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6691234554',NULL,1,1,'a422599c-b9e1-47dd-9ecd-b6262fbbde15',1,'2017-11-16 12:40:21','2017-11-17 19:02:01'),(8,'202cb962ac59075b964b07152d234b70','Omar','Mendoza','mcflay5@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','3333333333','cus_2hkF8u8epTrne6Y2p',1,NULL,'927227d4-2fa9-45b6-9f43-e7fa28f3637f',1,'2017-11-16 17:23:52','2017-12-18 12:57:47'),(9,'a83f0f76c2afad4f5d7260824430b798','Bridge','Studio','bridgestudiogdl@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6691234857','cus_2hZrP7GhToPeTDUcA',1,1,NULL,1,'2017-11-16 17:57:03','2017-11-16 18:02:13'),(10,'202cb962ac59075b964b07152d234b70','Omar','Mendoza','omar_m@bridgestudio.mx','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','3316056031','cus_2hZsnDeUXQHo1PHb5',1,NULL,'56711aea-f2ed-42fb-89ee-8028362f28dc',1,'2017-11-16 18:01:36','2017-11-21 20:17:37'),(11,'4d186321c1a7f0f354b297e8914ab240','Edgard','Vargas','edvargas20@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','3314878908',NULL,1,NULL,NULL,1,'2017-11-16 19:58:16','2017-11-16 19:58:16'),(12,'202cb962ac59075b964b07152d234b70','Omar ','Mendoza ','facturacion@bridgestudio.mx','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','3316056031','cus_2hZtNzRoin7YSnggf',1,NULL,NULL,1,'2017-11-16 20:29:58','2017-11-16 20:33:57'),(13,'c893bad68927b457dbed39460e6afd62','Roberto garcia','Barboza','prueba2@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6691234566',NULL,1,NULL,NULL,1,'2017-11-16 20:32:23','2017-11-16 20:32:23'),(14,'f463f63616cb3f1e81ce46b39f882fd5','José ','Garcia Pimentel ','foudetoi@hotmail.es','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','4424677440',NULL,1,NULL,'0c4073ad-75ec-4a40-9edb-a692774dc5d1',1,'2017-11-18 21:41:26','2017-12-07 16:51:08'),(15,'977e2a1cdca5be23fdaa4f379b24fcc7','Alejandra','Contreras Espitia','alexia_770@hotmail.com','img/usuario_app/default.jpg','462 1651270',NULL,2,NULL,NULL,1,'2017-11-19 15:21:51','2017-11-26 15:16:54'),(16,'c027636003b468821081e281758e35ff','Julio ','Garcia','potroazteca@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','4621812040',NULL,1,NULL,'da60feb1-7ea1-47a1-b4d8-5e69b9573777',1,'2017-11-19 15:48:09','2017-12-19 18:10:32'),(17,'9fda3f06b544e7092953abe8d7e44f86','Jennifer','Zamora','jennifer.zam@hotmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','6691157468',NULL,1,NULL,'5fc16919-4125-46ab-8417-f7c969d889e1',1,'2017-11-22 14:04:39','2017-12-11 23:38:00'),(18,'f463f63616cb3f1e81ce46b39f882fd5','jose','pimentel','cocoinbox1@hotmail.com','img/usuario_app/default.jpg','4424577440',NULL,2,NULL,NULL,1,'2017-11-26 17:27:36','2017-11-26 17:27:36'),(19,'151ff404dcfa462140e9efe17193d23e','Luis Colin','','luisr.coz@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg','3316016789','cus_2hkGfc6WRomgNByJn',1,1,'a1011129-09db-43ce-8cee-c5dcbdd56365',1,'2017-12-18 14:19:23','2017-12-18 14:53:56'),(20,NULL,'Javier Salas','','veilside8@msn.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg',NULL,NULL,1,1,'f08229de-b374-461e-830c-d12e78ea8e47',1,'2017-12-19 16:05:42','2017-12-19 16:05:43'),(21,NULL,'Oscar Gómez García','','oscarghostg@gmail.com','http://cocoinbox.bsmx.tech/public/img/user_perfil/default.jpg',NULL,NULL,1,1,'99c5d1e4-3a1f-49dd-87a6-6e714ca42253',1,'2017-12-19 18:13:38','2017-12-19 18:13:39');

/*Table structure for table `usuario_direcciones` */

DROP TABLE IF EXISTS `usuario_direcciones`;

CREATE TABLE `usuario_direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `colonia` varchar(80) DEFAULT NULL,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `pais` varchar(10) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `residencial` tinyint(4) DEFAULT NULL,
  `is_main` tinyint(4) DEFAULT NULL,
  `latitud` varchar(30) DEFAULT NULL,
  `longitud` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `usuario_direcciones` */

insert  into `usuario_direcciones`(`id`,`usuario_id`,`recibidor`,`calle`,`colonia`,`num_ext`,`num_int`,`estado`,`ciudad`,`pais`,`codigo_postal`,`residencial`,`is_main`,`latitud`,`longitud`,`created_at`,`updated_at`) values (1,3,'Juan Diego','Cuautitlan','Chapalita','202',NULL,'Jalisco','Guadalajara','MX','43000',1,0,'20.666207180292','-103.39689938029','2017-12-01 17:32:58','2017-12-01 17:32:58'),(2,17,'Nadia Mercado','Pemex 1','Loma Atravesada','520',NULL,'Sinaloa','Mazatlán','MX','81286',0,0,'23.219978','-106.402232','2017-12-11 23:38:54','2017-12-11 23:38:54'),(3,14,'José Socorro Garcia Pimentel','Río Tecolutla','La Pradera','1576',NULL,'Guanajuato','Irapuato2','MX','36630',1,0,'20.6983479','-101.3476737','2017-12-18 10:51:04','2017-12-18 10:51:04'),(4,8,'Angel omar mendoza','Cuautitlan','Chapalita','211','','Jalisco','Guadalajara','MX','44500',1,0,'20.6653785','-103.395953','2017-12-18 12:56:36','2017-12-18 12:56:36'),(5,19,'Luis Colin prueba','Avenida Tepeyac','Chapalita','54',NULL,'JAL','Guadalajara','MX','44960',1,0,'20.665608741081','-103.39609575587','2017-12-18 14:25:35','2017-12-18 14:25:35'),(6,19,'Prueba','Avenida Tepeyac','Chapalita','54',NULL,'JAL','Guadalajara','MX','44960',1,0,'20.665531508363','-103.39578128236','2017-12-18 14:33:21','2017-12-18 14:33:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
