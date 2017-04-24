/* --------------------------------------------------
 * DATABASE `_api`
 * --------------------------------------------------
 * Drop any database with the same name and
 * create a new one and select it.
 */
DROP DATABASE IF EXISTS `gestorjr`;
CREATE DATABASE `gestorjr` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestorjr`;


/* --------------------------------------------------------
*  TABLE 'Associates'
*  Associates will be added here
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `associates`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`name_id` VARCHAR(255) UNIQUE NOT NULL,
	`status` ENUM('Desligado','Inativo', 'Associado','Pós-associado'),
	`profile_picture` VARCHAR(255),
	/* Login info */
	`username` VARCHAR(25) UNIQUE NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	/* Basic Info */
	`name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`full_name` VARCHAR(255) NOT NULL,
	`cpf` VARCHAR(15) NOT NULL,
	`rg` VARCHAR(15) NOT NULL,
	/* Communication info */
	`ddd_1` VARCHAR(2) NOT NULL,
	`tel_primary` VARCHAR(11) NOT NULL,
	`ddd_2` VARCHAR(2),
	`tel_optional` VARCHAR(11),
	`email` VARCHAR(255) UNIQUE NOT NULL,
	/* Company Related */
	`engineering` ENUM('Automação', 'Civil', 'Computação', 'Telecom', 'Elétrica','Mecânica') NOT NULL,
	`position` ENUM('Analista', 'Gerente', 'Diretor','Vice-presidente', 'Presidente') NOT NULL,
	`sector` ENUM ('Adm/Fin','Comercial','GP','Projetos', 'Qualidade', 'Geral') NOT NULL,
	/* Address Info  */
  `cep` VARCHAR(50) NOT NULL,
	`street` VARCHAR(50) NOT NULL,
	`number` VARCHAR(10) NOT NULL,
	`neighborhood` VARCHAR(50) NOT NULL,
	`city` VARCHAR(50) NOT NULL,
	`state` VARCHAR(50) NOT NULL,
	/* Company data for statistics purposes */
	`entry_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`leaving_date` TIMESTAMP
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT= 10;


/* --------------------------------------------------------
*  TABLE 'clients'
*  Clients will be added here
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `clients`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	/* Contact info */
	`name` VARCHAR(50) NOT NULL,
	`ddd_1` VARCHAR(2) NOT NULL,
	`tel_primary` VARCHAR(11) NOT NULL,
	`ddd_2` VARCHAR(2),
	`tel_optional` VARCHAR(11),
	`email` VARCHAR(255) NOT NULL,
	CONSTRAINT `fk_clients_associate_id`
			FOREIGN KEY (`associate_id`)
			REFERENCES `associates`(`id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;



