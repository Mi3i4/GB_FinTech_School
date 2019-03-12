<?php
echo "DROP TABLE IF EXISTS `fsfr`.`answer` ;

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

\n\n";

$file = file_get_contents("BD/Ответы-Tаблица 1.csv");

$lines = preg_split("/;\r\n|;\n|\r/", $file );

echo "INSERT INTO `answer` (`id`, `question_id`,`content`, `is_correct`) VALUES\n";
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

    $rez = 0;
    if(isset($val[3]) and $val[3] == 1){
        $rez = 1;
    }

    echo "($val[0],$val[1],'".trim($val[2])."',$rez)";

}
echo "\n\n";





