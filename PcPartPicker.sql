-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 10-05-2026 a las 19:07:46
-- Versión del servidor: 9.6.0
-- Versión de PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE DATABASE IF NOT EXISTS PcPartPicker CHARACTER SET utf8mb4;
USE PcPartPicker;

--
-- Base de datos: `PcPartPicker`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id` int NOT NULL,
  `tipoComponente` enum('Procesador','TarjetaGrafica','MemoriaRAM') NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `consumo` int NOT NULL,
  `anioLanzamiento` int NOT NULL,
  `nucleos` int DEFAULT NULL,
  `frecuencia` decimal(8,2) DEFAULT NULL,
  `socket` varchar(50) DEFAULT NULL,
  `memoriaVRAM` int DEFAULT NULL,
  `velocidadMemoria` int DEFAULT NULL,
  `ensamblador` varchar(100) DEFAULT NULL,
  `capacidad` int DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `latencia` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id`, `tipoComponente`, `nombre`, `fabricante`, `precio`, `consumo`, `anioLanzamiento`, `nucleos`, `frecuencia`, `socket`, `memoriaVRAM`, `velocidadMemoria`, `ensamblador`, `capacidad`, `tipo`, `latencia`) VALUES
(1, 'Procesador', 'Ryzen 9 7900X3D', 'AMD', 572.80, 120, 2023, 12, 5.60, 'AM5', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'TarjetaGrafica', 'PNY GeForce RTX 4080 XLR8 Gaming VERTO EPIC-X RGB Triple Fan', 'Nvidia', 1112.94, 320, 2022, NULL, NULL, NULL, 16, 2505, 'PNY', NULL, NULL, NULL),
(3, 'MemoriaRAM', 'Corsair Vengeance', 'Corsair', 399.99, 1, 2020, NULL, 6000.00, NULL, NULL, NULL, NULL, 32, 'DDR5', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
(1, 'prueba@prueba.com', '$2y$10$mMMJaKQ3huBh6s23e1TmCueysbuwwEksGk19JxZJykFhF9EcMHZ9K');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
