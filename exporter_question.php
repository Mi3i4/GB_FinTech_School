<?php
echo "DROP TABLE IF EXISTS `fsfr`.`question` ;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `content` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
\n\n";

$file = file_get_contents("BD/Вопросы-Tаблица 1.csv");

$lines = preg_split("/;\r\n|;\n|\r/", $file );

echo "INSERT INTO `question` (`id`, `chapter_id`,`topic_id`, `content`) VALUES\n";
for($i=0;$i < count($lines);$i ++){
    $val  =  mbsplit(';',$lines[$i]);
    if($i!=0) {
        if (empty($val[0])) {
            echo ';';
            break;
        } else {
            echo ",\n";
        }
    }
    echo "($val[0],$val[1],$val[2],'".trim($val[3])."')";

}
echo "\n\n";





