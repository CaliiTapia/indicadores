-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2021 a las 05:18:11
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indicadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `id_indicador` int(11) NOT NULL,
  `tipo_indicador` int(11) NOT NULL,
  `valor` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_indicador`
--

CREATE TABLE `tipo_indicador` (
  `id_tipo` int(11) NOT NULL,
  `cod_mindicador` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `unidad_medida` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_indicador`
--

INSERT INTO `tipo_indicador` (`id_tipo`, `cod_mindicador`, `unidad_medida`, `descripcion`) VALUES
(1, 'uf', 'Pesos', 'Unidad de fomento (UF)'),
(2, 'ivp', 'Pesos', 'Indice de valor promedio (IVP)'),
(3, 'dolar', 'Pesos', 'Dólar observado'),
(4, 'dolar_intercambio', 'Pesos', 'Dólar acuerdo'),
(5, 'euro', 'Pesos', 'Euro'),
(6, 'ipc', 'Porcentaje', 'Indice de precios al consumidor (IPC)'),
(7, 'utm', 'Pesos', 'Unidad tributaria mensual (UTM)'),
(8, 'imacec', 'Porcentaje', 'Imacec'),
(9, 'tpm', 'Porcentaje', 'Tasa política monetaria'),
(10, 'libra_cobre', 'Dólar', 'Libra de cobre'),
(11, 'tasa_desempleo', 'Porcentaje', 'Tasa de desempleo'),
(12, 'bitcoin', 'Dólar', 'Bitcoin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`id_indicador`),
  ADD KEY `tipo_indicador` (`tipo_indicador`);

--
-- Indices de la tabla `tipo_indicador`
--
ALTER TABLE `tipo_indicador`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `id_indicador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_indicador`
--
ALTER TABLE `tipo_indicador`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `fk_tipoindicador` FOREIGN KEY (`tipo_indicador`) REFERENCES `tipo_indicador` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
