/*================================================================================*/
/* DDL SCRIPT                                                                     */
/*================================================================================*/
/*  Title    : PhpPlaisio:Babel Core                                              */
/*  FileName : babel-core.ecm                                                     */
/*  Platform : MySQL 5                                                            */
/*  Version  : Concept                                                            */
/*  Date     : woensdag 17 maart 2021                                             */
/*================================================================================*/
/*================================================================================*/
/* CREATE TABLES                                                                  */
/*================================================================================*/

CREATE TABLE `ABC_BABEL_WORD_GROUP` (
  `wdg_id` TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `wdg_name` VARCHAR(32) NOT NULL,
  `wdg_label` VARCHAR(30) CHARACTER SET ascii COLLATE ascii_general_ci,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`wdg_id`)
);

CREATE TABLE `ABC_BABEL_WORD` (
  `wrd_id` SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `wdg_id` TINYINT UNSIGNED NOT NULL,
  `wrd_timestamp` TIMESTAMP DEFAULT now() NOT NULL,
  `wrd_comment` VARCHAR(255),
  `wrd_label` VARCHAR(50) CHARACTER SET ascii COLLATE ascii_general_ci,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`wrd_id`)
);

/*
COMMENT ON COLUMN `ABC_BABEL_WORD`.`wrd_timestamp`
The timestamp of the last modification.
*/

CREATE TABLE `ABC_BABEL_LANGUAGE` (
  `lan_id` TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `wrd_id` SMALLINT UNSIGNED NOT NULL,
  `lan_code` VARCHAR(8) NOT NULL,
  `lan_lang` VARCHAR(12) NOT NULL,
  `lan_locale` VARCHAR(12) NOT NULL,
  `lan_dir` ENUM('ltr','rtl') NOT NULL,
  `lan_date_format_full` VARCHAR(20) NOT NULL,
  `lan_date_format_long` VARCHAR(20) NOT NULL,
  `lan_date_format_medium` VARCHAR(20) NOT NULL,
  `lan_date_format_short` VARCHAR(20) NOT NULL,
  `lan_label` VARCHAR(40) CHARACTER SET ascii COLLATE ascii_general_ci,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`lan_id`)
);

/*
COMMENT ON COLUMN `ABC_BABEL_LANGUAGE`.`wrd_id`
The ID of the word of the name of the language.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_LANGUAGE`.`lan_code`
The language code for the ABC-Framework.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_LANGUAGE`.`lan_lang`
The language suitable for the lang tag in HTML (see https://www.w3schools.com/tags/ref_language_codes.asp).
*/

/*
COMMENT ON COLUMN `ABC_BABEL_LANGUAGE`.`lan_locale`
The locale suitable for PHP setlocale function (see http://php.net/manual/en/function.setlocale.php).
*/

/*
COMMENT ON COLUMN `ABC_BABEL_LANGUAGE`.`lan_dir`
The direction of the language (see https://www.w3schools.com/tags/att_global_dir.asp).
*/

CREATE TABLE `ABC_BABEL_TEXT_GROUP` (
  `ttg_id` TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `ttg_name` VARCHAR(64) NOT NULL,
  `ttg_label` VARCHAR(30) CHARACTER SET ascii COLLATE ascii_general_ci,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`ttg_id`)
);

CREATE TABLE `ABC_BABEL_TEXT` (
  `txt_id` SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `ttg_id` TINYINT UNSIGNED NOT NULL,
  `txt_timestamp` TIMESTAMP DEFAULT now() NOT NULL,
  `txt_comment` TINYTEXT,
  `txt_label` VARCHAR(50) CHARACTER SET ascii COLLATE ascii_general_ci,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`txt_id`)
);

/*
COMMENT ON COLUMN `ABC_BABEL_TEXT`.`txt_timestamp`
The timestamp of last modification.
*/

CREATE TABLE `ABC_BABEL_TEXT_TEXT` (
  `txt_id` SMALLINT UNSIGNED NOT NULL,
  `lan_id` TINYINT UNSIGNED NOT NULL,
  `ttt_text` MEDIUMTEXT NOT NULL,
  `ttt_timestamp` TIMESTAMP DEFAULT now() NOT NULL,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`txt_id`, `lan_id`)
);

/*
COMMENT ON COLUMN `ABC_BABEL_TEXT_TEXT`.`lan_id`
The ID of the target language.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_TEXT_TEXT`.`ttt_text`
The text in the target language.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_TEXT_TEXT`.`ttt_timestamp`
The timestamp of last modification.
*/

