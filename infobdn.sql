-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2022 a las 08:49:27
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `DNI` varchar(9) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`DNI`, `Password`) VALUES
('49988375R', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Email` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Nom` text NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Cognoms` text NOT NULL,
  `Edat` int(11) NOT NULL,
  `Foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Codi` int(11) NOT NULL,
  `Nom` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Hores` int(11) NOT NULL,
  `Data_inici` date NOT NULL,
  `Data_final` date NOT NULL,
  `Dni_Profesores` varchar(9) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Codi`, `Nom`, `Descripcion`, `Hores`, `Data_inici`, `Data_final`, `Dni_Profesores`, `activo`) VALUES
(5, 'English', 'Deez nuts', 69, '2022-09-17', '2022-10-02', '1', 1),
(6, 'Mates', 'Muchos numeross', 69, '2022-09-17', '2022-10-02', '123', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `Codi` int(11) NOT NULL,
  `DNI_Alumnos` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `DNI` varchar(9) NOT NULL,
  `Nom` text NOT NULL,
  `Cognoms` text NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Titol` text NOT NULL,
  `Foto` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`DNI`, `Nom`, `Cognoms`, `Password`, `Titol`, `Foto`, `activo`) VALUES
('1', 'assadaasdsad', 'testfdasdsfasdf', 'fb469d7ef430b0baf0cab6c436e70375', 'test', 'img/1-3-wpa9xvcq.png', 0),
('12', 'pau', 'apellidos', 'd58e3582afa99040e27b92b13c8f2280', 'sdfsd', 'img/12-original.jpg', 0),
('123', 'holi', 'holo', '202cb962ac59075b964b07152d234b70', '69', 'img/123-original.jpg', 1),
('22', 'aAAAAAAAAAAA', 'oOOOOOOOOOOOOOOOOOOOO', '098f6bcd4621d373cade4e832627b4f6', 'test', 'img/22-original.jpg\r\n', 0),
('b', 'b', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'img/b-original.jpg', 0),
('test', 'test', 'test', '28b662d883b6d76fd96e4ddc5e9ba780', 'test', 'img/test-3-wpa9xvcq.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`Email`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codi`),
  ADD KEY `Cursos-Alumnos` (`Dni_Profesores`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`Codi`,`DNI_Alumnos`),
  ADD KEY `DNI_Alumnos` (`DNI_Alumnos`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `Cursos-Alumnos` FOREIGN KEY (`Dni_Profesores`) REFERENCES `profesores` (`DNI`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`DNI_Alumnos`) REFERENCES `alumnos` (`DNI`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`Codi`) REFERENCES `cursos` (`Codi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;