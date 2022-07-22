CREATE TABLE `country` (`id` INT NOT NULL AUTO_INCREMENT , `continent_code` VARCHAR(4) NOT NULL , `currency_code` VARCHAR(5) NOT NULL , `iso2_code` VARCHAR(10) NOT NULL , `iso3_code` VARCHAR(10) NOT NULL , `iso_numeric_code` INT NOT NULL , `fips_code` VARCHAR(10) NULL , `calling_code` INT NOT NULL , `common_name` VARCHAR(50) NOT NULL , `official_name` VARCHAR(50) NOT NULL , `endonym` VARCHAR(50) NULL , `demonym` VARCHAR(50) NULL , PRIMARY KEY (`id`));

CREATE TABLE `uploads` (`id` INT NOT NULL AUTO_INCREMENT , `upload_type` VARCHAR(10) NOT NULL , `url` TEXT NOT NULL , `user_id` VARCHAR(20) NOT NULL , `created_date` TIMESTAMP NOT NULL , PRIMARY KEY (`id`));

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `iso_numeric_code` int(11) NOT NULL,
  `common_name` varchar(32) NOT NULL,
  `official_name` varchar(32) NOT NULL,
  `symbol` varchar(50) NOT NULL
);

ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);