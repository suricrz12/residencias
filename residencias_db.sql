-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2020 a las 20:59:12
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `residencias_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(0, 'NINGUNA'),
(1, 'ING. SISTEMAS COMPUTACIONALES'),
(2, 'ING. INDUSTRIAL'),
(3, 'ING. GESTION EMPRESARIAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_documentos`
--

CREATE TABLE `catalogo_documentos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `abreviatura` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalogo_documentos`
--

INSERT INTO `catalogo_documentos` (`id`, `nombre`, `abreviatura`) VALUES
(1, 'CARTA DE ASIGNACIÓN', 'ASN'),
(2, 'ANTEPROYECTO', 'ANT'),
(3, 'REPORTE MENSUAL DE RESIDENCIA PROFESIONAL', 'RMR'),
(4, 'EVALUACIÓN DEL RESIDENTE POR EL ASESOR INTERNO', 'EAI'),
(5, 'EVALUACIÓN DEL RESIDENTE POR EL ASESOR EXTERNO', 'EAE'),
(6, 'AUTORIZACIÓN DE INFORME FINAL DE RESIDENCIA', 'AIF'),
(7, 'REPORTE FINAL', 'RFR'),
(8, 'CARTA DE ACEPTACIÓN', 'CDA'),
(9, 'KARDEX', 'KAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_entregados`
--

CREATE TABLE `documentos_entregados` (
  `id` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL COMMENT 'usuarios.id (alumno)',
  `id_catalogo_documentos` int(11) NOT NULL COMMENT 'catalogos_documentos.id',
  `folio` varchar(20) NOT NULL,
  `fecha_subido` datetime NOT NULL,
  `status_coordinador` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Sin revisar 1:Aceptado 2:Rechazado',
  `comentarios_coordinador` text NOT NULL DEFAULT '',
  `fecha_revision_coordinador` datetime NOT NULL,
  `status_asesor` tinyint(11) NOT NULL DEFAULT 0 COMMENT '0:Sin revisar 1:Aceptado 2:Rechazado',
  `comentarios_asesor` text NOT NULL DEFAULT '',
  `fecha_revision_asesor` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentos_entregados`
--

INSERT INTO `documentos_entregados` (`id`, `id_usuarios`, `id_catalogo_documentos`, `folio`, `fecha_subido`, `status_coordinador`, `comentarios_coordinador`, `fecha_revision_coordinador`, `status_asesor`, `comentarios_asesor`, `fecha_revision_asesor`) VALUES
(4, 28, 3, 'RMR5_28', '2020-07-14 15:28:21', 1, '', '2020-07-15 00:10:20', 1, 'BOB ESPONJA', '2020-07-14 23:56:13'),
(7, 28, 1, 'ASN_28', '2020-07-14 17:17:35', 1, 'DAEFEFEF', '2020-07-14 23:46:30', 1, '', '2020-07-15 00:12:49'),
(8, 28, 8, 'CDA_28', '2020-07-14 17:17:43', 1, '1', '2020-07-15 00:09:04', 1, '', '2020-07-15 00:12:58'),
(9, 28, 2, 'ANT_28', '2020-07-14 17:17:50', 1, '1', '2020-07-15 00:09:35', 1, '', '2020-07-15 00:13:04'),
(10, 28, 3, 'RMR1_28', '2020-07-14 17:18:01', 1, '', '2020-07-15 00:10:05', 1, '', '2020-07-15 00:13:10'),
(11, 28, 3, 'RMR2_28', '2020-07-14 17:18:07', 1, '', '2020-07-15 00:10:09', 1, '', '2020-07-15 00:13:14'),
(12, 28, 4, 'EAI_28', '2020-07-14 17:34:15', 1, '', '2020-07-15 00:10:27', 1, '', '2020-07-15 00:13:32'),
(13, 28, 5, 'EAE_28', '2020-07-14 17:34:22', 1, '', '2020-07-15 00:10:31', 1, '', '2020-07-15 00:13:38'),
(14, 28, 6, 'AIF_28', '2020-07-14 17:34:30', 1, '', '2020-07-15 00:10:39', 1, '', '2020-07-15 00:13:46'),
(15, 28, 7, 'RFR_28', '2020-07-14 17:34:36', 1, '', '2020-07-15 00:10:45', 1, '', '2020-07-15 00:17:07'),
(16, 28, 9, 'KAR_28', '2020-07-14 22:46:08', 1, '1', '2020-07-15 00:08:55', 1, '', '2020-07-15 00:12:45'),
(17, 28, 3, 'RMR3_28', '2020-07-15 00:49:02', 1, '', '2020-07-15 00:50:28', 1, '', '2020-07-15 00:51:35'),
(18, 28, 3, 'RMR4_28', '2020-07-15 00:49:28', 1, '', '2020-07-15 00:50:41', 1, '', '2020-07-15 00:51:41'),
(20, 23, 9, 'KAR_23', '2020-07-16 11:26:09', 1, 'CHIDO', '2020-07-16 12:45:09', 1, 'DFG', '2020-07-16 12:51:59'),
(21, 28, 3, 'RMR6_28', '2020-07-16 12:57:10', 0, '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(11) NOT NULL,
  `grado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `grado`) VALUES
(1, 'INGENIERÍA'),
(2, 'LICENCIATURA'),
(3, 'MAESTRÍA'),
(4, 'DOCTORADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rango` tinyint(11) NOT NULL COMMENT '1:Coordinador 2:Asesor 3:Alumno',
  `id_carrera` int(11) NOT NULL DEFAULT 0 COMMENT 'carrera.id',
  `email` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `asesor` int(11) NOT NULL DEFAULT 0 COMMENT 'usuarios.id',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0:inactivo 1:activo 2:finalizado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rango`, `id_carrera`, `email`, `password`, `fecha_registro`, `asesor`, `status`) VALUES
(10, 1, 0, 'Lmsiliceov@misantla.tecnm.mx', '12345', '2020-07-11 00:00:00', 0, 1),
(11, 2, 1, 'andres@gmail.com', '12345', '2020-07-11 00:00:00', 0, 1),
(12, 2, 2, 'romangomez@gmail.com', '12345', '2020-07-11 02:05:45', 0, 1),
(23, 3, 2, 'arcade2323@gmail.com', '12345', '2020-07-11 02:06:30', 11, 1),
(27, 3, 2, 'soyunagarrapata@gmail.com', '12345', '2020-07-11 02:12:45', 11, 1),
(28, 3, 1, 'arcade2020do@hotmail.com', '12345', '2020-07-11 02:17:17', 12, 2),
(50, 3, 2, 'injustice2020do@hotmail.com', 'I3JRMWD3', '2020-07-15 02:37:57', 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE `usuarios_informacion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'usuarios.id',
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `curp` varchar(18) COLLATE utf8_spanish_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `promedio_anterior` decimal(10,2) NOT NULL,
  `promedio_general` decimal(10,2) NOT NULL,
  `id_grado` int(11) NOT NULL COMMENT 'grado.id',
  `titulo` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ESTUDIANTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_informacion`
--

INSERT INTO `usuarios_informacion` (`id`, `id_usuario`, `nombre`, `apellidos`, `telefono`, `curp`, `semestre`, `promedio_anterior`, `promedio_general`, `id_grado`, `titulo`) VALUES
(1, 11, 'ANDRES', 'AGUILERA MONTIEL', '2326463799', '', 0, '0.00', '0.00', 1, 'MAESTRO EN SISTEMAS XD'),
(2, 12, 'MARIA', 'ROMAN GOMEZ', '2461464686', '', 0, '0.00', '0.00', 2, 'INGENIERO INDUSTRIAL'),
(13, 10, 'FRANCISCO ADOLFO2', 'AGUILAR GOMEZ3', '2326463798', '', 0, '0.00', '0.00', 1, 'MAESTRO EN SISTEMAS COMPUTACIONALES'),
(16, 23, 'PEPITO', 'SANCHEZ PEREZ', '2351305973', 'EIDK463763CMVFCKBM', 12, '78.40', '43.60', 0, ''),
(17, 28, 'DANIEL', 'AGUILAR ROMAN', '2326463798', 'ROCD960402MVZMBN09', 11, '83.00', '96.00', 0, ''),
(18, 27, 'JUAN', 'SOLIS HERNANDEZ', '3242726462', 'EIDK463763CMVFCKBM', 11, '99.00', '32.00', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `catalogo_documentos`
--
ALTER TABLE `catalogo_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos_entregados`
--
ALTER TABLE `documentos_entregados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogo_documentos` (`id_catalogo_documentos`),
  ADD KEY `usuarios` (`id_usuarios`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carreras` (`id_carrera`);

--
-- Indices de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_informacion` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo_documentos`
--
ALTER TABLE `catalogo_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `documentos_entregados`
--
ALTER TABLE `documentos_entregados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos_entregados`
--
ALTER TABLE `documentos_entregados`
  ADD CONSTRAINT `catalogo_documentos` FOREIGN KEY (`id_catalogo_documentos`) REFERENCES `catalogo_documentos` (`id`),
  ADD CONSTRAINT `usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `carreras` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`);

--
-- Filtros para la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD CONSTRAINT `usuarios_informacion` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
