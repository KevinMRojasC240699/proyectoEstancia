-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: sistemaalimentos4
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `id_ad` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Administrador',
  `Usuarios_idUsuarios` int NOT NULL COMMENT 'ID del usuario asociado',
  PRIMARY KEY (`id_ad`),
  KEY `Usuarios_idUsuarios` (`Usuarios_idUsuarios`),
  CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora_paciente`
--

DROP TABLE IF EXISTS `bitacora_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora_paciente` (
  `id_bitacora` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `fecha` date NOT NULL,
  `nombre_platillo` varchar(255) NOT NULL,
  `tipo_comida` varchar(50) NOT NULL,
  `comentario` text,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `consumido` enum('si','no') NOT NULL,
  PRIMARY KEY (`id_bitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora_paciente`
--

LOCK TABLES `bitacora_paciente` WRITE;
/*!40000 ALTER TABLE `bitacora_paciente` DISABLE KEYS */;
INSERT INTO `bitacora_paciente` VALUES (1,3,'2024-12-01','Tacos','almuerzo','','2024-12-01 18:21:40','si'),(2,3,'2024-12-01','Tacos','almuerzo','','2024-12-01 18:21:45','no');
/*!40000 ALTER TABLE `bitacora_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador del menu',
  `nombre_platillo` varchar(50) NOT NULL COMMENT 'Nombre del platillo',
  `fecha` date NOT NULL COMMENT 'Fecha del menu',
  `tipo_comida` varchar(10) NOT NULL COMMENT 'Tipo de comida (almuerzo, comida, cena)',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Milanesa','2024-11-29','almuerzo'),(2,'Tacos','2024-11-30','comida'),(3,'Tacos','2024-11-30','comida'),(4,'Tacos','2024-11-30','cena'),(5,'Platanos','2024-11-30','cena'),(6,'Tacos','2024-12-01','cena'),(8,'Tacos','2024-12-01','almuerzo'),(9,'Fresas','2024-12-03','comida'),(10,'Fresas','2024-12-04','almuerzo');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutriologos`
--