CREATE TABLE `ABC_BABEL_WORD_TEXT` (
  `wrd_id` SMALLINT UNSIGNED NOT NULL,
  `lan_id` TINYINT UNSIGNED NOT NULL,
  `wdt_text` VARCHAR(80) NOT NULL,
  `wdt_timestamp` TIMESTAMP DEFAULT now() NOT NULL,
  CONSTRAINT `PRIMARY_KEY` PRIMARY KEY (`wrd_id`, `lan_id`)
);

/*
COMMENT ON COLUMN `ABC_BABEL_WORD_TEXT`.`lan_id`
The ID of the target language.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_WORD_TEXT`.`wdt_text`
The word in the target language.
*/

/*
COMMENT ON COLUMN `ABC_BABEL_WORD_TEXT`.`wdt_timestamp`
The timestamp of last modification.
*/

/*================================================================================*/
/* CREATE INDEXES                                                                 */
/*================================================================================*/

CREATE INDEX `wdg_id` ON `ABC_BABEL_WORD` (`wdg_id`);

CREATE INDEX `wrd_id` ON `ABC_BABEL_LANGUAGE` (`wrd_id`);

CREATE INDEX `ttg_id` ON `ABC_BABEL_TEXT` (`ttg_id`);

CREATE INDEX `IX_FK_ABC_BABEL_TEXT_TEXT` ON `ABC_BABEL_TEXT_TEXT` (`lan_id`);

CREATE INDEX `lan_id` ON `ABC_BABEL_WORD_TEXT` (`lan_id`);

/*================================================================================*/
/* CREATE FOREIGN KEYS                                                            */
/*================================================================================*/

ALTER TABLE `ABC_BABEL_WORD`
  ADD CONSTRAINT `FK_ABC_BABEL_WORD_ABC_BABEL_WORD_GROUP`
  FOREIGN KEY (`wdg_id`) REFERENCES `ABC_BABEL_WORD_GROUP` (`wdg_id`)
  ON UPDATE NO ACTION
  ON DELETE NO ACTION;

ALTER TABLE `ABC_BABEL_LANGUAGE`
  ADD CONSTRAINT `FK_ABC_BABEL_LANGUAGE_ABC_BABEL_WORD`
  FOREIGN KEY (`wrd_id`) REFERENCES `ABC_BABEL_WORD` (`wrd_id`);

ALTER TABLE `ABC_BABEL_TEXT`
  ADD CONSTRAINT `FK_ABC_BABEL_TEXT_ABC_BABEL_TEXT_GROUP`
  FOREIGN KEY (`ttg_id`) REFERENCES `ABC_BABEL_TEXT_GROUP` (`ttg_id`)
  ON UPDATE NO ACTION
  ON DELETE NO ACTION;

ALTER TABLE `ABC_BABEL_TEXT_TEXT`
  ADD CONSTRAINT `FK_ABC_BABEL_TEXT_TEXT_ABC_BABEL_LANGUAGE`
  FOREIGN KEY (`lan_id`) REFERENCES `ABC_BABEL_LANGUAGE` (`lan_id`);

ALTER TABLE `ABC_BABEL_TEXT_TEXT`
  ADD CONSTRAINT `FK_ABC_BABEL_TEXT_TEXT_ABC_BABEL_TEXT`
  FOREIGN KEY (`txt_id`) REFERENCES `ABC_BABEL_TEXT` (`txt_id`)
  ON UPDATE NO ACTION
  ON DELETE NO ACTION;

ALTER TABLE `ABC_BABEL_WORD_TEXT`
  ADD CONSTRAINT `FK_ABC_BABEL_WORD_TEXT_ABC_BABEL_LANGUAGE`
  FOREIGN KEY (`lan_id`) REFERENCES `ABC_BABEL_LANGUAGE` (`lan_id`)
  ON UPDATE NO ACTION
  ON DELETE NO ACTION;

ALTER TABLE `ABC_BABEL_WORD_TEXT`
  ADD CONSTRAINT `FK_ABC_BABEL_WORD_TEXT_ABC_BABEL_WORD`
  FOREIGN KEY (`wrd_id`) REFERENCES `ABC_BABEL_WORD` (`wrd_id`)
  ON UPDATE NO ACTION
  ON DELETE NO ACTION;
