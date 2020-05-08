-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2020 a las 13:15:36
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `motofitness`
--
CREATE DATABASE IF NOT EXISTS `motofitness` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `motofitness`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `dni` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `objetivo` text COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `coddieta` int(10) DEFAULT NULL,
  `codtabla` int(10) DEFAULT NULL,
  `codplan` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `disponibilidad` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `observaciones` text COLLATE latin1_spanish_ci NOT NULL,
  `vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`dni`, `nombre`, `email`, `direccion`, `telefono`, `objetivo`, `clave`, `coddieta`, `codtabla`, `codplan`, `disponibilidad`, `observaciones`, `vencimiento`) VALUES
('1111', 'Prueba2', 'asdasd', 'asdasd', '12131', 'asdasd', 'a', NULL, 1, '1', '1', 'adasdasd', '2020-05-04'),
('123', 'asdad', 'asdas', 'sdad', '1212', 'sadas', 'a', 12, 6, '2', '1', 'sadasd', '2020-04-29'),
('1232', 'asdasd', 'asdasd', 'asdasd', '12321', 'asdada', 'a', 12, 6, '2', '1', 'asd', '2020-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diadieta`
--

CREATE TABLE `diadieta` (
  `coddia` int(10) NOT NULL,
  `calorias` int(4) NOT NULL,
  `macronutrientes` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `dia` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `diadieta`
--

INSERT INTO `diadieta` (`coddia`, `calorias`, `macronutrientes`, `dia`) VALUES
(86, 100, '1212', 'Lunes'),
(87, 12, 'sdad', 'Miercoles'),
(88, 62, 'asdasd', 'Lunes'),
(89, 62, 'adasdas', 'Martes'),
(90, 112, 'asdasd', 'Miercoles'),
(91, 234, 'fdfsfd', 'Jueves'),
(92, 150, 'asdasd', 'Viernes'),
(93, 111, 'asdasdsad', 'Sabado'),
(94, 23, 'adasdasd', 'Domingo'),
(97, 150, 'sdad', 'Lunes'),
(98, 100, 'asdasd', 'Martes'),
(99, 135, 'asdasd', 'Miercoles'),
(100, 24, 'asdasdd', 'Jueves'),
(101, 62, 'asdasdasd', 'Viernes'),
(102, 200, 'sdaadsa', 'Sabado'),
(103, 150, 'adsadas', 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dieta`
--

CREATE TABLE `dieta` (
  `coddieta` int(10) NOT NULL,
  `semana` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dieta`
--

INSERT INTO `dieta` (`coddieta`, `semana`) VALUES
(12, 'Dieta de la alcachofa'),
(17, 'Segunda dieta de prueba'),
(18, 'Prueba'),
(19, 'Prueba2 loko');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `codejercicio` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `series` int(3) NOT NULL,
  `repeticiones` int(3) NOT NULL,
  `peso` float NOT NULL,
  `link` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`codejercicio`, `nombre`, `series`, `repeticiones`, `peso`, `link`) VALUES
(7, 'Pull up', 10, 20, 10, 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `numeroempleado` int(10) NOT NULL,
  `especialidad` int(1) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `dniEmpleado` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `privilegios` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`numeroempleado`, `especialidad`, `nombre`, `dniEmpleado`, `telefono`, `email`, `direccion`, `clave`, `privilegios`) VALUES
(19, 1, 'Pedro', '19823712A', '678789876', 'pepe@gmail.com', 'calle falsa 123', '1', 1),
(20, 3, 'Andres', '12321234P', '324234423', 'asdasd@gmail.com', 'asdad', '1', 0),
(21, 2, 'Juan', '123123', '698857434', 'email@email.com', 'asdaasd', '1', 0),
(22, 1, 'Juanito', '2121312', '123123', 'asdasd@prueba', 'sdasd', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE `entrenamiento` (
  `codigoejercicio` int(10) NOT NULL,
  `codigosesion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `entrenamiento`
--

INSERT INTO `entrenamiento` (`codigoejercicio`, `codigosesion`) VALUES
(7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineadia`
--

CREATE TABLE `lineadia` (
  `coddia` int(10) NOT NULL,
  `codplato` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lineadia`
--

INSERT INTO `lineadia` (`coddia`, `codplato`) VALUES
(86, 57),
(88, 57),
(88, 59),
(89, 57),
(89, 59),
(90, 58),
(90, 59),
(91, 58),
(91, 60),
(91, 61),
(92, 57),
(92, 58),
(93, 58),
(93, 60),
(94, 59),
(94, 60),
(97, 57),
(97, 58),
(98, 57),
(98, 57),
(99, 59),
(99, 61),
(100, 59),
(100, 59),
(101, 59),
(101, 57),
(102, 58),
(102, 58),
(103, 57),
(103, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineadieta`
--

CREATE TABLE `lineadieta` (
  `coddieta` int(10) NOT NULL,
  `coddia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lineadieta`
--

INSERT INTO `lineadieta` (`coddieta`, `coddia`) VALUES
(12, 86),
(12, 87),
(19, 97),
(19, 98),
(19, 99),
(19, 100),
(19, 101),
(19, 102),
(19, 103);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaempleado`
--

CREATE TABLE `lineaempleado` (
  `numeroempleado` int(10) NOT NULL,
  `dni` varchar(9) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lineaempleado`
--

INSERT INTO `lineaempleado` (`numeroempleado`, `dni`) VALUES
(19, '1111'),
(20, '123'),
(20, '1232');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineatabla`
--

CREATE TABLE `lineatabla` (
  `codtabla` int(10) NOT NULL,
  `codsesion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lineatabla`
--

INSERT INTO `lineatabla` (`codtabla`, `codsesion`) VALUES
(8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `codPlan` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `tipoplan` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`codPlan`, `tipoplan`, `descripcion`) VALUES
('1', 'Nutricion', 'Plan destinado a la nutricion, se te asignaran dietas para llegar a tu objetivo.'),
('2', 'Entrenamiento', 'Plan destinado al entrenamiento fisico, se te asignaran tablas de ejercio y dietas para llegar a tu objetivo.'),
('3', 'Pro', 'Plan pro, para una atencion mas personalizada y exhaustiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `codplato` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `link` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `calorias` int(4) NOT NULL,
  `tipoComida` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`codplato`, `nombre`, `link`, `calorias`, `tipoComida`) VALUES
(57, 'Macarrones', 'asdasd', 50, 'ads'),
(58, 'Posho', 'http://google.es', 100, 'Proteinas'),
(59, 'Espajetis', 'ad', 12, 'asd'),
(60, 'asd', 'asdasd', 11, 'asdasd'),
(61, 'adasd', 'asdasd', 123, 'adasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `codProgreso` int(10) NOT NULL,
  `imagen` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `peso` float NOT NULL,
  `medidas` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `dni` varchar(9) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`codProgreso`, `imagen`, `peso`, `medidas`, `fecha`, `dni`) VALUES
(44, 'img/1588702956.png', 11, 'a', '2020-05-05', '123'),
(45, 'img/1588703892.png', 11, 'adsad', '2020-05-05', '123'),
(46, 'img/1588704869.jpeg', 121, 'sadasd', '2020-05-05', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `codsesion` int(10) NOT NULL,
  `dia` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`codsesion`, `dia`) VALUES
(7, 'Lunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaejercicios`
--

CREATE TABLE `tablaejercicios` (
  `codtabla` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tablaejercicios`
--

INSERT INTO `tablaejercicios` (`codtabla`, `fecha`, `tipo`) VALUES
(1, '2019-12-04', 'cardio'),
(6, '2019-12-04', 'Musculacion'),
(7, '2015-01-01', 'Musculacion'),
(8, '2015-01-01', 'Musculacion');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `coddietacli` (`coddieta`),
  ADD KEY `codtablacli` (`codtabla`),
  ADD KEY `codplan` (`codplan`);

--
-- Indices de la tabla `diadieta`
--
ALTER TABLE `diadieta`
  ADD PRIMARY KEY (`coddia`);

--
-- Indices de la tabla `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`coddieta`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`codejercicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`numeroempleado`),
  ADD UNIQUE KEY `email.unico` (`email`),
  ADD UNIQUE KEY `telefono.unico` (`telefono`),
  ADD UNIQUE KEY `dni.unico` (`dniEmpleado`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD PRIMARY KEY (`codigoejercicio`,`codigosesion`),
  ADD KEY `codejercicio` (`codigoejercicio`),
  ADD KEY `codsesiontabla` (`codigosesion`);

--
-- Indices de la tabla `lineadia`
--
ALTER TABLE `lineadia`
  ADD KEY `indice1` (`coddia`),
  ADD KEY `codplato` (`codplato`);

--
-- Indices de la tabla `lineadieta`
--
ALTER TABLE `lineadieta`
  ADD PRIMARY KEY (`coddieta`,`coddia`),
  ADD KEY `coddiadieta` (`coddia`),
  ADD KEY `coddieta` (`coddieta`);

--
-- Indices de la tabla `lineaempleado`
--
ALTER TABLE `lineaempleado`
  ADD PRIMARY KEY (`numeroempleado`,`dni`),
  ADD KEY `dniclienteemp` (`dni`);

--
-- Indices de la tabla `lineatabla`
--
ALTER TABLE `lineatabla`
  ADD PRIMARY KEY (`codtabla`,`codsesion`),
  ADD KEY `codsesion` (`codsesion`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`codPlan`) USING BTREE;

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`codplato`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`codProgreso`),
  ADD KEY `dnicliente` (`dni`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`codsesion`);

--
-- Indices de la tabla `tablaejercicios`
--
ALTER TABLE `tablaejercicios`
  ADD PRIMARY KEY (`codtabla`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `diadieta`
--
ALTER TABLE `diadieta`
  MODIFY `coddia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `dieta`
--
ALTER TABLE `dieta`
  MODIFY `coddieta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `codejercicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `numeroempleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `codplato` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `codProgreso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `codsesion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tablaejercicios`
--
ALTER TABLE `tablaejercicios`
  MODIFY `codtabla` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `coddietacli` FOREIGN KEY (`coddieta`) REFERENCES `dieta` (`coddieta`),
  ADD CONSTRAINT `codplanclientes` FOREIGN KEY (`codplan`) REFERENCES `plan` (`codPlan`),
  ADD CONSTRAINT `codtablacli` FOREIGN KEY (`codtabla`) REFERENCES `tablaejercicios` (`codtabla`);

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `codejercicio` FOREIGN KEY (`codigoejercicio`) REFERENCES `ejercicio` (`codejercicio`),
  ADD CONSTRAINT `codsesiontabla` FOREIGN KEY (`codigosesion`) REFERENCES `sesion` (`codsesion`);

--
-- Filtros para la tabla `lineadia`
--
ALTER TABLE `lineadia`
  ADD CONSTRAINT `coddialinea` FOREIGN KEY (`coddia`) REFERENCES `diadieta` (`coddia`),
  ADD CONSTRAINT `codplatodia` FOREIGN KEY (`codplato`) REFERENCES `plato` (`codplato`);

--
-- Filtros para la tabla `lineadieta`
--
ALTER TABLE `lineadieta`
  ADD CONSTRAINT `coddiadieta` FOREIGN KEY (`coddia`) REFERENCES `diadieta` (`coddia`),
  ADD CONSTRAINT `coddieta` FOREIGN KEY (`coddieta`) REFERENCES `dieta` (`coddieta`);

--
-- Filtros para la tabla `lineaempleado`
--
ALTER TABLE `lineaempleado`
  ADD CONSTRAINT `dniclienteemp` FOREIGN KEY (`dni`) REFERENCES `cliente` (`dni`),
  ADD CONSTRAINT `nempleadoconclie` FOREIGN KEY (`numeroempleado`) REFERENCES `empleado` (`numeroempleado`);

--
-- Filtros para la tabla `lineatabla`
--
ALTER TABLE `lineatabla`
  ADD CONSTRAINT `codsesion` FOREIGN KEY (`codsesion`) REFERENCES `sesion` (`codsesion`),
  ADD CONSTRAINT `codtabla` FOREIGN KEY (`codtabla`) REFERENCES `tablaejercicios` (`codtabla`);

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `dnicliente` FOREIGN KEY (`dni`) REFERENCES `cliente` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
