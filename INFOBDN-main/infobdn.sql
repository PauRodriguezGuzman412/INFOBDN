-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2022 a las 21:48:41
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

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
  `Password` varchar(50) NOT NULL,
  `Cognoms` text NOT NULL,
  `Edat` int(11) NOT NULL,
  `Foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Email`, `DNI`, `Nom`, `Password`, `Cognoms`, `Edat`, `Foto`) VALUES
('1@gmail.com', '1uwu', 'Juan', 'c4ca4238a0b923820dcc509a6f75849b', 'Juan', 69, 'imgAlumnos/1-original.jpg'),
('test@gmail.com', '123', 'pau', '202cb962', 'rodriguez', 19, '');

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
  `Dni_Profesores` varchar(9) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Codi`, `Nom`, `Descripcion`, `Hores`, `Data_inici`, `Data_final`, `Dni_Profesores`, `activo`) VALUES
(1, 'Mates', 'Numeros', 69, '2022-10-07', '2022-10-07', '1', 1),
(2, 'English', 'Loads of words', 69, '2022-10-18', '2022-11-06', '1', 1),
(3, 'Castellano', 'Palabras en español', 88, '2022-09-21', '2022-10-14', NULL, 1),
(4, 'Català', 'Paraules en català', 88, '2022-09-21', '2022-09-29', '22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `Codi` int(11) NOT NULL,
  `Email_Alumnos` varchar(50) NOT NULL,
  `Nota` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`Codi`, `Email_Alumnos`, `Nota`) VALUES
(1, '1@gmail.com', 1),
(1, 'test@gmail.com', 10),
(4, '1@gmail.com', NULL);

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
('0', 'Profesor', 'Profesor', '83c2f0ea111a68a80ec383418750b37b', 'Profesor', 'img/Profesor-fa3fe7c4b0ec84278f7511d85cb48e1b.jpg', 1),
('1', 'assadaasdsad', 'testfdasdsfasdf', 'c4ca4238a0b923820dcc509a6f75849b', 'test', 'img/1-3-wpa9xvcq.png', 1),
('12', 'pau', 'apellidos', '7e5bf5436ee5318727c8c7b5ace219a1', 'sdfsd', 'img/12-original.jpg', 1),
('121212', '1ffdfdfdfdfdfd', '1', '28c8edde3d61a0411511d3b1866f0636', '1', 'img/121212-original.jpg', 1),
('123', 'holi', 'holo', '202cb962ac59075b964b07152d234b70', '69', 'img/123-original.jpg', 0),
('22', 'aAAAAAAAAAAA', 'oOOOOOOOOOOOOOOOOOOOO', '098f6bcd4621d373cade4e832627b4f6', 'test', 'img/22-original.jpg\r\n', 0),
('45', '45', '45', '6c8349cc7260ae62e3b1396831a8398f', '45', 'img/45-original.jpg', 1),
('49988375R', 'eee', 'ee', 'd2f2297d6e829cd3493aa7de4416a18f', 'eee', 'img/49988375R-3-wpa9xvcq.png', 1),
('90', '90', '90', '8613985ec49eb8f757ae6439e879bb2a', '', 'img/90-skeletonoc-h22b8kbm.png', 1),
('b', 'b', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'img/b-original.jpg', 1),
('ffff', 'ffff', 'fff', '343d9040a671c45832ee5381860e2996', 'ffff', 'img/ffff-3-wpa9xvcq.png', 1),
('nuevo1', 'nuevo1', 'nuevo1', '6a0ad8581e57688a25a5f6f1009800a3', 'nuevo1', 'img/nuevo1-FaPvxpBX0AAFwNQ.jpg', 1),
('test', 'test', 'test', '28b662d883b6d76fd96e4ddc5e9ba780', 'test', 'img/test-3-wpa9xvcq.png', 1),
('test2', 'test2', 'test2', 'ad0234829205b9033196ba818f7a872b', 'test2', '', 1);

--
-- Índices para tablas volcadas
--

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
  ADD KEY `Dni_Profesores` (`Dni_Profesores`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`Codi`,`Email_Alumnos`),
  ADD KEY `Email_Alumnos` (`Email_Alumnos`);

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
  MODIFY `Codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Dni_Profesores`) REFERENCES `profesores` (`DNI`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`Codi`) REFERENCES `cursos` (`Codi`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`Email_Alumnos`) REFERENCES `alumnos` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
