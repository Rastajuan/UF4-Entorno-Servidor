-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 27-11-2022 a les 23:30:09
-- Versió del servidor: 10.4.22-MariaDB
-- Versió de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `ifpdb`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'Actividad sin título',
  `ciudad` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `precio` bit(1) NOT NULL,
  `usuario` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `actividades`
--

INSERT INTO `actividades` (`id`, `titulo`, `ciudad`, `fecha`, `tipo`, `precio`, `usuario`) VALUES
(1, 'Cine a la fresca', 'Murcia', '2022-11-30', 'Cine', b'0', 'El nene'),
(2, 'Concierto violines', 'Murcia', '2022-12-16', 'Música', b'0', 'El nene'),
(3, 'Barbacoa', 'Sabadell', '2022-12-14', 'Comida', b'1', 'El Machaca'),
(4, 'Cata de vinos', 'Terrassa', '2022-12-14', 'Copas', b'0', 'El Machaca'),
(5, 'Museo de cera', 'Castellón', '2022-12-08', 'Cultura', b'1', 'Guapa de cara'),
(6, 'Crucero Mediterráneo', 'Barcelona', '2022-12-22', 'Viajes', b'0', 'Guapa de cara'),
(7, 'Concierto Metallica', 'Barelona', '2022-12-15', 'Música', b'0', 'Rastajuan'),
(8, 'Estreno Avatar 2', 'Barcelona', '2022-12-30', 'Cine', b'0', 'Rastajuan'),
(9, 'Excursio a Montserrat', 'Tarragona', '2022-11-03', 'Cultura', b'0', 'Guapa de cara'),
(10, 'Escalada', 'Sort', '2022-11-18', 'Cultura', b'0', 'PHP The King'),
(11, 'La prueba del de prueba', 'Cancún', '2022-12-08', 'Comida', b'0', 'El típico user de prueba'),
(12, 'Playa', 'Sitges', '2022-11-17', 'Viajes', b'1', 'El típico user de prueba');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `contraseña` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `usuarios`
--

INSERT INTO `usuarios` (`id`, `contraseña`, `correo`, `nombre`) VALUES
('El Machaca', '1111', 'andres@correo.com', 'Andrés'),
('El nene', '1111', 'luis@correo.com', 'Luis'),
('El típico user de prueba', '1111', 'user@user.com', 'user'),
('Guapa de cara', '1111', 'antonella@correo.com', 'Antonella'),
('PHP The King', '1111', 'jesus@jesus.com', 'Jesús'),
('Rastajuan', '1111', 'juan@correo.com', 'Juan');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iduser` (`usuario`);

--
-- Índexs per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
