-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2026 a las 22:06:21
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd-ecommerce-codeigniter4`
CREATE DATABASE IF NOT EXISTS `bd-ecommerce-codeigniter4`;
USE `bd-ecommerce-codeigniter4`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1,
  `img` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `activo`, `img`) VALUES
(1, 'Aceites', 1, 'categoria_aceites.jpg'),
(2, 'Frutos Secos y Frutas Deshidratas', 1, 'categoria_frutosSecos.jpg'),
(5, 'Azucar, condimentos y especias', 1, 'categoria_azucarCondimentos.jpg'),
(7, 'Harinas y Feculas', 1, 'categoria_harinasFeculas.jpg'),
(9, 'Suplementos', 1, 'categoria_suplementos.jpg'),
(11, 'Congelados', 1, 'categoria_congelados.jpg'),
(13, 'Cereales', 1, 'categoria_cereales.jpg'),
(15, 'Legumbres y semillas', 1, 'categoria_semillasLegumbres.jpg'),
(17, 'Galletitas', 1, 'categoria_galletitas.jpg'),
(19, 'Leche y Atún', 1, 'categoria_lechesAtun.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `fecha_envio` date NOT NULL DEFAULT current_timestamp(),
  `fuente` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nombre_emisor` varchar(70) CHARACTER SET utf8 NOT NULL,
  `nombre_usuario` varchar(70) CHARACTER SET utf8 NOT NULL,
  `email` varchar(70) CHARACTER SET utf8 NOT NULL,
  `telefono` varchar(40) CHARACTER SET utf8 NOT NULL,
  `mensaje` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `estado` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `fecha_envio`, `fuente`, `nombre_emisor`, `nombre_usuario`, `email`, `telefono`, `mensaje`, `estado`) VALUES
(1, '2024-05-31', 'Contacto', 'Esteban', 'No registrado', 'Esteban@gmail.com', '44622199', 'Mando este mensaje para probar si funciona la pág.', 3),
(2, '2024-05-31', 'Consultas', 'Luis Diaz', 'Luis', 'Lucho97@gmail.com', 'No registrado', 'Hola, me comunico para saber si anda la pág de contactos...', 3),
(3, '2024-05-31', 'Consultas', 'Federico Pérez Ruiz', 'Admin', 'admin@gmail.com', 'No registrado', 'probando', 3),
(4, '2024-05-31', 'Contacto', 'Lucas', 'No registrado', 'LucasKpo_07@gmail.com', '3795010005', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2),
(5, '2024-06-15', 'Consultas', 'Enzo Canteros', 'cde', 'enzod.canterros@gmail.com', 'No registrado', 'holis', 1),
(6, '2024-06-18', 'Consultas', 'Luis Diaz', 'Luis', 'Lucho97@gmail.com', 'No registrado', 'Buenos dias', 1),
(7, '2024-06-18', 'Contacto', 'Jose', 'No registrado', 'dede@gmail.com', '331313', 'hola jose', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil_id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil_id`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_prod` varchar(100) CHARACTER SET utf8 NOT NULL,
  `imagen` varchar(200) CHARACTER SET utf8 NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_vta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `eliminado` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'NO',
  `unidadesVendidas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_prod`, `imagen`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `eliminado`, `unidadesVendidas`) VALUES
