-- Creación de la Base de Datos `asistencia_db`
-- CREATE DATABASE `asistencia`;

-- USE `asistencia`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Estructura de tabla para la tabla `asistencia`
CREATE TABLE `assistance` (
  `idassistance` int(11) NOT NULL,
  `idalumno` int(11) NOT NULL,
  `idguardia` int(11),
  `kind_id` int(11) DEFAULT NULL,
  `fecha_star` datetime NOT NULL,
  `fecha_end` datetime DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Estructura de tabla para la tabla `calendario`
CREATE TABLE `calendar` (
  `idcalendar` int(11) NOT NULL,
  `idusuario` int(11),
  `title` varchar(200) NOT NULL,
  `color` varchar(50) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `tipo` int(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `holidays`
CREATE TABLE `holidays` (
  `idholidays` int(11) NOT NULL,
  `dateholidays` date NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Estructura de tabla para la tabla `institucion`
CREATE TABLE `institucion` (
  `idinstitucion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `avenida` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `anio` varchar(45) NOT NULL,
  `logo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcado de datos para la tabla `institucion`
INSERT INTO `institucion` (`idinstitucion`, `nombre`, `avenida`, `municipio`, `ciudad`, `estado`, `anio`, `logo`) VALUES
(1, 'ESCUELA PRIMARIA "21 DE AGOSTO"', 'Fraccionamiento CD.Yagul', 'CD. Yagul', 'Tlacolula', 'Oaxaca de Juárez', '2024', '1708023247.png');


-- Estructura de tabla para la tabla `permiso`
CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `permiso`
INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'calendario'),
(3, 'Institucion'),
(4, 'Alumno'),
(5, 'Asistencias'),
(6, 'Reportes Detallado'),
(7, 'Reportes Listado'),
(8, 'Acceso'),
(9, 'Seguridad'),
(10, 'Code Qr');

-- Estructura de tabla para la tabla `alumno`
CREATE TABLE `alumno` (
  `idalumno` int(11) NOT NULL,
  `tipo_alumno` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `idalu` varchar(9) NOT NULL,
  `datos1` varchar(45) NOT NULL,
  `datos2` varchar(45) NOT NULL,
  `curp` varchar(45),
  `nespeciales` varchar(45),
  `gpreescolar` varchar(45),
  `codigo` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Estructura de tabla para la tabla `usuario`
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idcalendar` int(11),
  `nombre` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `guardia`
CREATE TABLE `guardia` (
  `idguardia` int(11) NOT NULL,
  `idusuario` int(11),
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `tutor`
CREATE TABLE `tutor` (
  `idtutor` int(11),
  `idalumno` int(11),
  `nombretutor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `grupoescolar`
CREATE TABLE `grupoescolar` (
  `idgrupoescolar` int(11) NOT NULL,
  `idalumno` int(11),
  `grado` int(10) NOT NULL,
  `grupo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `edad`
CREATE TABLE `edad` (
  `idedad` int(11),
  `idalumno` int(11),
  `nacimiento` DATE,
  `edadestadistica` int(10) NOT NULL,
  `edadsiceeo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuario`
INSERT INTO `usuario` (`idusuario`, `nombre`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'Silver Octavio', 'Administrador', 'admin', 'admin', '1708023176.jpg', 1);

-- Estructura de tabla para la tabla `usuario_permiso`
CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuario_permiso`
INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(17, 1, 1),
(18, 1, 2),
(19, 1, 3),
(20, 1, 4),
(21, 1, 5),
(22, 1, 6),
(23, 1, 7),
(24, 1, 8),
(25, 1, 9),
(26, 1, 10);

-- Índices para tablas volcadas

ALTER TABLE `assistance`
  ADD PRIMARY KEY (`idassistance`),
  ADD KEY `fk_assistance_alumno_idx` (`idalumno`),
  ADD KEY `fk_assistance_guardia_idx` (`idguardia`);

ALTER TABLE `calendar`
	ADD PRIMARY KEY (`idcalendar`),
	ADD KEY `fk_calendar_usuario_idx` (`idusuario`);

ALTER TABLE `holidays`
  ADD PRIMARY KEY (`idholidays`);

ALTER TABLE `institucion`
  ADD PRIMARY KEY (`idinstitucion`);

ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idalumno`);

ALTER TABLE `guardia`
  ADD PRIMARY KEY (`idguardia`),
  ADD KEY `fk_guardia_usuario_idx` (`idusuario`);

ALTER TABLE `tutor`
  ADD PRIMARY KEY (`idtutor`),
  ADD KEY `fk_tutor_alumno_idx` (`idalumno`);

ALTER TABLE `grupoescolar`
  ADD PRIMARY KEY (`idgrupoescolar`),
  ADD KEY `fk_grupoescolar_alumno_idx` (`idalumno`);

ALTER TABLE `edad`
  ADD PRIMARY KEY (`idedad`),
  ADD KEY `fk_edad_alumno_idx` (`idalumno`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_idusuario_calendar_idx` (`idcalendar`);

ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_idpermiso` (`idpermiso`),
  ADD KEY `fk_usuario_usuario_idusuario` (`idusuario`);

-- AUTO_INCREMENT de las tablas volcadas

ALTER TABLE `assistance`
  MODIFY `idassistance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

ALTER TABLE `calendar`
  MODIFY `idcalendar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `holidays`
  MODIFY `idholidays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `institucion`
  MODIFY `idinstitucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `alumno`
  MODIFY `idalumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `guardia`
  MODIFY `idguardia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tutor`
  MODIFY `idtutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `grupoescolar`
  MODIFY `idgrupoescolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
  
ALTER TABLE `edad`
  MODIFY `idedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Restricciones para tablas volcadas RESTRICCIONES PARA TABLAS VOLCADAS

-- Agregar llaves foranes de las clases: alumno y guardia para la tabla asistencia
ALTER TABLE `assistance`
	ADD CONSTRAINT `fk_assistance_alumno` FOREIGN KEY (`idalumno`) REFERENCES `alumno` (`idalumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	ADD CONSTRAINT `fk_assistance_guardia` FOREIGN KEY (`idguardia`) REFERENCES `guardia` (`idguardia`) ON DELETE NO ACTION ON UPDATE NO ACTION;
    
-- Llave foranea de la clase usuario para la tabla guardia
ALTER TABLE `guardia`
	ADD CONSTRAINT `fk_guardia_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Llave foranea de la clase alumno para la tabla tutor
ALTER TABLE `tutor`
	ADD CONSTRAINT `fk_tutor_alumno` FOREIGN KEY (`idalumno`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE ON UPDATE CASCADE;
        
    -- Llave foranea de la clase alumno para la tabla edad
ALTER TABLE `edad`
	ADD CONSTRAINT `fk_edad_alumno` FOREIGN KEY (`idalumno`) REFERENCES `alumno` (`idalumno`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Llave foranea de la clase alumno para la tabla grupoescolar
ALTER TABLE `grupoescolar`
	ADD CONSTRAINT `fk_grupoescolar_alumno` FOREIGN KEY (`idalumno`) REFERENCES `alumno` (`idalumno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Agregar llave foránea de la clase usuario para la tabla calendario
ALTER TABLE `calendar`
ADD CONSTRAINT `fk_calendar_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_idpermiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_usuario_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;