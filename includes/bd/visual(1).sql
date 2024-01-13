-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2024 a las 22:42:02
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
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE `abono` (
  `id_abono` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abono`
--

INSERT INTO `abono` (`id_abono`, `id_prestamo`, `monto`, `fecha`) VALUES
(1, 28, 10, '2023-12-22 18:42:13'),
(2, 30, 6000, '2023-12-22 18:47:00'),
(3, 30, 9700, '2023-12-22 18:47:19'),
(4, 30, 1, '2023-12-22 18:48:54'),
(5, 30, 2, '2023-12-22 18:49:18'),
(6, 30, 100, '2023-12-22 18:50:35'),
(7, 28, 100, '2023-12-23 01:02:04'),
(8, 30, 10, '2023-12-23 01:02:17'),
(9, 28, 1, '2023-12-23 01:08:35'),
(10, 30, 1, '2023-12-23 01:08:44'),
(11, 28, 10, '2023-12-23 01:10:59'),
(12, 30, 1, '2023-12-23 01:11:34'),
(13, 30, 1, '2023-12-23 01:15:07'),
(14, 30, 1, '2023-12-23 01:31:50'),
(15, 30, 1, '2023-12-23 01:32:19'),
(16, 30, 1, '2023-12-23 01:33:00'),
(17, 30, 1, '2023-12-27 00:55:52'),
(18, 30, 1, '2023-12-27 01:06:14'),
(19, 28, 1, '2023-12-27 01:15:35'),
(20, 28, 1, '2023-12-27 01:33:25'),
(21, 28, 1, '2023-12-27 01:33:54'),
(22, 28, 1, '2023-12-27 01:34:10'),
(23, 28, 1, '2023-12-27 02:56:30'),
(24, 28, 1, '2023-12-26 14:56:11'),
(25, 28, 9000, '2023-12-26 16:09:29'),
(26, 28, 3000, '2023-12-27 16:10:06'),
(27, 33, 800, '2023-12-28 04:13:36'),
(28, 34, 4000, '2023-12-28 19:11:35'),
(29, 34, 500, '2023-12-29 01:17:08'),
(30, 34, 200, '2023-12-29 01:19:16'),
(31, 34, 5000, '2023-12-29 21:02:04'),
(32, 39, 10000, '2023-12-30 19:50:57'),
(33, 40, 10000, '2023-12-30 20:02:22'),
(34, 40, 14000, '2023-12-30 20:12:52'),
(35, 41, 7000, '2024-01-03 21:18:40'),
(36, 41, 2000, '2024-01-13 04:35:38'),
(37, 42, 2600, '2024-01-13 04:35:52'),
(38, 41, 3000, '2024-01-13 18:10:44'),
(39, 42, 5000, '2024-01-13 18:29:18'),
(40, 42, 1000, '2024-01-13 18:33:35'),
(41, 44, 5000, '2024-01-13 18:52:09'),
(42, 42, 4000, '2024-01-13 18:52:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excusas`
--

CREATE TABLE `excusas` (
  `id_excusa` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `excusas`
--

INSERT INTO `excusas` (`id_excusa`, `id_prestamo`, `motivo`, `fecha`) VALUES
(1, 28, '1\r\n', '2023-12-27 01:49:41'),
(2, 28, 'porque no\r\n', '2023-12-27 02:57:21'),
(3, 28, 'excusa del miercoles', '2023-12-26 14:57:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio_sesion`
--

CREATE TABLE `inicio_sesion` (
  `id` int(12) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `token` varchar(42) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inicio_sesion`
--

INSERT INTO `inicio_sesion` (`id`, `id_usuario`, `token`) VALUES
(3, 1118808995, 'By5ZskSpO8Met1OC4XIx822YA9AvHn0XmlWNZS40O4'),
(4, 1118805275, 'iJqKhU4KC9eSB9q138yKtJ0dWmoBN1sVOX76HqcncN'),
(5, 1118805275, '6fm0wxvp4wI2jWp924RAnvWASOZCsy2ipjPjCRRMj8'),
(6, 1118808995, 'vEXD0aUHb9jfMAexLs7QscrZJpTscTB86QzMriOYY1'),
(8, 1118808995, 'qBh7WcGPGalEzH7IWLkTrzy7UVdpGA9JkBUbbjNN2t'),
(10, 1118805276, 'd7j2Mzn1EB6n8seq9mNgay6sD8lLtQIqdcXrd23H0N'),
(11, 1114404444, 'Ep8OXJpvvd0hUM7qXv8QmmZPCvQYgFLmWNkXKRYeUB'),
(12, 1118805275, 'VwUajonucjemYe3e4roZERCPWWxBkCV6jtso3NxUJj'),
(13, 1118808995, 'X1nFtfkosbjzAca5IJaR0jeY7tP3YxpVIc4R7yEFJ6'),
(15, 1118805275, 'DNPl19viwsn92tpAkSAQ9jWlOZIpmuG16GGH1fpsCf'),
(17, 1118805275, 'KGg1Qwx65ews3vohctk9DdgW8RyAqzDIXvZjCAHwjZ'),
(20, 1118805276, 'XQDgKFjTUHXvWLX3fDsIrZtUBSzAgQmGyYD1Fy0WpF'),
(23, 1118805276, 'k4j4CMJAjQJt4qwnQSPr8hCcG9G4uon2suopMXJ3f7'),
(28, 1118805275, 'gJwC6SFWS02aSqTf2zmtUZpj0uCw0lbasVeJpaQ3oV'),
(30, 1118805276, 'XH4Ezicic0AWPo0LCQMnTk3puFmXql4xKc4RllrLa3'),
(32, 1118805275, 'kpeqdd4JmxHIVWMIPO3Yjkn6gNLoqyJXLVKt88iY3a'),
(33, 1118805276, 'EzRbQosyUpqU0avfAwaqPTd6j3WS88korEBU9Hyhgs'),
(34, 1118805275, 'ip0S7w4lwMUEqa1Sou1g66iktIryoxKrxIwEsk89Zt'),
(35, 1118805275, '76eQFgeIZjMQ0ceciPBxWcFiW9oDZPLN80kni4ooU5'),
(37, 1114404444, 'GNphyhNl7QAc1tw24leT3Mt7cOPqmGdL7uStMwcg9S'),
(38, 1118808995, 'QPGzqFW32aTTQORyXExtSpp7f4Xu8rTl0Qee3DXUZT'),
(40, 1118805275, 'X3D0XVm66bHMx6BU6UcueEcPmkMZaiEV3jqXTMJjCa'),
(41, 1118805276, 'bFng8OKZ2IDw6QmGLsCovUi4eFdDnPbyeimkgmVnnt'),
(42, 1118805276, 'AEXv9Rdu6s1QT8g8aALmgjuiyj9va6ZJHbye0hjdu1');

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
(41, 1118805276, 1118805275, '10000', '0', 'Completado', '2024-01-03 20:08:01', '2024-01-03 20:08:57', '2024-01-13 18:10:44'),
(42, 1114404444, 1118805275, '13000', '3000', 'Aceptada', '2024-01-03 20:09:43', '2024-01-03 20:11:15', NULL),
(43, 1118808995, 1118805275, '10000', '12000', 'Rechazada', '2024-01-03 21:10:55', NULL, NULL),
(44, 1118805276, 1118805275, '10000', '7000', 'Aceptada', '2024-01-13 18:28:51', '2024-01-13 18:34:07', NULL);

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
CREATE TRIGGER `cancelar_prestamo` AFTER UPDATE ON `prestamo` FOR EACH ROW BEGIN
IF NEW.estado = "Rechazada" AND OLD.estado = "Aceptada" THEN
	UPDATE reportes 
    SET reportes.rechazados = reportes.rechazados + 1 
    WHERE reportes.id_pagodiario = OLD.id_pagodiario
    AND DATE_FORMAT(CURRENT_TIMESTAMP, "%Y-%m") = 	 DATE_FORMAT(reportes.create_time, "%Y-%m");
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
CREATE TRIGGER `rechazar_prestamo` AFTER UPDATE ON `prestamo` FOR EACH ROW BEGIN
IF NEW.estado = "Rechazada" AND OLD.estado = "pendiente" THEN
	UPDATE reportes 
    SET reportes.rechazados = reportes.rechazados + 1 
    WHERE reportes.id_pagodiario = OLD.id_pagodiario
    AND DATE_FORMAT(CURRENT_TIMESTAMP, "%Y-%m") = 	 DATE_FORMAT(reportes.create_time, "%Y-%m");
END IF;
END
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
  `capital` int(11) NOT NULL DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`nombre`, `apellidos`, `direccion`, `telefono`, `ident`, `email`, `password`, `estado`, `profesion`, `fecha`, `admin`, `capital`, `reset_token`, `expiry_date`) VALUES
('oscar', 'beto', '', NULL, 44, 'omarpimienta0208@gmail.com', '', 'casad@', NULL, '2023-09-12', 0, 0, NULL, NULL),
('carlos', 'martines', '', NULL, 45, 'gf@gmail.com', '', 'union libre', NULL, '2023-09-07', 1, 0, NULL, NULL),
('natalia', 'dd', '', NULL, 66, 'gabriel.godin@misena.edu.co', '', 'casad@', NULL, '2023-08-29', 0, 0, NULL, NULL),
('gabriel', 'godin', '', NULL, 111, 'gabrielgodin02@gmail.com', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'solter@', NULL, '2023-09-03', 1, 100000, NULL, NULL),
('pedro', 'godin', '', NULL, 333, 'pitchmarkel7@hotmail.com', '', 'solter@', NULL, '2023-09-12', 0, 0, NULL, NULL),
('pepe', 'grillo', 'europa XVII', 3332211444, 1114404444, 'pepito@gmail.com', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 'solter@', 'consejero', '1940-01-18', 0, 0, NULL, NULL),
('Alex', 'Valdelamar Bustamante', 'cr24b#12b', 3208051693, 1118805275, 'valdelex3@gmail.com', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'casad@', 'programador de software', '2004-08-04', 1, 15811, NULL, NULL),
('alejo', 'valda', 'cra24b-cll13', 3152041450, 1118805276, 'avaldelamar57@misena.edu.co', '*FA03235338768927A10376F45F5F7366590EDF64', 'casad@', 'futbolista', '1940-01-09', 0, 0, NULL, NULL),
('Johanna', 'Bustamante Torres', 'cr24b#12', 3016382703, 1118808995, 'jovis@gmail.com', '*4A2BD52603F9D55EA614CC91B3642420131AA2E1', 'casad@', 'estilista', '1989-08-07', 0, 0, 'ac2bb17992e236683f35a584ac29ef03', '2024-01-12 16:04:11'),
('Juanes', 'Petro', 'cr24b#12', 3208051693, 2147483647, 'alexvaldelamarbustamante@inedimacg.edu.co', '*122453BD74F81A77766A93B653A2E9DBEB366CA9', 'solter@', 'consejero', '1993-11-10', 0, 0, NULL, NULL);

--
-- Disparadores `registro`
--
DELIMITER $$
CREATE TRIGGER `primer_reporte` AFTER UPDATE ON `registro` FOR EACH ROW BEGIN

IF NEW.admin = 1 AND OLD.admin = 0 
THEN

INSERT INTO reportes(id_pagodiario, create_time) VALUES (NEW.ident, CURRENT_DATE);

END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `id_pagodiario` int(11) NOT NULL,
  `solicitudes` int(11) DEFAULT 0,
  `aceptados` int(11) DEFAULT 0,
  `rechazados` int(11) DEFAULT 0,
  `completados` int(11) DEFAULT 0,
  `total` double DEFAULT 0,
  `balance` double DEFAULT 0,
  `create_time` date DEFAULT NULL COMMENT 'Create Time'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `id_pagodiario`, `solicitudes`, `aceptados`, `rechazados`, `completados`, `total`, `balance`, `create_time`) VALUES
(1, 1118805275, 2, 1, 1, 2, 10000, 2600, '2024-01-01'),
(3, 1118805275, 0, 0, 0, 0, 0, 0, '2023-12-01'),
(4, 1118805275, 0, 0, 0, 0, 0, 0, '2024-02-01'),
(5, 45, 0, 0, 0, 0, 0, 0, NULL),
(6, 1118805276, 0, 0, 0, 0, 0, 0, NULL),
(7, 1118805276, 0, 0, 0, 0, 0, 0, '2024-01-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono`
--
ALTER TABLE `abono`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `id_prestamo` (`id_prestamo`);

--
-- Indices de la tabla `excusas`
--
ALTER TABLE `excusas`
  ADD PRIMARY KEY (`id_excusa`),
  ADD KEY `id_prestamo` (`id_prestamo`);

--
-- Indices de la tabla `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pagodiario` (`id_pagodiario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE `abono`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `excusas`
--
ALTER TABLE `excusas`
  MODIFY `id_excusa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono`
--
ALTER TABLE `abono`
  ADD CONSTRAINT `abono_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamo` (`id_prestamo`);

--
-- Filtros para la tabla `excusas`
--
ALTER TABLE `excusas`
  ADD CONSTRAINT `id_prestamo` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamo` (`id_prestamo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inicio_sesion`
--
ALTER TABLE `inicio_sesion`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `registro` (`ident`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`id_usuario`) REFERENCES `registro` (`ident`),
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_pagodiario`) REFERENCES `registro` (`ident`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_pagodiario`) REFERENCES `registro` (`ident`) ON DELETE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `crear nuevos reportes` ON SCHEDULE EVERY 1 MONTH STARTS '2024-02-01 14:56:14' ON COMPLETION PRESERVE ENABLE DO INSERT INTO reportes (id_pagodiario, create_time)
SELECT ident, CURRENT_DATE
FROM registro
WHERE admin = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
