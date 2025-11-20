-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: portalzuelas
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `user_id` int NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `cv` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_alumno_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES ('Paco','Sánchez León',11,'Calle Nueva 22, Andújar',''),('David','Martín Ortiz',12,'Calle Bailén 3, Jaén',''),('Patricia','Romero Aguilar',13,'Calle Sevilla 10, Torredonjimeno',NULL),('Sergio','Torres Ramos',14,'Calle Estación 18, Úbeda',NULL),('Elena','Molina Cruz',15,'Calle Ancha 7, Jaén',NULL),('Javier','Ortiz Lara',16,'Avenida Andalucía 30, Linares',NULL),('Lucía','Ramos Herrera',17,'Calle Sol 5, Martos',NULL),('Roberto','Vargas Serrano',18,'Calle Ronda 2, Jaén',NULL),('Sofía','Navarro Castillo',19,'Calle Granada 15, Andújar',NULL),('Diego','Castillo Molina',20,'Calle Alta 11, Torredelcampo',NULL),('Natalia','Cano Gutiérrez',21,'Calle Jardines 6, Linares',NULL),('Andrés','Santos Vera',22,'Avenida Europa 1, Jaén',NULL),('Carla','Herrera Campos',23,'Calle Córdoba 9, Jaén',NULL),('Pablo','García Cruz',24,'Calle Norte 13, Martos',NULL),('Irene','Flores Peña',25,'Calle Libertad 16, Úbeda',NULL),('paco','de lucia',58,'marruecos',''),('Laura','Fernández Gómez',61,'Calle San Roque Nº4',''),('Carlos','Pérez Ruiz',62,'Calle San Roque Nº4',''),('Ana','Martínez López',63,'Calle San Roque Nº4',''),('Javier','Sánchez Díaz',64,'Calle San Roque Nº4',''),('Marta','Jiménez Ortega',65,'Calle San Roque Nº4',''),('Pablo','García Morales',66,'Calle San Roque Nº4',''),('Lucía','Torres Castillo',67,'Calle San Roque Nº4',''),('Diego','Hernández Ramos',68,'Calle San Roque Nº4',''),('Elena','Romero Vega',69,'Calle San Roque Nº4',''),('Sergio','Navarro León',70,'Calle San Roque Nº4',''),('Cristina','Domínguez Soto',71,'Calle San Roque Nº4',''),('Adrián','Ruiz Cano',72,'Calle San Roque Nº4',''),('Paula','Ortega Molina',73,'Calle San Roque Nº4',''),('Raúl','Moreno Gil',74,'Calle San Roque Nº4',''),('Beatriz','Castro Arias',75,'Calle San Roque Nº4',''),('Noelia','Vargas Herrera',76,'Calle San Roque Nº4',''),('Óscar','Suárez Bravo',77,'Calle San Roque Nº4',''),('Natalia','Ramos Ibáñez',78,'Calle San Roque Nº4',''),('David','López Cabrera',170,'Calle San Roque Nº4',''),('Iván','Crespo Núñez',174,'sdffsaf',''),('Laura','Fernandez Gsmez',281,'Calle San Roque Nº4',''),('dsada','undefined',282,'undefined',''),('Victor','ADSADAS',285,'adsdaD',''),('Victor','Molina Ruiz',289,'Jaen',''),('Juan','Pérez',290,'Calle Falsa 123',''),('María','Gómez',291,'Avenida Siempre Viva 742',''),('Carlos','Ramírez',292,'Calle Luna 45',''),('Lucía','Fernández',293,'Plaza Mayor 10',''),('Miguel','Sánchez',294,'Calle Sol 78',''),('Ana','Martínez',295,'Camino Real 56',''),('Pedro','García',296,'Avenida del Mar 90',''),('Sofía','Hernández',297,'Calle Estrella 33',''),('Diego','Torres',298,'Calle Nube 12',''),('Elena','López',299,'Plaza Central 44',''),('Victor','asaas',312,'sfndsf',''),('Victorr','adsad',313,'sddad',''),('Victor','Molina Ruiz',315,'Carchelejo',''),('gdfsggd','sdfsd',327,'dsda',''),('gdfsggd','sdfsd',330,'dsda',''),('gdfsggd','sdfsd',332,'dsda',''),('gdfsggd','sdfsd',333,'dsda',''),('gdfsggd','sdfsd',334,'dsda',''),('Paco','Paco Paco',335,'Jaen',''),('Victor','dsfdsaf',336,'dsdasdas',''),('Victor','dsfdsaf',337,'dsdasdas','/portalDeEmpleo2/curriculums/337.pdf'),('Victor','Sánchez León',341,'Polígono Los Olivares, Nave 15',''),('prueba','adasdda',357,'adios',''),('prueba','prueba',358,'sfdnfs',''),('Victor','Molina ruiz',360,'Calle de San Roque',''),('Juan','Pérez',361,'Calle Falsa 123',''),('María','Gómez',362,'Avenida Siempre Viva 742',''),('Victor','Molina ruiz',365,'Calle de San Roque',''),('PRUEBA FINAL','molina',367,'Jaen','');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciclo`
--

DROP TABLE IF EXISTS `ciclo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciclo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nivel` enum('basico','medio','superior','especializacion') NOT NULL,
  `familiaProfesional_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciclo_familiaProfesional1_idx` (`familiaProfesional_id`),
  CONSTRAINT `fk_ciclo_familiaProfesional1` FOREIGN KEY (`familiaProfesional_id`) REFERENCES `familiaprofesional` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciclo`
