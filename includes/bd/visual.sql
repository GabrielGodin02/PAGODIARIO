-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2024 a las 18:25:54
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `visual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `id_usuario` int(12) NOT NULL,
  `id_pagodiario` int(11) DEFAULT NULL,
  `cantidad` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `deuda` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pendiente',
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_aceptado` timestamp NULL DEFAULT NULL,
  `fecha_completado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_prestamo`, `id_usuario`, `id_pagodiario`, `cantidad`, `deuda`, `estado`, `fecha_solicitud`, `fecha_aceptado`, `fecha_completado`) VALUES
(10, 45, 111, '300000', '310000', 'Rechazada', '2023-11-22 14:33:08', NULL, NULL),
(28, 1118808995, 1118805275, '10000', '-127', 'Completado', '2023-12-18 00:13:21', '2023-12-18 02:11:35', NULL),
(29, 1114404444, 1118805275, '50000', '60000', 'Rechazada', '2023-12-18 00:53:30', NULL, NULL),
(30, 1118805276, 1118805275, '13000', '-221', 'Completado', '2023-12-18 00:54:07', '2023-12-18 02:12:05', NULL),
(31, 1114404444, 1118805275, '10000', '12000', 'Rechazada', '2023-12-27 01:02:33', NULL, NULL),
(32, 1118805276, 1118805275, '15000', '18000', 'Rechazada', '2023-12-27 16:11:14', NULL, NULL),
(33, 1118805276, 1118805275, '24000', '28000', 'Rechazada', '2023-12-27 16:25:55', '2023-12-28 04:10:22', NULL),
(34, 1114404444, 1118805275, '10000', '2300', 'Rechazada', '2023-12-28 04:21:47', '2023-12-28 04:24:08', NULL),
(38, 1118808995, 1118805275, '20000', '24000', 'Rechazada', '2023-12-29 21:33:10', '2023-12-30 00:41:31', NULL),
(39, 1118805276, 1118805275, '12000', '4400', 'Rechazada', '2023-12-30 00:56:50', '2023-12-30 19:38:05', NULL),
(40, 1118805276, 1118805275, '20000', '0', 'Completado', '2023-12-30 19:58:51', '2023-12-30 19:59:36', NULL),
(41, 1118805276, 1118805275, '10000', '5000', 'Aceptada', '2024-01-03 20:08:01', '2024-01-03 20:08:57', NULL),
(42, 1114404444, 1118805275, '13000', '15600', 'Aceptada', '2024-01-03 20:09:43', '2024-01-03 20:11:15', NULL),
(43, 1118808995, 1118805275, '10000', '12000', 'pendiente', '2024-01-03 21:10:55', NULL, NULL);

--
-- Disparadores `prestamo`
--
DELIMITER $$
CREATE TRIGGER `abono_capital` AFTER UPDATE ON `prestamo` FOR EACH ROW IF NEW.deuda < OLD.deuda THEN
        -- Actualizar la columna capital en la tabla pagodiario
        UPDATE registro
        SET capital = capital + (OLD.deuda - NEW.deuda) WHERE ident = NEW.id_pagodiario;
        UPDATE reportes
SET balance = balance + (OLD.deuda - NEW.deuda)
WHERE id_pagodiario = NEW.id_pagodiario
  AND DATE_FORMAT(CURRENT_TIMESTAMP, "%Y-%m") = DATE_FORMAT(reportes.create_time, "%Y-%m");
        END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `aceptar_prestamo` BEFORE UPDATE ON `prestamo` FOR EACH ROW BEGIN
    IF NEW.estado = 'Aceptada' AND OLD.estado = 'Pendiente' THEN
        -- Setear la columna fecha_aceptado al timestamp actual
        SET NEW.fecha_aceptado = CURRENT_TIMESTAMP;

        -- Actualizar la tabla registro
        UPDATE registro
        SET capital = capital - NEW.cantidad
        WHERE ident = NEW.id_pagodiario;
        UPDATE reportes
SET aceptados = aceptados + 1, total = total + NEW.cantidad, balance = balance - NEW.cantidad
WHERE id_pagodiario = NEW.id_pagodiario
  AND DATE_FORMAT(CURRENT_TIMESTAMP, "%Y-%m") = DATE_FORMAT(reportes.create_time, "%Y-%m");
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `fecha_completado` BEFORE UPDATE ON `prestamo` FOR EACH ROW IF NEW.deuda <= 0 THEN
	SET NEW.fecha_completado = CURRENT_TIMESTAMP; 
    UPDATE reportes
SET completados = completados + 1
WHERE id_pagodiario = NEW.id_pagodiario
  AND DATE_FORMAT(CURRENT_TIMESTAMP, "%Y-%m") = DATE_FORMAT(reportes.create_time, "%Y-%m");
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reportar_solicitud` AFTER INSERT ON `prestamo` FOR EACH ROW UPDATE reportes
SET solicitudes = solicitudes + 1
WHERE id_pagodiario = NEW.id_pagodiario
  AND DATE_FORMAT(NEW.fecha_solicitud, "%Y-%m") = DATE_FORMAT(reportes.create_time, "%Y-%m")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `telefono` bigint(11) DEFAULT NULL,
  `ident` int(12) NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `profesion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `capital` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`nombre`, `apellidos`, `direccion`, `telefono`, `ident`, `email`, `password`, `estado`, `profesion`, `fecha`, `admin`, `capital`) VALUES
('oscar', 'beto', '', NULL, 44, 'omarpimienta0208@gmail.com', '', 'casad@', NULL, '2023-09-12', 0, 0),
('carlos', 'martines', '', NULL, 45, 'gf@gmail.com', '', 'union libre', NULL, '2023-09-07', 0, 0),
('natalia', 'dd', '', NULL, 66, 'gabriel.godin@misena.edu.co', '', 'casad@', NULL, '2023-08-29', 0, 0),
('gabriel', 'godin', '', NULL, 111, 'gabrielgodin02@gmail.com', '', 'solter@', NULL, '2023-09-03', 1, 100000),
('pedro', 'godin', '', NULL, 333, 'pitchmarkel7@hotmail.com', '', 'solter@', NULL, '2023-09-12', 0, 0),
('pepe', 'grillo', 'europa XVII', 3332211444, 1114404444, 'pepito@gmail.com', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 'solter@', 'consejero', '1940-01-18', 0, 0),
('Alex', 'Valdelamar Bustamante', 'cr24b#12b', 3208051693, 1118805275, 'valdelex3@gmail.com', '*D192AAB1D7C0E29EF71A3F37BBAA0278310F8D36', 'casad@', 'programador de software', '2004-08-04', 1, 1211),
('alejo', 'valda', 'cra24b-cll13', 3152041450, 1118805276, 'avaldelamar57@misena.edu.co', '*FA03235338768927A10376F45F5F7366590EDF64', 'casad@', 'futbolista', '1940-01-09', 0, 0),
('Johanna', 'Bustamante Torres', 'cr24b#12', 3016382703, 1118808995, 'jovis@gmail.com', '*4A2BD52603F9D55EA614CC91B3642420131AA2E1', 'casad@', 'estilista', '1989-08-07', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `FOREIGN KEY` (`id_usuario`),
  ADD KEY `id_pagodiario` (`id_pagodiario`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ident`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`id_usuario`) REFERENCES `registro` (`ident`),
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_pagodiario`) REFERENCES `registro` (`ident`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
