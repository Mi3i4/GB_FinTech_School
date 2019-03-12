DROP TABLE IF EXISTS `fsfr`.`chapter` ;

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



INSERT INTO `chapter` (`id`, `name`) VALUES
(1,'Рынок ценных бумаг');


DROP TABLE IF EXISTS `fsfr`.`topic` ;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;;


INSERT INTO `topic` (`id`, `chapter_id`, `name`) VALUES
(1,1,' Функционирование финансового рынка');


DROP TABLE IF EXISTS `fsfr`.`question` ;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `content` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `question` (`id`, `chapter_id`,`topic_id`, `content`) VALUES
(1,1,1,'Финансовый рынок представляет собой:'),
(2,1,1,'Договор, в результате которого возникает финансовый актив у одной организации и финансовое обязательство или долевой инструмент – у другой, называется:'),
(3,1,1,'К функциям финансового рынка относятся следующие, кроме:'),
(4,1,1,'"Финансовый инструмент может существовать в форме:'),
(5,1,1,'"К финансовым активам относятся:');


DROP TABLE IF EXISTS `fsfr`.`answer` ;

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `answer` (`id`, `question_id`,`content`, `is_correct`) VALUES
(1,1,'1.Механизм перераспределения капитала между кредиторами и заемщиками при помощи посредников на основании спроса и предложения на капитал',0),
(2,1,'2.Совокупность кредитно-финансовых организаций страны, перераспределяющих потоки денежных средств между субъектами, имеющими временно свободные денежные средства и субъектами, испытывающими недостаток в финансовых ресурсах',0),
(3,1,'3.Институт, трансформирующий сбережения в инвестиции',0),
(4,1,'4.Все перечисленное',1),
(5,2,'1. Срочный контракт',0),
(6,2,'2. Акция',0),
(7,2,'3. Депозит',0),
(8,2,'4.Финансовый инструмент',1),
(9,3,'1. Аккумулирование временно свободных средств',0),
(10,3,'2. Формирование рыночных цен на отдельные финансовые инструменты',0),
(11,3,'3. Доведение товаров до потребителей',1),
(12,3,'4. Осуществление квалифицированного посредничества между продавцом и покупателем финансовых инструментов (брокеры, дилеры)',0),
(18,4,'2. Финансового обязательства(.,)',1),
(19,4,'3. Права на лицензионную компьютерную программу(.,)',0),
(20,4,'4. Права на объект недвижимости.',0),
(27,5,'2. Ценные бумаги',1),
(28,5,'3.Производные финансовые инструменты(.,)',1),
(29,5,'4. Права на объекты недвижимости(.,)',0),
(30,5,'5. Авторские права на компьютерные программы.',0);


