# Para que o sistema de busca funcione corretamente todos bancos devem possuir a estrutura utilizada para as consultas. Sendo assim é necessario adaptar os bancos mais antigos para a nova estrutura. 

# SGAF 1.0 

CREATE TABLE `produtos_recipientes` (
  `prorec_codigo` tinyint(4) NOT NULL AUTO_INCREMENT,
  `prorec_nome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `prorec_sigla` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`prorec_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `coopaf`.`produtos` 
ADD COLUMN   `pro_volume` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
ADD COLUMN   `pro_recipiente` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
ADD COLUMN   `pro_marca` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
ADD COLUMN   `pro_composicao` text COLLATE utf8_unicode_ci,
ADD COLUMN   `pro_codigounico` bigint(13) DEFAULT NULL,
ADD COLUMN   `pro_idunico` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
ADD COLUMN   `pro_industrializado` int(11) NOT NULL,
ADD COLUMN   `pro_usuarioquecadastrou` int(11) NOT NULL,
ADD COLUMN   `pro_quiosquequecadastrou` int(11) NOT NULL

# SGAF 2.0

# ... nada até o momento

# SGAF 3.0

# ... nada até o momento