-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: db_artean
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cv`
--

DROP TABLE IF EXISTS `cv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txt_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `textcv` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_B66FFE92CB944F1A` (`student_id`),
  CONSTRAINT `FK_B66FFE92CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cv`
--

LOCK TABLES `cv` WRITE;
/*!40000 ALTER TABLE `cv` DISABLE KEYS */;
INSERT INTO `cv` VALUES (1,2,'CV-AnderFragoLanda.pdf','phpti4oU6','/var/db_docs/cv/phpti4oU6','/var/db_docs/txt/phpti4oU6','Ander Frago Landa • anderfrago@hotmail.com • 620831445\n<br/>\n<br/>Ander Frago Landa\n<br/>Fecha de nacimiento: 23/01/1985\n<br/>Calle Río Arga, Pamplona, Navarra, 31014\n<br/>anderfrago@hotmail.com\n<br/>\n<br/>620831445\n<br/>\n<br/>linkedin.com/in/ander-f-l\n<br/>\n<br/>github.com/afrago\n<br/>\n<br/>EXPERIENCIA PROFESIONAL\n<br/>03/2016 a 09/2016 Software Engineer Again, Pamplona, Navarra\n<br/>Desarrollo de aplicaciones industriales con Ignition, Inductive Automation.\n<br/>07/2014 a 01/2016 Ingeniero Informática Departamento I+D Energía Jofemar, Peralta, Navarra\n<br/>Desarrollo aplicaciones de escritorio para usuarios científicos: c#, Splunk, CanLib.\n<br/>06/2012 a 10/2013 Desarrollador Indaba (Grupo LKS), San Sebastián y Mondragón, Guipúzcoa\n<br/>Migración de Oracle Forms a Java de una aplicación de Gestión de Almacén.\n<br/>Soporte Módulo de Gestión Comercial, aplicación desarrollada en Oracle Forms y Reports.\n<br/>02/2010 a 02/2011 Desarrollador Ulma Handling System, Oñate, Guipúzcoa\n<br/>Sistema de hosting para sistemas de gestión de almacenes (Cloud Computing).\n<br/>Análisis, desarrollo e implantación de un Sistema de Gestión de Almacenes (SGA) realizado\n<br/>con tecnología J2EE.\n<br/>07/2005 a 10/2005 Técnico Informático (Becario) Financial Times Interactive Data, Dublin, Ireland\n<br/>Adaptar la información de un software antiguo a otro más moderno.\n<br/>\n<br/>COMPETENCIAS PROFESIONALES:\n<br/>•\n<br/>•\n<br/>•\n<br/>•\n<br/>•\n<br/>\n<br/>Organización: Gestión de las tareas a realizar dentro de cada proyecto, Scrum.\n<br/>Trabajo en equipo: Desarrollo de aplicaciones dentro de un equipo multidisciplinar\n<br/>haciendo uso de metodologías ágiles, Kanban.\n<br/>Atención al cliente: Construir relaciones positivas con los clientes, capacidad para resolver\n<br/>situaciones con clientes difíciles.\n<br/>Tolerancia al estrés: Organización preparando un viaje, implantación de SGA en un\n<br/>invernadero automatizado en El ejido, Almería. Proyecto de i+d Cenit Mediodía.\n<br/>Internacionalización: Adaptarse a diferentes culturas.\n<br/>\n<br/>Nadie es tan grande como para no poder aprender, nadie es tan pequeño como para no poder enseñar.\n<br/>\n<br/>EXPERIENCIA PROFESIONAL DOCENTE\n<br/>09/2016 a 09/2020 Docente Formación Profesional Cuatrovientos, Pamplona, Navarra\n<br/>Docente en FP Superior: Desarrollo de Aplicaciones Multiplataforma y Administración de\n<br/>Sistemas Informáticos.\n<br/>01/2016 a 02/2016 Docente Formación Profesional (Prácticas) Cuatrovientos, Pamplona, Navarra\n<br/>Trabajo Fin de Máster: Aplicación de metodologías ágiles en educación (Taiga.io).\n<br/>04/2014 a 04/2014 Docente de Excel Sistema, Pamplona, Navarra\n<br/>10/2011 a 01/2012 Docente de Redes Sociales e Internet Personal System, Pamplona, Navarra\n<br/>\n<br/>COMPETENCIAS PROFESIONALES DOCENTE:\n<br/>•\n<br/>•\n<br/>•\n<br/>•\n<br/>\n<br/>Planificación: Planificar, desarrollar y evaluar el proceso de enseñanza y aprendizaje.\n<br/>Comunicación: Capacidad para transmitir los conocimientos a aprender.\n<br/>Compromiso: Superación de retos, consecución de logros mediante el esfuerzo. Obtención\n<br/>de la titulación al mismo tiempo que trabajaba sin dejar de lado ninguna de las dos tareas.\n<br/>Automotivación: Valorar los logros personales, los alumnos adquirieron capacidades y\n<br/>habilidades de manera satisfactoria.\n<br/>\n<br/>1\n<br/>\n<br/>Ander Frago Landa • anderfrago@hotmail.com • 620831445\n<br/>\n<br/>FORMACIÓN ACADEMICA\n<br/>2014-2016\n<br/>2014\n<br/>2006-2011\n<br/>2003-2005\n<br/>\n<br/>Máster Formación de Profesorado para Educación Secundaria UNIR\n<br/>Ingeniero Grado en Informática Mondragon Unibertsitatea (MU)\n<br/>Ingeniería Técnica en Informática de Sistemas MU\n<br/>FP Grado Superior en Telecomunicaciones e Informática de Sistemas MU\n<br/>\n<br/>FORMACIÓN COMPLEMENTARIA\n<br/>2020\n<br/>2019\n<br/>2018\n<br/>2014\n<br/>2012\n<br/>2012\n<br/>2011\n<br/>\n<br/>Experto en Ciencia de Datos y BigData para Bussiness Inteligence (440 horas) UPNA\n<br/>Curso especialización en Deep learning (50 horas) MU\n<br/>CCNA Cisco Networking (240 horas) Cuatrovientos\n<br/>Experto Profesional en Desarrollo de Aplicaciones Web (285 horas) Sistema\n<br/>Experto en Aplicaciones y Servicios sobre Dispositivos Móviles (500 horas) UNED\n<br/>Desarrollo de Aplicaciones Corporativas en Software Libre (275 horas) Sistema\n<br/>Curso Experto en Seguridad Informática (150 horas) MU\n<br/>\n<br/>IDOMAS\n<br/>Nivel medio de Ingles\n<br/>Nivel alto de Euskera\n<br/>\n<br/>First Certificate, estancias en Irlanda, Nueva Zelanda y Canadá\n<br/>Nativo\n<br/>\n<br/>CONOCIMIENTOS INFORMÁTICA\n<br/>Gestión de proyectos:\n<br/>• Metodologías de trabajo ágiles: Scrum y Kanban\n<br/>• Control de versiones: Git, Subversion (SVN)\n<br/>Análisis y diseño de proyectos: Unified Modeling Language (UML)\n<br/>\n<br/>CIENCIA DE DATOS, BIG DATA y DEEP LEARNING:\n<br/>Análisis exploratorio de datos,\n<br/>Pre-procesamiento y Extracción de conocimiento:\n<br/>\n<br/>Microsoft PowerQuery.\n<br/>Python: Numpy, Pandas, scikit-learn, Matplotlib\n<br/>\n<br/>Big Data y Deep Learning\n<br/>\n<br/>PySpark y Keras\n<br/>\n<br/>DESARROLLO DE APLICACIONES:\n<br/>Dispositivos móviles:\n<br/>\n<br/>Hibridas: TypeScript: Ionic,\n<br/>Nativas: Java: Android\n<br/>\n<br/>Desarrollo Web\n<br/>\n<br/>PHP: Symfony\n<br/>TypeScript: Angular, React, Gatby\n<br/>Python: Django, Flask\n<br/>C#: Asp.Net MVC,\n<br/>Java: Adobe Flex\n<br/>\n<br/>Aplicaciones de Escritorio:\n<br/>\n<br/>C# .Net: TPL DataFlow,\n<br/>Java: JavaFX\n<br/>\n<br/>INFORMÁTICA DE SISTEMAS:\n<br/>Servicios en Red e Internet\n<br/>\n<br/>DHCP, DNS, HTTP y FTP sobre Windows Server y Linux\n<br/>\n<br/>Implantación de Sistemas Operativos:\n<br/>\n<br/>Administración avanzada y Scripting:\n<br/>•\n<br/>Windows cliente: Batch\n<br/>•\n<br/>Windows Server: PowerShell\n<br/>•\n<br/>Ubuntu (GNU/Linux): Bash\n<br/>\n<br/>Ordenador de placa reducida: Linux embebido\n<br/>\n<br/>Raspberry pi, Beaglebone\n<br/>•\n<br/>Qt framework, Yocto, Buildroot\n<br/>8052, Arduino.\n<br/>•\n<br/>Conocimientos avanzados de lenguaje C\n<br/>OPC: Kepware, Java: Ignition SDK, Maven Python:\n<br/>Ignition\n<br/>\n<br/>Microprocesadores:\n<br/>Supervisión, control y adquisición de datos (SCADA)\n<br/>\n<br/>2\n<br/>\n<br/>Ander Frago Landa • anderfrago@hotmail.com • 620831445\n<br/>\n<br/>3\n<br/>\n<br/><br/>');
/*!40000 ALTER TABLE `cv` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-08 16:23:34
