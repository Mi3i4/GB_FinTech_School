<?php
echo "DROP TABLE IF EXISTS `fsfr`.`topic` ;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;;
\n\n";

$file = file_get_contents("BD/Темы-Tаблица 1.csv");

$lines = preg_split("/;\r\n|;\n|\r/", $file );

echo "INSERT INTO `topic` (`id`, `chapter_id`, `name`) VALUES\n";
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
    echo "($val[0],$val[1],'".trim($val[2])."')";

}
echo "\n\n";





