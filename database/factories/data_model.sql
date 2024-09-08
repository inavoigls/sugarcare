/*
 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80027
 Source Host           : localhost:3306
 Source Schema         : sugarcare

 Target Server Type    : MySQL
 Target Server Version : 80027
 File Encoding         : 65001
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alimentacion
-- ----------------------------
DROP TABLE IF EXISTS `alimentacion`;
CREATE TABLE `alimentacion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `foto` longblob NULL,
  `puntuacion` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `alimentacion_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `alimentacion_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for datos_usuario
-- ----------------------------
DROP TABLE IF EXISTS `datos_usuario`;
CREATE TABLE `datos_usuario`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `fechanacimiento` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `altura` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `complexion` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `genero` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` longblob NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `datos_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `datos_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for grupos_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `grupos_usuarios`;
CREATE TABLE `grupos_usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `grupo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for historial
-- ----------------------------
DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `historia` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `indicaciones` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `medicacion` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `historial_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `historial_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for notificaciones
-- ----------------------------
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `orden` int NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `titulo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `notificacion` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `leida` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notificacion_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `recomendacion_usuarios0` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pesos_estatura
-- ----------------------------
DROP TABLE IF EXISTS `pesos_estatura`;
CREATE TABLE `pesos_estatura`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `estatura` float NOT NULL,
  `pequeña` float NOT NULL,
  `media` float NOT NULL,
  `grande` float NOT NULL,
  `genero` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `estatura`(`estatura`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for recomendaciones
-- ----------------------------
DROP TABLE IF EXISTS `recomendaciones`;
CREATE TABLE `recomendaciones`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `orden` int NOT NULL,
  `titulo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `recomendacion` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `recomendacion_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `recomendacion_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for registro_actividad
-- ----------------------------
DROP TABLE IF EXISTS `registro_actividad`;
CREATE TABLE `registro_actividad`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tiempo` time NOT NULL,
  `actividad` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `puntuacion` int NOT NULL,
  `observaciones` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ruta` longblob NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `glucosa_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `actividad_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for registro_glucosa
-- ----------------------------
DROP TABLE IF EXISTS `registro_glucosa`;
CREATE TABLE `registro_glucosa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `glucosa` float NOT NULL,
  `hora` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `glucosa_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `glucosa_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for registro_peso
-- ----------------------------
DROP TABLE IF EXISTS `registro_peso`;
CREATE TABLE `registro_peso`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hora` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `peso` float NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `peso_usuarios_idx`(`usuario`) USING BTREE,
  CONSTRAINT `peso_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaalta` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `grupo` int NOT NULL,
  `activo` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email_UNIQUE`(`email`) USING BTREE,
  INDEX `grupo_usuario_idx`(`grupo`) USING BTREE,
  CONSTRAINT `grupo_usuario` FOREIGN KEY (`grupo`) REFERENCES `grupos_usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for usuarios_medicos
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_medicos`;
CREATE TABLE `usuarios_medicos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` int NOT NULL,
  `medico` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `usuarios_medicos_idx`(`usuario`) USING BTREE,
  CONSTRAINT `usaurios_medicos` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
