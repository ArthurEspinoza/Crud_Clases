-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2019 a las 05:24:36
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crudclases`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `idAtributos` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idClases` varchar(100) NOT NULL,
  `idModelo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`idAtributos`, `nombre`, `tipo`, `idClases`, `idModelo`, `idUsuario`) VALUES
(10, 'marca', 'String', '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(11, 'color', 'String', '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(12, 'motor', '_9lEF8OOYEemTk6CKSpsZQA', '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(13, 'radiomp3', '_qCd-UOO_EemTk6CKSpsZQA', '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(14, 'numCilindros', 'Integer', '_9lEF8OOYEemTk6CKSpsZQA', 16, 1),
(15, 'marca', 'String', '_qCd-UOO_EemTk6CKSpsZQA', 16, 1),
(16, 'precio', 'Real', '_qCd-UOO_EemTk6CKSpsZQA', 16, 1),
(17, 'estatura', 'Real', '_ubQ5gO8CEemSLPSU26dDbA', 19, 1),
(18, 'marca', 'String', '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(19, 'color', 'String', '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(20, 'motor', '_9lEF8OOYEemTk6CKSpsZQA', '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(21, 'radiomp3', '_qCd-UOO_EemTk6CKSpsZQA', '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(22, 'numCilindros', 'Integer', '_9lEF8OOYEemTk6CKSpsZQA', 20, 2),
(23, 'marca', 'String', '_qCd-UOO_EemTk6CKSpsZQA', 20, 2),
(24, 'precio', 'Real', '_qCd-UOO_EemTk6CKSpsZQA', 20, 2),
(26, 'estatura', 'Real', '_ubQ5gO8CEemSLPSU26dDbA', 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idClases` varchar(100) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `herencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idModelo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`idClases`, `nombre`, `herencia`, `idModelo`, `idUsuario`) VALUES
('_9lEF8OOYEemTk6CKSpsZQA', 'Motor', '', 16, 1),
('_9lEF8OOYEemTk6CKSpsZQA', 'Motor', '', 20, 2),
('_AqqAEMs-EemR9Zq8Q2DrwQ', 'Auto', '_w_V7wOO9EemTk6CKSpsZQA', 16, 1),
('_AqqAEMs-EemR9Zq8Q2DrwQ', 'Auto', '_w_V7wOO9EemTk6CKSpsZQA', 20, 2),
('_qCd-UOO_EemTk6CKSpsZQA', 'RadioMP3', '', 16, 1),
('_qCd-UOO_EemTk6CKSpsZQA', 'RadioMP3', '', 20, 2),
('_ubQ5gO8CEemSLPSU26dDbA', 'Cuerpo', '', 19, 1),
('_ubQ5gO8CEemSLPSU26dDbA', 'Cuerpo', '', 22, 2),
('_w_V7wOO9EemTk6CKSpsZQA', 'VehiculoTerrestre', '', 16, 1),
('_w_V7wOO9EemTk6CKSpsZQA', 'VehiculoTerrestre', '', 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos`
--