--

LOCK TABLES `ciclo` WRITE;
/*!40000 ALTER TABLE `ciclo` DISABLE KEYS */;
INSERT INTO `ciclo` VALUES (1,'Informática de Oficina','basico',16),(2,'Informática y Comunicaciones','basico',16),(3,'Sistemas Microinformáticos y Redes','medio',16),(4,'Desarrollo de Aplicaciones Multiplataforma','superior',16),(5,'Desarrollo de Aplicaciones Web','superior',16),(6,'Administración de Sistemas Informáticos en Red','superior',16),(7,'Inteligencia Artificial y Big Data','especializacion',16),(8,'Ciberseguridad en Entornos de las Tecnologías de la Información','especializacion',16),(9,'Desarrollo de videojuegos y realidad virtual','especializacion',16),(10,'Desarrollo de aplicaciones en lenguaje Python','especializacion',16);
/*!40000 ALTER TABLE `ciclo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciclo_has_alumno`
--

DROP TABLE IF EXISTS `ciclo_has_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciclo_has_alumno` (
  `ciclo_id` int NOT NULL,
  `alumno_user_id` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_ciclo_has_alumno_alumno1_idx` (`alumno_user_id`),
  KEY `fk_ciclo_has_alumno_ciclo1_idx` (`ciclo_id`),
  CONSTRAINT `fk_ciclo_has_alumno_alumno1` FOREIGN KEY (`alumno_user_id`) REFERENCES `alumno` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ciclo_has_alumno_ciclo1` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciclo_has_alumno`
--

LOCK TABLES `ciclo_has_alumno` WRITE;
/*!40000 ALTER TABLE `ciclo_has_alumno` DISABLE KEYS */;
INSERT INTO `ciclo_has_alumno` VALUES (3,11,'2023-11-12','2025-11-12',3),(2,11,'2023-11-12','2025-11-12',4),(8,12,'2023-11-13','2025-11-13',5),(3,315,'2023-11-13','2025-11-13',6),(5,315,'2023-11-13','2025-11-13',7),(10,12,'2023-11-14','2025-11-14',8),(5,367,'2023-11-17','2025-11-17',9);
/*!40000 ALTER TABLE `ciclo_has_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `nombre` varchar(45) NOT NULL,
  `user_id` int NOT NULL,
  `telefono` int NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `personaContacto` varchar(45) NOT NULL,
  `numPersonaContacto` int NOT NULL,
  `activa` tinyint NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_empresa_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES ('AgroJaén SA',2,953222222,'Polígono Los Olivares, Nave 15','Especialistas en maquinaria agrícola y tecnología verde.','María Pérez',600222330,1),('Construcciones Andinas',3,953333333,'Av. Andalucía 45, Jaén','Empresa dedicada a obra civil y edificación sostenible.','Javier Ruiz',600333444,1),('NT',4,911223344,'Calle Alcalá 95, Madrid','Consultora multinacional líder en servicios tecnológicos, innovación y transformación digital.','Javier Fernández',612334455,1),('Software del Sol',5,953999888,'Polígono Industrial Los Olivares, Jaén','Líder en software de gestión empresarial, con más de 30 años de experiencia en desarrollo de software de gestión.','María Martínez',654987321,1),('Victor',49,3434334,'fsfds','ewrew','f',4,1),('Prueba',50,999999999,'Calle san roque 4','JAJAJAJAJAJAAJ','Victor',622706214,1),('NTER',52,24234,'jaen','data','paco',12,1),('NTER',55,655435345,'jaen','data','paco',655435345,1),('Victor',217,622706214,'dasda','ñokdasnofp9fn','adssada',655435345,1),('Victor',268,622706214,'Calle de San Roque','Consultora multinacional líder en servicios tecnológicos, innovación y transformación digital.','Javier Fernández',623423532,0),('Victor',314,953222222,'Calle de San Roque','fsdfas','paco',623423532,1),('Mangurrinos',316,666666666,'Avenida Fental 66 Jaen','Proveedor de paginas con contenido para adultos','Juan Pedro Exposito',666666668,1),('Victor',339,953222222,'Calle de San Roque','daadadasddsad','paco',622706314,1),('Victor',340,953222222,'Calle de San Roque','dsafdsfads','Paco',666666668,1),('Ruben',342,666666777,'Tercer mundista, Peru','No tengo fibra','Ruben tambien',666666777,1),('dsadasdsa',343,666666666,'dasdasD','ADSADada','ASd',666666666,0),('Victor',344,953222222,'sdsafasfs','asdadsadsad','sadfadsffdsdsf',999999999,0),('prueba',346,666666666,'sad','adasda','PRUEBA',666666666,0);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familiaprofesional`
--

DROP TABLE IF EXISTS `familiaprofesional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familiaprofesional` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familiaprofesional`
--

LOCK TABLES `familiaprofesional` WRITE;
/*!40000 ALTER TABLE `familiaprofesional` DISABLE KEYS */;
INSERT INTO `familiaprofesional` VALUES (1,'Actividades Físicas y Deportivas'),(2,'Administración y Gestión'),(3,'Agraria'),(4,'Artes Gráficas'),(5,'Artes y Artesanías'),(6,'Comercio y Marketing'),(7,'Edificación y Obra Civil'),(8,'Electricidad y Electrónica'),(9,'Energía y Agua'),(10,'Fabricación Mecánica'),(11,'Hostelería y Turismo'),(12,'Imagen Personal'),(13,'Imagen y Sonido'),(14,'Industrias Alimentarias'),(15,'Industrias Extractivas'),(16,'Informática y Comunicaciones'),(17,'Instalación y Mantenimiento'),(18,'Madera, Mueble y Corcho'),(19,'Marítimo-Pesquera'),(20,'Química'),(21,'Sanidad'),(22,'Seguridad y Medio Ambiente'),(23,'Servicios Socioculturales y a la Comunidad'),(24,'Textil, Confección y Piel'),(25,'Transporte y Mantenimiento de Vehículos'),(26,'Vidrio y Cerámica');
/*!40000 ALTER TABLE `familiaprofesional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oferta`
--

DROP TABLE IF EXISTS `oferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oferta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `descripcion` text NOT NULL,
  `empresa_user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_oferta_empresa1_idx` (`empresa_user_id`),
  CONSTRAINT `fk_oferta_empresa1` FOREIGN KEY (`empresa_user_id`) REFERENCES `empresa` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oferta`
--

LOCK TABLES `oferta` WRITE;
/*!40000 ALTER TABLE `oferta` DISABLE KEYS */;
INSERT INTO `oferta` VALUES (1,'2025-11-12','2025-11-15','fddfafs',314),(2,'2025-11-13','2025-11-29','jbhj',314),(3,'2025-11-13','2025-11-30','dfsfds',314),(4,'2025-11-13','2025-11-30','dfsfds',314),(5,'2025-11-13','2025-11-30','dfsfds',314),(6,'2025-11-13','2025-11-30','arreglar ordenadores',314),(7,'2025-11-14','2025-11-21','arreglar impresoras',314),(8,'2025-11-14','2025-12-31','Desarrollador web, con experiencia de 2 años en paginas para adultos. ',316),(9,'2025-11-17','2026-01-31','A ver si sale',314);
/*!40000 ALTER TABLE `oferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oferta_has_ciclo`
--

DROP TABLE IF EXISTS `oferta_has_ciclo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oferta_has_ciclo` (
  `oferta_id` int NOT NULL,
  `ciclo_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_oferta_has_ciclo_ciclo1_idx` (`ciclo_id`),
  KEY `fk_oferta_has_ciclo_oferta1_idx` (`oferta_id`),
  CONSTRAINT `fk_oferta_has_ciclo_ciclo1` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_oferta_has_ciclo_oferta1` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oferta_has_ciclo`
--

LOCK TABLES `oferta_has_ciclo` WRITE;
/*!40000 ALTER TABLE `oferta_has_ciclo` DISABLE KEYS */;
INSERT INTO `oferta_has_ciclo` VALUES (3,6,1),(3,7,2),(4,2,3),(5,3,4),(6,3,5),(7,1,6),(8,3,7),(8,5,8),(9,5,9);
/*!40000 ALTER TABLE `oferta_has_ciclo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alumno_user_id` int NOT NULL,
  `fecha` date NOT NULL,
  `oferta_id` int NOT NULL,
  `estado` enum('aceptada','rechazada','enProceso') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_solicitud_alumno2_idx` (`alumno_user_id`),
  KEY `fk_solicitud_oferta1_idx` (`oferta_id`),
  CONSTRAINT `fk_solicitud_alumno2` FOREIGN KEY (`alumno_user_id`) REFERENCES `alumno` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_solicitud_oferta1` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (8,315,'2025-11-15',8,'enProceso'),(9,315,'2025-11-15',6,'aceptada'),(10,315,'2025-11-15',5,'enProceso'),(11,367,'2025-11-17',9,'enProceso');
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_token_user1_idx` (`user_id`),
  CONSTRAINT `fk_token_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(60) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','alumno','empresa') NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'empresa2@mail.com','$2y$10$HbdHK2cSpJ.l3CSOsKAsCe8upZu76XKPBmJw96pYMOdW69ahOPVoK','empresa','/portalDeEmpleo2/fotosPerfil/1.png'),(3,'empresa3@mail.com','$2y$10$0mWyt8Ifp59NravEthZS0u4tACE2ISlyqdOANUV61ubeaoNoepZ/S','empresa','/portalDeEmpleo2/fotosPerfil/1.png'),(4,'contact@nttdata.com','$2y$10$4O7NAarfsfjBbmGK.rPpE.BznknTz.LM4wPjxPK4Dqic.QjrbSugC','empresa','/portalDeEmpleo2/fotosPerfil/4.png'),(5,'info@softwaredelsol.com','sol123','empresa','/portalDeEmpleo2/fotosPerfil/5.jpg'),(7,'ana.gomez@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(8,'juan.lopez@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(9,'marta.ruiz@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(11,'LauraSánchezLeón@gmail.com','$2y$10$lQHSGTGKsZYaWCHY02VvYORsBtAsQ1i2rvxXDqATpdYyVP2hnbFPW','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(12,'david.martin@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(13,'patricia.romero@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(14,'sergio.torres@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(15,'elena.molina@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(16,'javier.ortiz@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(17,'lucia.ramos@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(18,'roberto.vargas@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(19,'sofia.navarro@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(20,'diego.castillo@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(21,'natalia.cano@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(22,'andres.santos@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(23,'carla.herrera@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(24,'pablo.garcia@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(25,'irene.flores@email.com','alumno123','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(43,'admin@portalzuelas.com','$2y$10$AQLSsdmcLjM9sHJSAdmMPunZ.LwAy10g/VGNhjsbPnHXmKc2l1duq','admin','/portalDeEmpleo2/fotosPerfil/default.png'),(49,'sdfsdf@fsd.d','$2y$10$TQmtjf8Qn1MhI6yIuRAaFeQY7zu5L2hDoG1vxktgFoLGvdfrA0D.e','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(50,'prueba@gmail.com','$2y$10$z/UoDkPO8ozIS1B.J3y12OYys/AsatcizqK2T47cIEEkrz2WeXgJW','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(52,'nter@gmail.com','$2y$10$Uqppjpa6m/PmHtAcAN96ueFZUB5pHtPXyPR/j7brJPB4L4fNBCZZq','empresa','/portalDeEmpleo2/fotosPerfil/1.png'),(55,'nter2@gmail.com','$2y$10$ODNBFCz5y73y1YyQon8Gk.SXuggjji7yP2bzSw2Zd/tu7L7rl1Rxy','empresa','/portalDeEmpleo2/fotosPerfil/1.png'),(58,'dsada@fds.d','$2y$10$Hm3nt4a87wom0U1kwDIAFuZZarfaviFdJOqsW5ZmmBhtQ6URM0reu','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(61,'laura.fernandez@example.com\n','$2y$10$Ry3sGRDZ7c9084XbuYcr4uhxwq1koKX./u3rOtItPvyozjmxKXFyO','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(62,'carlos.perez@example.com\n','$2y$10$RCg3Edr6TUTChHLJcIscxeuAVWGI7UGR2e8xsUxfWyxGKUKYVekN2','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(63,'ana.martinez@example.com\n','$2y$10$S7Q1QDJIS3w.liUqyCdGS.PTP93PbAYktr4svweItJ6esRLG8nEli','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(64,'javier.sanchez@example.com\n','$2y$10$nDqxfG6r1GC3MU898XErFeRUM3dUCvh7mLQ/VVLzv0quddDuqdddy','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(65,'marta.jimenez@example.com\n','$2y$10$NS9fbgeOxZFzRslB1PMpUOnKxvahcrgy8D7b4SayRtY7NVR2Mrl/u','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(66,'pablo.garcia@example.com\n','$2y$10$iOuqUfyJ.dc45plcQwsa7urNCGltlpSTsgOrcWXUatCOvz1nDTwXy','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(67,'lucia.torres@example.com\n','$2y$10$ulOdXhKeiXzxUHWmh1Ou.e4JW11QcG/31ekQT4hJ5AWULHo0q56j6','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(68,'diego.hernandez@example.com\n','$2y$10$YafdcdWpHIUV42yZmEN5qOGCoqLuCoBa7rLahOVbuFLtxtNygpU0O','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(69,'elena.romero@example.com\n','$2y$10$vOP5MUN8Xbhp9HrAEJ.hqOk32cSbScnQVu7Z3zysy/1iackVLYpjW','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(70,'sergio.navarro@example.com\n','$2y$10$nC3qs64OExiQlJcATWC6puKVihBwOONdc4s40XAckrCyrsFOb9HQe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(71,'cristina.dominguez@example.com\n','$2y$10$No34bQYFPPbIy2/1B4c9EOAFlhEIm45uLr3SOfGvfeDQWaEuD1lNa','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(72,'adrian.ruiz@example.com\n','$2y$10$OckRxNrQXNE71WFYsDfUSOn7MXiS4zMEWEBD2s2OA2EGkJ8tClXca','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(73,'paula.ortega@example.com\n','$2y$10$j9eAOqGAzkmI6l1gNX9NBOGDhnqljho5tBM2nHEM9Sg9BVvZjl0eG','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(74,'raul.moreno@example.com\n','$2y$10$a67gM5RVvCGYO/cxbBcHx./3YoIWNpsenU1n9IIeAMmHulCBOP7km','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(75,'beatriz.castro@example.com\n','$2y$10$DWtbbCUtjbX9t5xQSxq3r.C5XeNgBm.HtXJqbumiX4VrmWNAaAM8m','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(76,'noelia.vargas@example.com\n','$2y$10$C8f.STeMmOP6R7jx0VlMmuC/XvrPrQQTsBJA9/3WVT9HlG47TZ/ma','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(77,'oscar.suarez@example.com\n','$2y$10$24cno4E9G6NjMiyTSiBA0ezXOAgNYA6DQCcTUcIQlb7GuVy9vhM..','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(78,'natalia.ramos@example.com\n','$2y$10$lLz1rbkWRPW8mDiNc2i2QeNqTP2IQkrXuxPMvow2if1ZHZaG95.oC','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(170,'david.lopez@example.com','$2y$10$8W5u6H2Tfp1hFXBrMSiOeuS4TCwk90tYzenKCvBPVmvqtlT0xALpq','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(174,'ivan.crespo@example.comm','$2y$10$O89OSnSaogG.5xmi5K3APukTImy/2VBNy.KvGZ05w3DeDiow3uGsO','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(217,'anueldoblea@gmail.com','$2y$10$0U9/lZLSXmpkc6Kjka2blepGi7YDfJT4L7EMTfUNOFTJu0H2RP.yS','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(268,'asdasdadsolinaruizvictor82@gmail.com','$2y$10$zN5.rrPRuid/ZH04gbHrV.1oH42hANpBkr0BM0J9RKBRzBcpSDDTS','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(281,'laura.fernandez@example.com','$2y$10$u.efBXxpQaU1kModbxuNrOyXXZ84aTXnjs6aewaaIdNcAZWC8IdUe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(282,'undefined@fdsf.d','$2y$10$uejTOfpv8mvygEnrAw3c4eB06UZ5YCLChshAXkoLUvEAuzju.wG26','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(285,'molinaraaauizvictor82@gmail.com','$2y$10$roTTcD.cCuB11nOr9F9FOOpqTgKtBcv7WZTcTNy5RCXjkGhvbqxmS','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(289,'victor@gmail.com','$2y$10$Aajx3LVPOj8.FW0gqe9bUOBsbrfsn9GvYMiPLlcUbmrWnkd1d7pHe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(290,'jperez1@example.com\n','$2y$10$rrJsGjotGMW5kARAQdduS.F7eQgtovxrXJUhPQ6jDScWTUY7XVbYa','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(291,'mgomez2@example.com\n','$2y$10$G/LCX3IHH5PQzpaujr2Xq.ft.5U840GJZqglJv0CxLKlt2nQDRF2K','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(292,'cramirez3@example.com\n','$2y$10$PzLe3Cw4U2s3nPbxaKtT4eWsNdOgYo8Z9xHkD.R.RPxkEFYqANAxO','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(293,'lfernandez4@example.com\n','$2y$10$Jt3lH1uPHYy.ytBY7KE4hOdF3oBft4DUWovYW3COLOHB9m26Vla2y','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(294,'msanchez5@example.com\n','$2y$10$Cb3OoeYBtvbNNCyV/38RtOJlR0BwWlZXzV5qR5T5.jAGEAW2khTTW','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(295,'amartinez6@example.com\n','$2y$10$IzNgmpj1gg0mXozky8H5RuR2jIGCIrwxyzgOKYZRhaFQd2ck/Ckpy','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(296,'pgarcia7@example.com\n','$2y$10$6D5ShZClED7QHpoL6W3UZOTRyA9mTbiDDD8TDnji6qzxG8PaTLxj2','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(297,'shernandez8@example.com\n','$2y$10$Cqq8wrD01actPDV.4n8RUOTIMp2KgoUwV7jj45J5zJX97Yvn0CBxq','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(298,'dtorres9@example.com\n','$2y$10$kDnEBawNnPLp8VvpWopdLuzH5BVrmE/lrl6d/XERvcR67uzpE2WwS','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(299,'elopez10@example.com\n','$2y$10$PUEi3UftEvQkWlLuZmfObO6ojeSnonxJ4OpfhPUJpVMfZvxHpTXRe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(312,'holaadios@gmail.com','$2y$10$MJQdr9LCziq5QBBNM40P8OVZFy4JFyMMQ47ZXRxqaHN2eigxQFUlO','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(313,'pruebaa@gmail.com','$2y$10$ie6O9K0KTacL4RlcoSDXmeHcKIQE0gsl9mPYNemtMZG51cXA/GZde','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(314,'pruebaoferta@gmail.com','$2y$10$yRqbyFPkv8aU9.3LgaMQB.0Bjm..Cv2fWkkK09CG7Pk.vo7SVUbYm','empresa','/portalDeEmpleo2/fotosPerfil/314.png'),(315,'molinaruizvictor82@gmail.com','$2y$10$gdVq0AG75zRHvRL4ceodneqwSdDhsLSU438M99egsP.fFbIbN7tlq','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(316,'admin@fental.com','$2y$10$OUXiy0wXXvoz5KGm6c4g7OlTCHmhMFG/lF3tbEp6uQsH4qz.3Iebu','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(327,'hola@gmail.com','vmr2908006','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(330,'holaa@gmail.com','vmr2908006','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(332,'holaaa@gmail.com','vmr2908006','alumno','/portalDeEmpleo2/fotosPerfil/332'),(333,'holaaaa@gmail.com','vmr2908006','alumno','/portalDeEmpleo2/fotosPerfil/333'),(334,'holaaaaa@gmail.com','vmr2908006','alumno','/portalDeEmpleo2/fotosPerfil/334'),(335,'pacofiesta@gmail.com','$2y$10$7.DoE.7nduNHDtZYbF5fRe0rslBMcMILxV.KWop.pe/OQdCLLTOnC','alumno','/portalDeEmpleo2/fotosPerfil/335.jpg'),(336,'sfsdfsad@fsfd.cmo','$2y$10$YrJBBYTLFN4vecIawL8OlOVfJdvsBHw4zY7/nJ7NLOfb4ZdwLAYUm','alumno','/portalDeEmpleo2/curriculums/336.pdf'),(337,'sfsdsfsad@fsfd.cmo','$2y$10$5x0vZJ3wmhOowpFxWthBS.vkVQMFmCMjQrhwVucJdnqS9uYdGNBoe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(339,'adios@gmail.com','$2y$10$M5YOdM51P74R5Gvquad8sOqIQb6021w63ynlAXfVihSGQIsU/hcX2','empresa','/portalDeEmpleo2/fotosPerfil/339.png'),(340,'adioss@gmail.com','$2y$10$K.wz0LO8f8Mr89HEshju9efKVK6NHS78tq7C3qFKlUG65ghAYAM7C','empresa','/portalDeEmpleo2/fotosPerfil/340.png'),(341,'alumno@gmail.com','$2y$10$NCwRnkAAtSUDyctq./DPquuW9xcrlH7HqwUumGF379P0pKWykSQny','alumno','/portalDeEmpleo2/fotosPerfil/341.png'),(342,'ruben@gmail.com','$2y$10$rQEi2c3KrlkP.ttTdDt78eKUpY6RlxJisJKwkjqsKiyc64gGHjb4S','empresa','/portalDeEmpleo2/fotosPerfil/342.png'),(343,'jasjsdjjdsjsa@asdasd.com','$2y$10$ZJxStRcd8cpMkUg0mBNys.IUysdYakiuaY7Hjt0Jkl6Oh2Dag1osW','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(344,'dsaffadsfds@fdsf.com','$2y$10$5ykZJgZT/zMECCCW3rFSw.h0bUhBCaQNzJyZK9.PpvHrZZ/ck26oK','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(346,'prueba1@gmail.com','$2y$10$0tCE8XcBEfKv2bZ6rjU1fOhE2BoJWKQsdUwsw.Cdio9DmQ/gIP97u','empresa','/portalDeEmpleo2/fotosPerfil/default.png'),(357,'prueba2@gmail.com','$2y$10$bSdqSKuZHXSk85PH3xBtFuqYhjqbvkfbdCEGYdCsJDHY1SArJpoLq','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(358,'prueba3@gmail.com','$2y$10$9JyybqOmGIvKC0GI12cmYu.WYFx/ZtDzu9cDlEWI9GJJ0bvT535p2','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(360,'prueba4@gmail.com','$2y$10$7ZRtz3GCJ7BtJzK3/9kwkeey8c4jMSGkNEQ99m9DUyu8I5W2k3qla','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(361,'prueba6@example.com\n','$2y$10$Xo4s5tDXBRJdqZAI9UnbPu/2A./IAfFqNyXBAmkDrimYx8lEfzW0G','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(362,'prueba5@example.com\n','$2y$10$LyyEvfHOQrWKY5SVZh52keYEHm9HdxRTyqjR16QQ.on3z9.WaV/Ha','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(365,'prueba7@gmail.comm','$2y$10$9lXGvfFunDOK0Gcza/hPWeuOuig1HJqzw0cQjvXHVvAxrKA4cimGe','alumno','/portalDeEmpleo2/fotosPerfil/default.png'),(367,'0123456789@gmail.com','$2y$10$4jlT8J9/cuMGpJIDK0TmLezvV2iUa7xEoAzfiZKIZaLFh90TgcNs6','alumno','/portalDeEmpleo2/fotosPerfil/default.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-17 17:38:28
