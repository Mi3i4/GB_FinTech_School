<?php
echo "DROP TABLE IF EXISTS `fsfr`.`chapter` ;

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

\n\n";

$file = file_get_contents("BD/Главы-Tаблица 1.csv");

$lines = preg_split("/;\r\n|;\n|\r/", $file );

echo "INSERT INTO `chapter` (`id`, `name`) VALUES\n";
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
    echo "($val[0],'".trim($val[1])."')";

}
echo "\n\n";