DROP TABLE IF EXISTS `nutriologos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutriologos` (
  `id_nut` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Nutriologos',
  `especialidad` varchar(25) NOT NULL COMMENT 'Especialidad del nutriologo',
  `Usuarios_idUsuarios` int NOT NULL COMMENT 'ID del usuario asociado',
  `fecha_ingreso` date DEFAULT NULL,
  PRIMARY KEY (`id_nut`),
  KEY `Usuarios_idUsuarios` (`Usuarios_idUsuarios`),
  CONSTRAINT `nutriologos_ibfk_1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutriologos`
--

LOCK TABLES `nutriologos` WRITE;
/*!40000 ALTER TABLE `nutriologos` DISABLE KEYS */;
INSERT INTO `nutriologos` VALUES (1,'Deportiva',2,'2024-11-26'),(5,'Deportiva',8,'2024-11-30'),(6,'Deportiva',9,'2024-11-30'),(7,'Deportiva',11,'2024-12-01');
/*!40000 ALTER TABLE `nutriologos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutriologos_has_platillos`
--

DROP TABLE IF EXISTS `nutriologos_has_platillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutriologos_has_platillos` (
  `nutriologos_id_pac` int NOT NULL COMMENT 'ID del nutriologos',
  `platillos_id_pla` int NOT NULL COMMENT 'ID del platillo',
  PRIMARY KEY (`nutriologos_id_pac`,`platillos_id_pla`),
  KEY `platillos_id_pla` (`platillos_id_pla`),
  CONSTRAINT `nutriologos_has_platillos_ibfk_1` FOREIGN KEY (`nutriologos_id_pac`) REFERENCES `nutriologos` (`id_nut`),
  CONSTRAINT `nutriologos_has_platillos_ibfk_2` FOREIGN KEY (`platillos_id_pla`) REFERENCES `platillos` (`id_pla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutriologos_has_platillos`
--

LOCK TABLES `nutriologos_has_platillos` WRITE;
/*!40000 ALTER TABLE `nutriologos_has_platillos` DISABLE KEYS */;
INSERT INTO `nutriologos_has_platillos` VALUES (1,3),(1,8);
/*!40000 ALTER TABLE `nutriologos_has_platillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutriologos_pacientes`
--

DROP TABLE IF EXISTS `nutriologos_pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutriologos_pacientes` (
  `id_nutriologo_paciente` int NOT NULL AUTO_INCREMENT,
  `nutriologo_id` int DEFAULT NULL,
  `paciente_id` int DEFAULT NULL,
  PRIMARY KEY (`id_nutriologo_paciente`),
  KEY `nutriologo_id` (`nutriologo_id`),
  KEY `paciente_id` (`paciente_id`),
  CONSTRAINT `nutriologos_pacientes_ibfk_1` FOREIGN KEY (`nutriologo_id`) REFERENCES `nutriologos` (`id_nut`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nutriologos_pacientes_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_pac`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutriologos_pacientes`
--

LOCK TABLES `nutriologos_pacientes` WRITE;
/*!40000 ALTER TABLE `nutriologos_pacientes` DISABLE KEYS */;
INSERT INTO `nutriologos_pacientes` VALUES (1,1,1),(2,1,4);
/*!40000 ALTER TABLE `nutriologos_pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes` (
  `id_pac` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Pacientes',
  `Usuarios_idUsuarios` int NOT NULL COMMENT 'ID del usuario asociado',
  PRIMARY KEY (`id_pac`),
  KEY `Usuarios_idUsuarios` (`Usuarios_idUsuarios`),
  CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuarios` (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,3),(4,12);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes_has_platillos`
--

DROP TABLE IF EXISTS `pacientes_has_platillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes_has_platillos` (
  `pacientes_id_pac` int NOT NULL COMMENT 'ID del paciente',
  `platillos_id_pla` int NOT NULL COMMENT 'ID del platillo',
  PRIMARY KEY (`pacientes_id_pac`,`platillos_id_pla`),
  KEY `platillos_id_pla` (`platillos_id_pla`),
  CONSTRAINT `pacientes_has_platillos_ibfk_1` FOREIGN KEY (`pacientes_id_pac`) REFERENCES `pacientes` (`id_pac`),
  CONSTRAINT `pacientes_has_platillos_ibfk_2` FOREIGN KEY (`platillos_id_pla`) REFERENCES `platillos` (`id_pla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes_has_platillos`
--

LOCK TABLES `pacientes_has_platillos` WRITE;
/*!40000 ALTER TABLE `pacientes_has_platillos` DISABLE KEYS */;
INSERT INTO `pacientes_has_platillos` VALUES (1,1),(1,2),(1,4),(1,7);
/*!40000 ALTER TABLE `pacientes_has_platillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes_menus`
--

DROP TABLE IF EXISTS `pacientes_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes_menus` (
  `id_paciente_menu` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la asignación de menú a paciente',
  `paciente_id` int NOT NULL COMMENT 'ID del paciente',
  `menu_id` int NOT NULL COMMENT 'ID del menú',
  `nutriologo_id` int NOT NULL COMMENT 'ID del nutriólogo que asignó el menú',
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_paciente_menu`),
  KEY `paciente_id` (`paciente_id`),
  KEY `menu_id` (`menu_id`),
  KEY `nutriologo_id` (`nutriologo_id`),
  CONSTRAINT `pacientes_menus_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_pac`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pacientes_menus_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pacientes_menus_ibfk_3` FOREIGN KEY (`nutriologo_id`) REFERENCES `nutriologos` (`id_nut`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes_menus`
--

LOCK TABLES `pacientes_menus` WRITE;
/*!40000 ALTER TABLE `pacientes_menus` DISABLE KEYS */;
INSERT INTO `pacientes_menus` VALUES (1,1,1,1,'2024-11-29'),(2,1,1,1,'2024-11-30'),(3,1,1,1,'2024-11-30');
/*!40000 ALTER TABLE `pacientes_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platillos`
--

DROP TABLE IF EXISTS `platillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platillos` (
  `id_pla` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Platillos',
  `nombre_platillo` varchar(25) NOT NULL COMMENT 'Nombre del platillo',
  `descripcion` varchar(50) NOT NULL COMMENT 'Descripción del platillo',
  `cantidad` varchar(25) NOT NULL COMMENT 'Cantidad de porción',
  `fecha` date NOT NULL COMMENT 'Fecha de creación del platillo',
  `verificacion` tinyint NOT NULL COMMENT 'Verificación del platillo',
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_pla`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (1,'Tacos','de res','3','2024-11-26',0,'2024-11-26'),(2,'Tacos','de pastor','3','2024-11-26',0,'2024-11-26'),(3,'Milanesa','De Pollo','2','2024-11-29',0,NULL),(4,'Fresas','Fruta','2','2024-11-30',0,NULL),(5,'Tacos','Dorados','3','2024-11-30',0,NULL),(7,'Filete','Pescado','2','2024-12-01',0,'2024-12-01'),(8,'Fresas','Frutas','2','2024-12-01',0,'2024-12-01');
/*!40000 ALTER TABLE `platillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platillos_has_menu`
--

DROP TABLE IF EXISTS `platillos_has_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platillos_has_menu` (
  `platillos_id_pla` int NOT NULL COMMENT 'ID del platillo',
  `menu_id_menu` int NOT NULL COMMENT 'ID del menu',
  PRIMARY KEY (`platillos_id_pla`,`menu_id_menu`),
  KEY `menu_id_menu` (`menu_id_menu`),
  CONSTRAINT `platillos_has_menu_ibfk_1` FOREIGN KEY (`platillos_id_pla`) REFERENCES `platillos` (`id_pla`),
  CONSTRAINT `platillos_has_menu_ibfk_2` FOREIGN KEY (`menu_id_menu`) REFERENCES `menu` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos_has_menu`
--

LOCK TABLES `platillos_has_menu` WRITE;
/*!40000 ALTER TABLE `platillos_has_menu` DISABLE KEYS */;
INSERT INTO `platillos_has_menu` VALUES (3,1),(1,2),(2,3),(1,4),(4,5),(5,6),(1,8),(8,9),(8,10);
/*!40000 ALTER TABLE `platillos_has_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuarios` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Usuarios',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre del usuario',
  `apellido` varchar(25) NOT NULL COMMENT 'Apellido del usuario',
  `fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento del usuario',
  `telefono` varchar(10) NOT NULL COMMENT 'Teléfono del usuario',
  `usuario` varchar(25) NOT NULL COMMENT 'Nombre de usuario',
  `contrasena` varchar(65) NOT NULL COMMENT 'Contraseña del usuario',
  `genero` varchar(15) NOT NULL COMMENT 'Género del usuario',
  `tipo` varchar(15) NOT NULL COMMENT 'Tipo del usuario',
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'roberto','Pérez','1990-05-15','1234567890','ana','password12','Masculino','admi','2024-11-26'),(2,'kevin','Rojas','2024-11-26','7775358117','kev','1234','masculino','nutriologo','2024-11-26'),(3,'Laura','Guzman','2024-11-26','7775358117','yeli','1234','femenino','usuario','2024-11-26'),(8,'Lourdes','Cruz','2024-11-30','7775358117','lou','1234','femenino','nutriologo',NULL),(9,'kevin','Rojas','2024-11-30','7775358117','mis','1234','masculino','nutriologo','2024-11-30'),(11,'Rodrigo','Rojas','2024-12-01','7775358117','rod','1234','masculino','nutriologo','2024-12-01'),(12,'Kenia','Cruz','2024-12-01','7775358117','ken','1234','femenino','usuario','2024-12-01');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-01 12:49:16