CREATE TABLE `metodos` (
  `idMetodos` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `idClases` varchar(100) NOT NULL,
  `idModelo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metodos`
--

INSERT INTO `metodos` (`idMetodos`, `nombre`, `tipo`, `idClases`, `idModelo`, `idUsuario`) VALUES
(12, 'encender', NULL, '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(13, 'setNumCilindros', NULL, '_9lEF8OOYEemTk6CKSpsZQA', 16, 1),
(14, 'getNumCilindros', NULL, '_9lEF8OOYEemTk6CKSpsZQA', 16, 1),
(15, 'trasladar', NULL, '_w_V7wOO9EemTk6CKSpsZQA', 16, 1),
(16, 'tocarMusica', NULL, '_qCd-UOO_EemTk6CKSpsZQA', 16, 1),
(17, 'setEstatura', NULL, '_ubQ5gO8CEemSLPSU26dDbA', 19, 1),
(18, 'getEstatura', NULL, '_ubQ5gO8CEemSLPSU26dDbA', 19, 1),
(19, 'encender', NULL, '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(20, 'setNumCilindros', NULL, '_9lEF8OOYEemTk6CKSpsZQA', 20, 2),
(21, 'getNumCilindros', NULL, '_9lEF8OOYEemTk6CKSpsZQA', 20, 2),
(22, 'trasladar', NULL, '_w_V7wOO9EemTk6CKSpsZQA', 20, 2),
(23, 'tocarMusica', NULL, '_qCd-UOO_EemTk6CKSpsZQA', 20, 2),
(26, 'setEstatura', NULL, '_ubQ5gO8CEemSLPSU26dDbA', 22, 2),
(27, 'getEstatura', NULL, '_ubQ5gO8CEemSLPSU26dDbA', 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `idModelo` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`idModelo`, `nombre`, `idUsuario`) VALUES
(16, 'CarroCompleto', 1),
(19, 'Cuerpo', 1),
(20, 'ModeloCarro', 2),
(22, 'ModeloCuerpo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `idParametros` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idMetodos` int(11) NOT NULL,
  `idClases` varchar(100) NOT NULL,
  `idModelo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`idParametros`, `nombre`, `tipo`, `idMetodos`, `idClases`, `idModelo`, `idUsuario`) VALUES
(4, 'msg', 'String', 12, '_AqqAEMs-EemR9Zq8Q2DrwQ', 16, 1),
(5, 'numC', 'Integer', 13, '_9lEF8OOYEemTk6CKSpsZQA', 16, 1),
(6, 'size', 'Real', 17, '_ubQ5gO8CEemSLPSU26dDbA', 19, 1),
(7, 'est', 'Real', 17, '_ubQ5gO8CEemSLPSU26dDbA', 19, 1),
(8, 'msg', 'String', 19, '_AqqAEMs-EemR9Zq8Q2DrwQ', 20, 2),
(9, 'numC', 'Integer', 20, '_9lEF8OOYEemTk6CKSpsZQA', 20, 2),
(12, 'size', 'Real', 26, '_ubQ5gO8CEemSLPSU26dDbA', 22, 2),
(13, 'est', 'Real', 26, '_ubQ5gO8CEemSLPSU26dDbA', 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre_usuario`, `contrasena`) VALUES
(1, 'arturo', 'arturo'),
(2, 'profesor', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`idAtributos`,`idClases`,`idModelo`,`idUsuario`),
  ADD KEY `idClases` (`idClases`,`idModelo`,`idUsuario`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`idClases`,`idModelo`,`idUsuario`),
  ADD KEY `idModelo` (`idModelo`,`idUsuario`);

--
-- Indices de la tabla `metodos`
--
ALTER TABLE `metodos`
  ADD PRIMARY KEY (`idMetodos`,`idClases`,`idModelo`,`idUsuario`),
  ADD KEY `idClases` (`idClases`,`idModelo`,`idUsuario`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`idModelo`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`idParametros`,`idMetodos`,`idClases`,`idModelo`,`idUsuario`),
  ADD KEY `idMetodos` (`idMetodos`,`idClases`,`idModelo`,`idUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atributos`
--
ALTER TABLE `atributos`
  MODIFY `idAtributos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `metodos`
--
ALTER TABLE `metodos`
  MODIFY `idMetodos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `idModelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `idParametros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD CONSTRAINT `atributos_ibfk_1` FOREIGN KEY (`idClases`,`idModelo`,`idUsuario`) REFERENCES `clases` (`idClases`, `idModelo`, `idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`idModelo`,`idUsuario`) REFERENCES `modelo` (`idModelo`, `idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `metodos`
--
ALTER TABLE `metodos`
  ADD CONSTRAINT `metodos_ibfk_1` FOREIGN KEY (`idClases`,`idModelo`,`idUsuario`) REFERENCES `clases` (`idClases`, `idModelo`, `idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD CONSTRAINT `parametros_ibfk_1` FOREIGN KEY (`idMetodos`,`idClases`,`idModelo`,`idUsuario`) REFERENCES `metodos` (`idMetodos`, `idClases`, `idModelo`, `idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
