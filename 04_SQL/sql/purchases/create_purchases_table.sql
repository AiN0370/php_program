CREATE TABLE `purchases` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `item1` varchar(255),
    `item2` varchar(255),
    `item3` varchar(255),
    `total` int(255),
    `customer_id` int(11) NOT NULL,
    `create_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `update_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `create_timestamp` (`create_timestamp`),
    KEY `update_timestamp` (`update_timestamp`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='購入管理テーブル';
