-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2020 a las 21:41:22
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
  `dni` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `objetivo` text COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `coddieta` int(10) DEFAULT NULL,
  `codtabla` int(10) DEFAULT NULL,
  `codplan` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `disponibilidad` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `observaciones` text COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`dni`, `nombre`, `email`, `direccion`, `telefono`, `objetivo`, `clave`, `coddieta`, `codtabla`, `codplan`, `disponibilidad`, `observaciones`, `vencimiento`) VALUES
('78675645', 'Alberto', 'alberto@gmail.com', 'Calle garcia campos', '678789876', 'Adelgazar porque estoy gordo', '1', 1, 1, '2', '3', 'Soy alergico a los pistachos', '2020-06-10');

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
(1, 170, '100g de carbohidratos y 50g de proteinas', 'Lunes'),
(2, 700, '100g de proteinas', 'Martes'),
(3, 270, '150g de proteinas', 'Miercoles'),
(4, 300, '100g de proteinas', 'Jueves'),
(5, 1000, '100g de proteinas', 'Viernes'),
(6, 170, '100g de proteinas', 'Sabado'),
(7, 700, '100g de proteinas', 'Domingo');

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
(1, 'Dieta de carbohidratos');

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
(1, 'Pull up', 5, 10, 10, 'https://www.youtube.com/'),
(2, 'Sentadillas', 5, 10, 0, 'https://www.youtube.com/'),
(3, 'Press de hombro', 5, 10, 30, 'https://www.youtube.com/'),
(4, 'Press de banca', 5, 10, 100, 'https://www.youtube.com/'),
(5, 'Sentadillas pro', 10, 50, 0, 'https://www.youtube.com/');

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
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `privilegios` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`numeroempleado`, `especialidad`, `nombre`, `dniEmpleado`, `telefono`, `email`, `direccion`, `clave`, `privilegios`) VALUES
(1, 3, 'Juan', '70967881Q', '698857434', 'email@email.com', 'Calle falsa 22', '1', 1),
(2, 1, 'Juan Alberto', '79876765Q', '675654345', 'lmdShow@gmail.com', 'Calle falsa 22', 'youtube', 0),
(3, 1, 'Andres', '98788765Q', '787654543', 'bokeron@gmail.com', 'Calle de madrid 1', 'youtube', 0),
(4, 3, 'Marcos', '65454345E', '675565454', 'laClasse@gmail.com', 'Fuengirola', 'youtube', 0);

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
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(1, 2),
(2, 3),
(2, 3),
(2, 3),
(4, 3);

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
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 3),
(3, 2),
(4, 1),
(4, 3),
(5, 4),
(5, 4),
(6, 1),
(6, 2),
(7, 3),
(7, 4);

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
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaempleado`
--

CREATE TABLE `lineaempleado` (
  `numeroempleado` int(10) NOT NULL,
  `dni` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lineaempleado`
--

INSERT INTO `lineaempleado` (`numeroempleado`, `dni`) VALUES
(1, '78675645');

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
(1, 1),
(1, 2);

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
(1, 'Macarrones con tomate', 'https://www.youtube.com/', 100, 'Carbohidratos'),
(2, 'Pollo con curry', 'https://www.youtube.com/', 70, 'Proteinas'),
(3, 'Ternera', 'https://www.youtube.com/', 200, 'Proteinas'),
(4, 'Ensalada de pasta', 'https://www.youtube.com/', 500, 'Carbohidratos y verd');

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
  `dni` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`codProgreso`, `imagen`, `peso`, `medidas`, `fecha`, `dni`) VALUES
(1, 'img/1589138075.jpeg', 120, '100/20/23', '2020-05-10', '78675645'),
(4, '/motofitnessSymfony/web/img/img.jpg', 150, '50/100/30', '2020-05-10', '78675645'),
(5, '/motofitnessSymfony/web/img/img.jpg', 123, '50/32', '2020-05-10', '78675645');

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
(1, 'Full body'),
(2, 'Tren superior'),
(3, 'Sesion HITT');

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
(1, '2020-05-10', 'Musculacion');

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
  MODIFY `coddia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `dieta`
--
ALTER TABLE `dieta`
  MODIFY `coddieta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `codejercicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `numeroempleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `codplato` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `codProgreso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `codsesion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tablaejercicios`
--
ALTER TABLE `tablaejercicios`
  MODIFY `codtabla` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
