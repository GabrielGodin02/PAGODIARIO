-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-11-2023 a las 01:11:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.19

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
-- Estructura de tabla para la tabla `inicio_secion`
--

CREATE TABLE `inicio_secion` (
  `id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `id_usuario` int(12) NOT NULL,
  `direccion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(12) NOT NULL,
  `dia_solicitado` date NOT NULL,
  `hora` time NOT NULL,
  `cantidad` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantida_prestamo` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pendiente',
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id_prestamo`, `id_usuario`, `direccion`, `telefono`, `dia_solicitado`, `hora`, `cantidad`, `cantida_prestamo`, `estado`, `fecha_solicitud`) VALUES
(10, 45, 'calle 23', 34234, '2023-11-23', '09:36:00', '300000', '310000', 'Aceptada', '2023-11-22 14:33:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `ident` int(12) NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `profesion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`nombre`, `apellidos`, `direccion`, `ident`, `email`, `password`, `estado`, `profesion`, `fecha`, `admin`) VALUES
('oscar', 'beto', '', 44, 'omarpimienta0208@gmail.com', '', 'casad@', NULL, '2023-09-12', 0),
('carlos', 'martines', '', 45, 'gf@gmail.com', '', 'union libre', NULL, '2023-09-07', 0),
('natalia', 'dd', '', 66, 'gabriel.godin@misena.edu.co', '', 'casad@', NULL, '2023-08-29', 0),
('gabriel', 'godin', '', 111, 'gabrielgodin02@gmail.com', '', 'solter@', NULL, '2023-09-03', 1),
('pedro', 'godin', '', 333, 'pitchmarkel7@hotmail.com', '', 'solter@', NULL, '2023-09-12', 0),
('Alex', 'Valdelamar Bustamante', 'cr24b#12b', 1118805275, 'avaldelamar57@misena.edu.co', '', 'casad@', 'o', '2004-08-03', 1),
('Johanna', 'Bustamante', '', 1118808995, 'Jovis@gmail.com', '', 'union libre', NULL, '1985-08-07', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `FOREIGN KEY` (`id_usuario`);

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
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`id_usuario`) REFERENCES `registro` (`ident`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
