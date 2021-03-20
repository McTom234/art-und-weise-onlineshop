CREATE TABLE `users`
(
    `id`         INT                                   NOT NULL AUTO_INCREMENT,
    `username`   VARCHAR(255)                          NOT NULL,
    `password`   VARCHAR(255)                          NOT NULL,
    `created_at` TIMESTAMP                             NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`username`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

CREATE TABLE `products`
(
    `id`           INT NOT NULL AUTO_INCREMENT,
    `name`         VARCHAR(255),
    `categories`   VARCHAR(510),
    `availability` INT,
    `description`  VARCHAR(510),
    `orders`       INT,
    `orders_7days` INT,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);