(3, 'Aceite de girasol', 'aceiteGirasol.jpg', 1, 1800.00, 3270.00, 0, 3, 'NO', 12),
(7, 'Almendras', 'almendras.jpg', 2, 4000.00, 5890.00, 20, 3, 'NO', 0),
(8, 'Aceite de Coco', 'arrozDoble.jpg', 1, 3799.00, 7030.00, 7, 1, 'NO', 6),
(9, 'Aceite de oliva', 'aceiteOliva.jpg', 1, 4000.00, 7999.99, 7, 2, 'NO', 5),
(10, 'Arroz doble', 'arrozDoble.jpg', 13, 3000.00, 5152.99, 20, 5, 'NO', 0),
(11, 'Arroz Integral', 'arrozIntegral.jpg', 13, 1400.00, 2999.99, 7, 3, 'NO', 3),
(12, 'Arroz largo fino', 'arrozLargoFino.jpg', 13, 2000.00, 3499.99, 17, 3, 'NO', 3),
(13, 'Arroz Yamani', 'arrozYamani.jpg', 13, 2500.00, 3200.00, 10, 3, 'NO', 0),
(14, 'Azucar mascabo', 'azucarMascabo.jpg', 5, 1800.00, 2500.00, 10, 2, 'NO', 0),
(15, 'Arvejas Deshidratadas', 'arvejasDeshidratadas.jpg', 15, 2500.00, 3200.00, 6, 1, 'NO', 0),
(16, 'Arvejas en lata', 'arvejasLata.jpg', 15, 200.00, 599.00, 18, 3, 'NO', 2),
(17, 'Azúcar negra', 'azucarNegra.jpg', 5, 2300.00, 2999.99, 9, 3, 'NO', 1),
(18, 'Azúcar rubia', 'azucarRubia.jpg', 5, 1500.00, 2199.00, 10, 3, 'NO', 0),
(19, 'Banana Deshidratadas', 'bananaDeshidratada.jpg', 2, 3000.00, 3999.99, 11, 3, 'NO', 4),
(20, 'Cafeina', 'cafeina.jpg', 9, 7000.00, 9999.99, 5, 2, 'NO', 0),
(21, 'Cereales copos de Maiz', 'coposDeMaizCereal.jpg', 13, 2000.00, 3599.00, 15, 3, 'NO', 0),
(22, 'Creatina', 'creatina.jpg', 9, 20000.00, 25000.00, 6, 2, 'NO', 0),
(23, 'Electrolitos', 'electrolitos.jpg', 9, 4000.00, 7000.00, 9, 2, 'NO', 0),
(24, 'Fécula de maíz', 'feculaMaiz.jpg', 7, 1200.00, 2000.00, 10, 2, 'NO', 0),
(25, 'Fécula de mandioca', 'feculaMandioca.jpg', 7, 799.00, 1499.00, 10, 3, 'NO', 0),
(26, 'Fécula de papa', 'feculaPapa.jpg', 7, 2500.00, 4300.00, 6, 2, 'NO', 0),
(27, 'Mix Frutos Secos', 'frutosSecos.jpg', 2, 2000.00, 3500.00, 10, 2, 'NO', 0),
(28, 'Cacao amargo', 'cacaoAmargo.png', 5, 4000.00, 6178.99, 9, 2, 'NO', 1),
(29, 'Canela en rama', 'canelaEnRama.jpg', 5, 7000.00, 7900.00, 10, 2, 'NO', 0),
(30, 'Canela molida', 'canelaMolida.jpg', 5, 7000.00, 7900.00, 10, 3, 'NO', 0),
(31, 'Coco rallado', 'cocoRallado.jpg', 2, 3000.00, 3500.00, 10, 3, 'NO', 0),
(32, 'Cúrcuma', 'curcuma.jpg', 5, 4999.00, 5220.00, 6, 2, 'NO', 0),
(33, 'Galletitas de arroz con sal', 'galletitasArrozConSal.jpg', 17, 1200.00, 1500.00, 10, 2, 'NO', 0),
(34, 'Galletitas de arroz sin sal', 'galletitasArrozSinSal.jpg', 17, 1200.00, 1500.00, 10, 2, 'NO', 0),
(35, 'Galletitas de avena y miel', 'galletitasAvenaYMiel.jpg', 17, 1500.00, 1800.00, 10, 3, 'NO', 0),
(36, 'Galletitas de avena y pasas', 'galletitasAvenaYPasas.jpg', 17, 1500.00, 1900.00, 8, 2, 'NO', 0),
(37, 'Galletitas Paseo Multicereal', 'galletitasMulticereal.jpg', 17, 1600.00, 2000.00, 13, 3, 'NO', 0),
(38, 'Garbanzos', 'garbanzos.jpg', 15, 3000.00, 4000.00, 10, 2, 'NO', 0),
(39, 'Hamburguesas arveja y brocoli', 'hamburguesaArvejaYBrocoli.jpg', 11, 5000.00, 6000.00, 5, 2, 'NO', 0),
(40, 'Hamburguesas calabaza y choclo', 'hamburguesaCalabazaYChoclo.jpg', 11, 5000.00, 6000.00, 9, 3, 'NO', 1),
(41, 'Hamburguesas espinaca y pimientos', 'hamburguesaEspinacaYPimientos.png', 11, 5000.00, 6000.00, 10, 3, 'NO', 0),
(42, 'Hamburguesas lenteja y calabaza', 'hamburguesaLentejaYcalabaza.jpg', 11, 5000.00, 6000.00, 13, 2, 'NO', 0),
(43, 'Hamburguesas lenteja y zanahoria', 'hamburguesaLentejaYZanahoria.jpg', 11, 5000.00, 6000.00, 10, 2, 'NO', 0),
(44, 'Hamburguesas mijo y remolacha', 'hamburguesaMijoYRemolacha.jpg', 11, 5000.00, 6000.00, 8, 2, 'NO', 0),
(45, 'Hamburguesas seitan', 'hamburguesaSeitan.png', 11, 5000.00, 6000.00, 10, 2, 'NO', 0),
(46, 'Harina de almendras', 'harinaAlmendras.jpg', 7, 4000.00, 5000.00, 8, 2, 'NO', 2),
(47, 'Harina de arvejas', 'harinaArvejas.jpg', 7, 2900.00, 3500.00, 8, 2, 'NO', 0),
(48, 'Harina integral', 'harinaIntegral.jpg', 7, 800.00, 1400.00, 10, 2, 'NO', 0),
(49, 'Harina de Maíz', 'harinaMaiz.jpg', 7, 2000.00, 2500.00, 10, 2, 'NO', 0),
(50, 'Harina de trigo integral', 'harinaTrigoOrganica.jpg', 7, 1400.00, 2000.00, 10, 2, 'NO', 0),
(51, 'Leche de almendra', 'lecheAlmendra.jpg', 19, 2500.00, 3200.00, 10, 2, 'NO', 0),
(52, 'Leche de coco', 'lecheCoco.jpg', 19, 2500.00, 3200.00, 8, 2, 'NO', 2),
(53, 'Leche deslactosada', 'lecheDeslactosada.jpg', 19, 2500.00, 3200.00, 10, 2, 'NO', 0),
(54, 'Leche entera', 'lecheEntera.jpg', 19, 2800.00, 3500.00, 14, 2, 'NO', 6),
(55, 'Leche proteica', 'lecheProteica.jpg', 19, 2800.00, 3500.00, 10, 2, 'NO', 0),
(56, 'Leche de soja', 'lecheSoja.jpg', 19, 2500.00, 3200.00, 10, 2, 'NO', 0),
(57, 'Lentejas', 'lentejas.jpg', 15, 2000.00, 3000.00, 10, 2, 'NO', 0),
(58, 'Maní con sal', 'maniConSal.jpg', 2, 3000.00, 4000.00, 2, 3, 'NO', 10),
(59, 'Maní sin sal', 'maniSinSal.jpg', 2, 3000.00, 4000.00, 12, 2, 'NO', 0),
(60, 'Miel', 'miel.jpg', 5, 4000.00, 6000.00, 3, 2, 'NO', 5),
(61, 'Mix semillas para ensalada', 'mixSemillasEnsalada.jpeg', 15, 2000.00, 2500.00, 8, 2, 'NO', 0),
(62, 'Multivitamínico', 'multivitaminico.jpg', 9, 6000.00, 7000.00, 10, 2, 'NO', 0),
(63, 'Nueces con cascara', 'nuecesConCascara.jpg', 2, 5000.00, 6000.00, 10, 2, 'NO', 0),
(64, 'Nueces mariposas', 'nuecesMariposas.jpg', 2, 4000.00, 5000.00, 10, 2, 'NO', 0),
(65, 'Pasas de uva', 'pasasUva.jpg', 2, 2500.00, 3100.00, 10, 2, 'NO', 0),
(66, 'Pechuga de pollo', 'pechugaPollo.jpg', 11, 4000.00, 6000.00, 8, 2, 'NO', 2),
(67, 'Porotos ', 'porotos.jpg', 15, 600.00, 780.00, 10, 2, 'NO', 0),
(68, 'Porotos colorados', 'porotosColorados.jpg', 15, 1000.00, 1250.00, 10, 2, 'NO', 0),
(69, 'Porotos negros', 'porotosNegros.jpg', 15, 1000.00, 1250.00, 8, 2, 'NO', 1),
(70, 'Proteína en polvo', 'proteinaWheyProtein.jpg', 9, 22000.00, 26000.00, 10, 2, 'NO', 0),
(71, 'Quinoa blanca', 'quinoaBlanca.jpg', 15, 5000.00, 6000.00, 8, 2, 'NO', 0),
(72, 'Salvado de avena', 'salvadoAvena.jpg', 15, 2000.00, 2400.00, 12, 2, 'NO', 0),
(73, 'Semillas chía', 'semillasChia.jpg', 15, 2000.00, 2500.00, 8, 2, 'NO', 0),
(74, 'Semillas girasol', 'semillasGirasol.jpg', 15, 1500.00, 2000.00, 10, 2, 'NO', 0),
(75, 'Semillas lino', 'semillasLino.jpg', 15, 2000.00, 2500.00, 9, 2, 'NO', 0),
(76, 'Semillas de zapallo', 'semillasZapallo.jpg', 15, 2500.00, 3000.00, 10, 2, 'NO', 0),
(77, 'Soja texturizada', 'sojaTexturizada.jpg', 15, 6000.00, 8000.00, 10, 2, 'NO', 0),
(78, 'Taurina', 'taurina.jpg', 9, 6000.00, 8000.00, 5, 2, 'NO', 0),
(79, 'Vitamina B1', 'vitaminaB1.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(80, 'Vitamina B3', 'vitaminaB3.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(81, 'Vitamina B6', 'vitaminaB6.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(82, 'Vitamina B9', 'vitaminaB9.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(83, 'Vitamina B12', 'vitaminaB12.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(84, 'Vitamina C', 'vitaminaC.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(85, 'Vitamina D3', 'vitaminaD3.jpg', 9, 6000.00, 8000.00, 8, 2, 'NO', 0),
(86, 'Vitamina E', 'vitaminaE.jpg', 9, 6000.00, 8000.00, 7, 2, 'NO', 1),
(87, 'Hierro', 'hierro.jpg', 9, 9000.00, 11999.99, 10, 2, 'NO', 0),
(88, 'Colageno', 'colageno.jpg', 9, 18000.00, 24000.00, 10, 2, 'NO', 0),
(89, 'Avena instantánea', 'avenaInstantanea.jpg', 15, 1400.00, 1800.00, 19, 2, 'NO', 1),
(90, 'Crema de maní', 'cremaMani.jpg', 2, 3000.00, 4500.00, 9, 2, 'NO', 1),
(91, 'Albumina de huevo', 'albuminaHuevo.jpg', 9, 10000.00, 11000.00, 7, 2, 'NO', 2),
(92, 'Atún en lata', 'atunNatural.jpg', 19, 2000.00, 3000.00, 19, 3, 'NO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `baja` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `pass`, `perfil_id`, `baja`) VALUES
(45, 'Mohamed', 'Puskaz', 'prueba@gmail.com', 'Mo08', '$2y$10$W25JO/zvxiMSZga5Kb17..iXzXdtTVUfP8XvZAWnurZcnzr2wQYLy', 2, 'SI'),
(49, 'Federico', 'Pérez Ruiz', 'admin@gmail.com', 'Admin', '$2y$10$TTeEz4APmrRoTnq18scZxe4EQKekeyK5WAMflRHmoGbiR9xvp32l2', 1, 'NO'),
(56, 'Federico', 'Pérez Ruiz', 'fedepruniversidad@gmail.com', 'Fede002', '$2y$10$ZcnQHOYOkkbMvCATM8mFAum8hqV9tJIefOUix4OAUbsgB3gvzr2om', 1, 'NO'),
(57, 'Luis', 'Diaz', 'Lucho97@gmail.com', 'Luis', '$2y$10$JmL5.VO/nDORqG2827qv5ejQxdzLNc6Hok3cJCkujRPof5XrFNO2m', 2, 'SI'),
(58, 'Santiago', 'Pérez', 'santyprez.sp@gmail.com', 'sefee', '$2y$10$TYflb34Vrp98ugWx7Y9pDuzmp6wVQSre/WIwFgJdvBF2wDifQj9b.', 2, 'NO'),
(59, 'Enzo', 'Canteros', 'enzod.canterros@gmail.com', 'cde', '$2y$10$8A9jCWZSbbt4bSShTlX4TuXuMpD9kLX14MN.Nvqv04hlY9EtY4lQW', 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `usuario_id`, `total_venta`) VALUES
(1, '2024-06-04', 57, 21093.00),
(2, '2024-06-04', 57, 6540.00),
(3, '2024-06-04', 57, 23999.97),
(4, '2024-06-04', 57, 22000.00),
(5, '2024-06-05', 57, 34173.00),
(6, '2024-06-05', 58, 70000.00),
(7, '2024-06-06', 58, 13999.96),
(8, '2024-06-06', 58, 10999.98),
(9, '2024-06-07', 58, 1800.00),
(10, '2024-06-07', 57, 16400.00),
(11, '2024-06-15', 59, 87896.93),
(12, '2024-06-18', 57, 24349.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 8, 3, 7031.00),
(2, 2, 3, 2, 3270.00),
(3, 3, 9, 3, 7999.99),
(4, 4, 91, 2, 11000.00),
(5, 5, 8, 3, 7031.00),
(6, 5, 3, 4, 3270.00),
(7, 6, 60, 5, 6000.00),
(8, 6, 58, 10, 4000.00),
(9, 7, 19, 2, 3999.99),
(10, 7, 11, 2, 2999.99),
(11, 8, 11, 1, 2999.99),
(12, 8, 9, 1, 7999.99),
(13, 9, 89, 1, 1800.00),
(14, 10, 52, 2, 3200.00),
(15, 10, 46, 2, 5000.00),
(16, 11, 3, 1, 3270.00),
(17, 11, 12, 3, 3499.99),
(18, 11, 16, 2, 599.00),
(19, 11, 92, 1, 3000.00),
(20, 11, 17, 1, 2999.99),
(21, 11, 28, 1, 6178.99),
(22, 11, 19, 2, 3999.99),
(23, 11, 90, 1, 4500.00),
(24, 11, 40, 1, 6000.00),
(25, 11, 66, 2, 6000.00),
(26, 11, 69, 1, 1250.00),
(27, 11, 54, 6, 3500.00),
(28, 11, 86, 1, 8000.00),
(29, 12, 3, 5, 3270.00),
(30, 12, 9, 1, 7999.99);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `perfil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`perfil_id`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
