-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2022 a las 13:26:57
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zgaming`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(29, 'Consolas'),
(30, 'Juegos'),
(31, 'Accesorios'),
(32, 'Gaming');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220526103846', '2022-05-28 13:45:08', 36),
('DoctrineMigrations\\Version20220526114244', '2022-05-28 13:45:08', 5),
('DoctrineMigrations\\Version20220526155129', '2022-05-28 13:45:08', 40),
('DoctrineMigrations\\Version20220527095851', '2022-05-28 13:45:08', 5),
('DoctrineMigrations\\Version20220528114605', '2022-05-28 13:46:20', 76),
('DoctrineMigrations\\Version20220528120656', '2022-05-28 14:07:05', 77),
('DoctrineMigrations\\Version20220528120817', '2022-05-28 14:08:28', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria_id`) VALUES
(3, 'Demons Souls', 'Este remake, rediseñado por completo, te invita a sufrir su despiadado mundo', 59.99, '17b057962930795fed4d75bba49b3f9a.jpg', 30),
(4, 'Nier Automata', 'Juego que trata sobre el existencialismo de los androides', 29.99, '5f354404db1185ad4d65dbd85e4f6f07.jpg', 30),
(5, 'Portatil Gamer', 'Portatil potente con las ultimas tecnologias de Intel y Nvidia', 999.99, '3b25d7b396db50dff455aa569719da51.jpg', 32),
(6, 'Nintendo Switch', 'Consola portatil para jugar en cualquier sitio', 399.99, 'e85136a6493cb580f17befc59a7e8983.jpg', 29),
(7, 'PlayStation 2', 'La mítica consola antigua para disfrutar', 699.99, '2acf27c36566a47d4f89c27b32b1f2fd.jpg', 29),
(8, 'Nintendo DS', 'Una consola portátil antigua', 99.99, 'f741bdd3d66b83de879336d73f9aab23.jpg', 29),
(9, 'Logitech G900 - Mouse', 'Ratón de altos DPI', 79.99, '2cfc9e9925b676e5d28c0ce74f2462db.jpg', 31),
(10, 'Azure Cascos 3D', 'Cascos con buen sonido', 120, 'a6b224b6679c1c653768a8aa290f5859.jpg', 31),
(11, 'Teclado G500', 'Teclado con mecácnico con Leds', 149.99, '366812ba4cfb7f31e90e3da53a1bea94.jpg', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `roles`, `password`) VALUES
(3, 'admin@gmail.com', '[]', '$2y$13$jDF8Kk8IIGwtzYLgBiYXquZuDnakekvzlXMOOqkPbLFQbR9Lk4SmO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7BB06153397707A` (`categoria_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