/* --------------------------------------------------------
*  TABLE 'projects'
*  Projects will be added here
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `projects`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	`client_id` INT(11) NOT NULL,
	/*  Links Info Board on Trello and Files on Drive	*/
	`trello` VARCHAR(255),
	`drive` VARCHAR(255),
	`status` ENUM ('Preparação', 'Desenvolvimento', 'Em espera' , 'Cancelado', 'Entregue'),
	/* Basic Info */
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(700) NOT NULL,
	/* Permission Access */
	`permission_level` ENUM('1','2','3') NOT NULL,
	/* Pricing and Which Engineering this project belongs the most */
	`price` FLOAT(10) DEFAULT 0.0,
	`engineering` ENUM('Automação', 'Civil', 'Computação', 'Telecom', 'Elétrica','Mecânica') NOT NULL,
	/* Reference to the owner of the project */
	CONSTRAINT `fk_projects_clients_id`
		FOREIGN KEY (`client_id`)
		REFERENCES `clients`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT `fk_projects_associate_id`
			FOREIGN KEY (`associate_id`)
			REFERENCES `associates`(`id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;



/* --------------------------------------------------------
*  TABLE 'Services'
*  Services required by Associates will be added here
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `services`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	`handler_id` INT(11) NOT NULL,
	/* Service Info */
	`description` VARCHAR(255) NOT NULL,
	`motive` VARCHAR(255) NOT NULL,
	/* Set of Options */
	`type` ENUM('TI', 'Infraestrutura', 'Reembolso', 'Visita', 'Novo Cliente', 'Novo Projeto') NOT NULL,
	/* Adm/fin or GP will handle this status */
	`status` ENUM('Aceito', 'Recusado', 'Enviado', 'Em análise', 'Resolvido'),
	/* Reference to associate and the handler */
	CONSTRAINT `fk_services_associate_id`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT `fk_services_handler_id`
			FOREIGN KEY (`handler_id`)
			REFERENCES `associates`(`id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;

/* --------------------------------------------------------
*  TABLE 'Inventory'
*  Here will be added materials that PJ owns and can
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `inventory`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(255) UNIQUE NOT NULL,
	`qtd` INT(11) NOT NULL DEFAULT 1,
	`type` ENUM('Limpeza', 'Infraestrutura', 'Ferramentas', 'Componentes')
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;

/* --------------------------------------------------------
*		TABLE 'Complaints'
*  Here will be added the complaints made by all associates from PJ
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `complaints`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	`complainer_id` INT(11) NOT NULL,
	/* Infos */
	`description` VARCHAR(255) NOT NULL,
	/* Type and Status of Complaint*/
	`type` ENUM('Organização', 'Vestuário', 'Falta', 'Educação', 'Incompetência') NOT NULL,
	`status` ENUM('Enviado', 'Em análise', 'Resolvido') NOT NULL,
	/* Complainer */
	CONSTRAINT `fk_complaints_complainer_id`
		FOREIGN KEY (`complainer_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	/* Accused */
	CONSTRAINT `fk_complaints_associate_id`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;

/* --------------------------------------------------------
*		TABLE 'Calendar'
*  Here will be added the new meetings made by associates
*  --------------------------------------------------------
*/

CREATE TABLE IF NOT EXISTS `calendar`(
	`id` INT(11) PRIMARY KEY AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	`client_id` INT(11),
	/* Meeting Infos */
	`scheduled_date` TIMESTAMP UNIQUE,
	`description` VARCHAR(255) NOT NULL,
	`location` ENUM('PJ', 'Visit') NOT NULL,
	/* Reference to the one who scheduled the meeting */
	CONSTRAINT `fk_calendar_associate_id`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	/* Reference to the client */
	CONSTRAINT `fk_calendar_client_id`
			FOREIGN KEY (`client_id`)
			REFERENCES `clients`(`id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;


/* ======================================
 * Financeiro
 * ======================================
*/

CREATE TABLE IF NOT EXISTS `finances`(
	`id` INT(11) PRIMARY KEY UNIQUE AUTO_INCREMENT,
	`associate_id` INT(11) NOT NULL,
	`project_id` INT(11) NOT NULL,
	 /* Info about finance actions*/
	`name` VARCHAR(50) NOT NULL,
	`description` VARCHAR(700) NOT NULL,
	`qtd` INT(11) NOT NULL,
	`type` ENUM('Visita','Reembolso', 'Infraestrutura', 'Eventos', 'TI') NOT NULL,
	`price` FLOAT(10) NOT NULL DEFAULT 0.0
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;

/* ======================================
 *  News feed
 * ======================================
*/

CREATE TABLE IF NOT EXISTS `news`(
	`id` INT(11) PRIMARY KEY UNIQUE AUTO_INCREMENT,
	`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`pinned` ENUM('sim','nao') NOT NULL,
	`subject` VARCHAR(255) NOT NULL,
	`content` VARCHAR(700) NOT NULL,
	`relevance` ENUM('1','2','3') NOT NULL
)ENGINE INNODB DEFAULT CHAR SET 'utf8' AUTO_INCREMENT=10;

/* ======================================
 * Messages Feed
 * ======================================
*/

CREATE TABLE IF NOT EXISTS `messages`(
	`id` INT(11) UNIQUE PRIMARY KEY AUTO_INCREMENT,
	`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`text` VARCHAR(300) NOT NULL,
	`status` ENUM('Not seen', 'Seen') DEFAULT 'Not seen',
	`target_id` INT(11) NOT NULL,
	`writer_id` INT(11) NOT NULL,
	CONSTRAINT `fk_messages_target_id`
		FOREIGN KEY (`target_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT `fk_messages_writer_id`
		FOREIGN KEY (`writer_id`)
		REFERENCES `associates`(`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

/* ================================
 * Inserções para testes
 * ===============================
*/

INSERT INTO `associates`(`id`, `status`, `profile_picture`,`name_id`, `username`, `password`,`name`) VALUES (10,'Associado','avatar','admin-admin','admin','123', 'AdminUser');
INSERT INTO `clients`(`id`, `associate_id`, `name`) VALUES (1,10,'Cliente 1');
INSERT INTO `projects`(`associate_id`, `client_id`, `status`, `name`) VALUES (10,1,'Desenvolvimento', 'Projeto 1');
INSERT INTO `projects`(`associate_id`, `client_id`, `status`, `name`) VALUES (10, 1, 'Entregue', 'Projeto 2');
