-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2020 a las 23:59:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `la_comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `Id` int(11) NOT NULL,
  `EmpleadoId` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `Id` int(11) NOT NULL,
  `Pedido` int(11) NOT NULL,
  `Responsable` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Inicio` datetime DEFAULT NULL,
  `Fin` datetime DEFAULT NULL,
  `ProductoId` int(11) NOT NULL,
  `Puntaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadodetallepedido`
--

CREATE TABLE `estadodetallepedido` (
  `Id` int(11) NOT NULL,
  `Estado` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadodetallepedido`
--

INSERT INTO `estadodetallepedido` (`Id`, `Estado`) VALUES
(1, 'espera'),
(2, 'preparando'),
(3, 'listo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadomesa`
--

CREATE TABLE `estadomesa` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadomesa`
--

INSERT INTO `estadomesa` (`Id`, `Nombre`) VALUES
(1, 'Abierta'),
(2, 'EsperandoPedido'),
(3, 'Comiendo'),
(4, 'Pagando'),
(5, 'Cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedido`
--

CREATE TABLE `estadopedido` (
  `Id` int(11) NOT NULL,
  `Estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadopedido`
--

INSERT INTO `estadopedido` (`Id`, `Estado`) VALUES
(1, 'EnPreparacion'),
(2, 'ListoParaServir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `Id` int(11) NOT NULL,
  `Codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `EstadoMesaId` int(11) NOT NULL,
  `Puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Id` int(11) NOT NULL,
  `Codigo` varchar(5) NOT NULL,
  `NombreCliente` varchar(45) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Estado` int(11) NOT NULL,
  `TiempoEstimado` int(11) NOT NULL,
  `MesaId` int(11) NOT NULL,
  `MozoId` int(11) NOT NULL,
  `PuntajeMesa` int(11) DEFAULT NULL,
  `PuntajeMozo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `TiempoEstimado` int(11) NOT NULL,
  `TipoProductoId` int(11) NOT NULL,
  `Precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesempleados`
--

CREATE TABLE `rolesempleados` (
  `Id` int(11) NOT NULL,
  `NombreRolEmpleado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolesempleados`
--

INSERT INTO `rolesempleados` (`Id`, `NombreRolEmpleado`) VALUES
(1, 'Cocinero'),
(2, 'Bartender'),
(3, 'Cervecero'),
(4, 'Mozo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesusuarios`
--

CREATE TABLE `rolesusuarios` (
  `Id` int(11) NOT NULL,
  `NombreRol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolesusuarios`
--

INSERT INTO `rolesusuarios` (`Id`, `NombreRol`) VALUES
(1, 'Cliente'),
(3, 'Socio'),
(4, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproductos`
--

CREATE TABLE `tipoproductos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoproductos`
--

INSERT INTO `tipoproductos` (`Id`, `Nombre`) VALUES
(1, 'Cocina'),
(2, 'BarCervezas'),
(3, 'TragosYVinos'),
(4, 'CandyBar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `RolUsuarioID` int(11) NOT NULL,
  `RolEmpleadoID` int(11) DEFAULT NULL,
  `Password` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_Acceso_Empleado` (`EmpleadoId`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_DetallePedido_EstadoDetallePedido` (`Estado`),
  ADD KEY `FK_DetallePedido_Producto` (`ProductoId`),
  ADD KEY `FK_DetallePedido_Usuario` (`Responsable`),
  ADD KEY `FK_DetallePedido_Pedido` (`Pedido`);

--
-- Indices de la tabla `estadodetallepedido`
--
ALTER TABLE `estadodetallepedido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `estadomesa`
--
ALTER TABLE `estadomesa`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_Mesa_EstadoMesa` (`EstadoMesaId`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_estadoPedido` (`Estado`),
  ADD KEY `fk_mozo` (`MozoId`),
  ADD KEY `fk_mesa` (`MesaId`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_Producto_TipoProducto` (`TipoProductoId`);

--
-- Indices de la tabla `rolesempleados`
--
ALTER TABLE `rolesempleados`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `rolesusuarios`
--
ALTER TABLE `rolesusuarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `FK_Usuario_RolEmpleado` (`RolEmpleadoID`),
  ADD KEY `FK_Usuario_RolUsuario` (`RolUsuarioID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadodetallepedido`
--
ALTER TABLE `estadodetallepedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadomesa`
--
ALTER TABLE `estadomesa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rolesempleados`
--
ALTER TABLE `rolesempleados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rolesusuarios`
--
ALTER TABLE `rolesusuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `FK_Acceso_Empleado` FOREIGN KEY (`EmpleadoId`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `FK_DetallePedido_EstadoDetallePedido` FOREIGN KEY (`Estado`) REFERENCES `estadodetallepedido` (`id`),
  ADD CONSTRAINT `FK_DetallePedido_Pedido` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`Id`),
  ADD CONSTRAINT `FK_DetallePedido_Producto` FOREIGN KEY (`ProductoId`) REFERENCES `productos` (`Id`),
  ADD CONSTRAINT `FK_DetallePedido_Usuario` FOREIGN KEY (`Responsable`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `FK_Mesa_EstadoMesa` FOREIGN KEY (`EstadoMesaId`) REFERENCES `estadomesa` (`Id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_Pedido_Estado` FOREIGN KEY (`Estado`) REFERENCES `estadopedido` (`id`),
  ADD CONSTRAINT `FK_Pedido_Mesa` FOREIGN KEY (`MesaId`) REFERENCES `mesas` (`Id`),
  ADD CONSTRAINT `FK_Pedido_Mozo` FOREIGN KEY (`MozoId`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_Producto_TipoProducto` FOREIGN KEY (`TipoProductoId`) REFERENCES `tipoproductos` (`Id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Usuario_RolEmpleado` FOREIGN KEY (`RolEmpleadoID`) REFERENCES `rolesempleados` (`Id`),
  ADD CONSTRAINT `FK_Usuario_RolUsuario` FOREIGN KEY (`RolUsuarioID`) REFERENCES `rolesusuarios` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
