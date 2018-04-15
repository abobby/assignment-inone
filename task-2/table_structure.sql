CREATE DATABASE IF NOT EXISTS `problem_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `problem_2`;
CREATE TABLE `products` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;
INSERT INTO `problem_2`.`products` (`name`, `is_active`, `created_at`, `updated_at`) VALUES ('Earphones', 1, NOW(), NOW());
INSERT INTO `problem_2`.`products` (`name`, `is_active`, `created_at`, `updated_at`) VALUES ('Memory Card', 1, NOW(), NOW());
INSERT INTO `problem_2`.`products` (`name`, `is_active`, `created_at`, `updated_at`) VALUES ('Hammer', 1, NOW(), NOW());

CREATE TABLE `product_price` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `product_id` bigint(20) NOT NULL,
    `min_quantity` smallint(6) NOT NULL,
    `max_quantity` smallint(6) NOT NULL,
    `unit_price` int(10) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_id_quantity` (`product_id`,`min_quantity`,`max_quantity`),
    KEY `unit_price` (`unit_price`),
    CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (1, 1, 10, 500, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (1, 11, 50, 500, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (1, 51, 200, 475, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (1, 201, 1000, 450, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (2, 1, 50, 1000, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (2, 51, 200, 950, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (2, 201, 1000, 900, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (3, 1, 5, 250, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (3, 6, 50, 240, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (3, 51, 200, 230, NOW(), NOW());
INSERT INTO `problem_2`.`product_price` (`product_id`, `min_quantity`, `max_quantity`, `unit_price`, `created_at`, `updated_at`) VALUES (3, 201, 1000, 220, NOW(), NOW());
