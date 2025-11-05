-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 08:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_alojamientos`
--

-- --------------------------------------------------------

--
-- Table structure for table `alojamientos`
--

CREATE TABLE `alojamientos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `ubicacion` varchar(150) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alojamientos`
--

INSERT INTO `alojamientos` (`id`, `nombre`, `descripcion`, `ubicacion`, `precio`, `imagen`) VALUES
(1, 'Barcelo San Salvador', 'Hotel de categoría ejecutiva/lujo ubicado en la zona moderna de San Salvador, con servicios completos para negocios y turismo.', 'Bulevar del Hipódromo, San Salvador, El Salvador.', 25.00, 'barcelosansalvador.jpg'),
(2, 'Best Western Plus Hotel Terraza', 'Hotel de cadena reconocida, con comodidades estándar superiores, adecuado para visitantes que buscan confort.', '85 Avenida Sur & Calle Padres Aguilar 437, San Salvador, El Salvador.', 50.00, 'bestwestern.jpg'),
(3, 'Hotel Abrego', 'Hotel económico situado en una zona céntrica de la ciudad, ideal para estadías de bajo costo.', '3 Avenida Norte 110, San Salvador, El Salvador.', 20.00, 'abrego.jpg'),
(4, 'Boca Olas Resort & Villas ', 'Resort de playa con ambiente vacacional, ideal para descanso, ubicado en la costa de El Salvador.', 'El Tunco, El Salvador.', 235.00, 'bocaolas.jpg'),
(5, 'Courtyard by Marriott San Salvador', 'Hotel de 4 estrellas de la cadena Marriott, orientado a viajeros de negocios y turismo medio, ubicado en zona moderna de San Salvador.', 'Centro de Estilo de Vida La Gran Vía, esquina Calle 2 San Salvador, El Salvador.', 140.00, 'marriott.jpg'),
(6, 'Sheraton Presidente San Salvador Hotel', 'Otro hotel de categoría alta, perteneciente a la cadena Sheraton, adecuado para negocios o estadías cómodas en San Salvador.', 'Avenida de la Revolución, Colonia San Benito, San Salvador, El Salvador.', 150.00, 'sheraton.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('usuario','admin') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `tipo`) VALUES
(1, 'Wendy', 'mendozawen134@gmail.com', '$2y$10$5cMUhKYc4duBHvcW3arz2.xsptebahaLjSd5Qa2E27t7.beeWrjpy', 'usuario'),
(2, 'admin', 'admin@mail.com', '$2y$10$jbSsE5uOE65SN54Qd.ZefuDH7QdnhZ7l3rFTV7dRtXPcH65Svdu8q', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_alojamientos`
--

CREATE TABLE `usuario_alojamientos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `alojamiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alojamientos`
--
ALTER TABLE `alojamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usuario_alojamientos`
--
ALTER TABLE `usuario_alojamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `alojamiento_id` (`alojamiento_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alojamientos`
--
ALTER TABLE `alojamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario_alojamientos`
--
ALTER TABLE `usuario_alojamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario_alojamientos`
--
ALTER TABLE `usuario_alojamientos`
  ADD CONSTRAINT `usuario_alojamientos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_alojamientos_ibfk_2` FOREIGN KEY (`alojamiento_id`) REFERENCES `alojamientos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
