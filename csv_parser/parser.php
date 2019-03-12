<?php


$file = file_get_contents("csv/test.csv");

$topic = array();
$chapter= array();
$question = array();
$answer = array();

$lines = preg_split("/;\r\n|;\n|\r/", $file );
for($i=1;$i < count($lines);$i ++){
    //echo $lines[$i]."\n\n\n\n";

    $val  =  mbsplit(';',$lines[$i]);

    if(is_numeric($val[0]) ) {
        array_push($chapter, [intval($val[0]), $val[1]]);
    }

    if(is_numeric($val[2]) ) {
        array_push($topic, [intval($val[0]),intval($val[2]), $val[3]]);
    }

    if(is_numeric($val[4]) ) {
        $question_id= $val[4];
        array_push($question, [intval($val[4]),intval($val[0]),intval($val[2]), $val[5]]);
    }

    if(isset($val[6]) ) {
        array_push($answer, [intval($i),$question_id,($val[6]), $val[7]]);
    }

}

$chapter= array_unique($chapter);
$topic= array_unique($topic);


echo "DROP TABLE IF EXISTS `fsfr`.`chapter` ;

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

\n\n";



echo "INSERT INTO `chapter` (`id`, `name`) VALUES\n";
for($i=0;$i < count($chapter);$i ++){
    echo "(".$chapter[$i][0].",'".$chapter[$i][1]."')";

    if($i == count($chapter)-1){
        echo ";\n";
    }
    else{
        echo ",\n";
    }


}
echo "\n\n";



echo "DROP TABLE IF EXISTS `fsfr`.`topic` ;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;;
\n\n";



echo "INSERT INTO `topic` (`id`, `chapter_id`, `name`) VALUES\n";
for($i=0;$i < count($topic);$i ++){
    echo "(".$topic[$i][0].",".$topic[$i][1].",'".$topic[$i][2]."')";

    if($i == count($topic)-1){
        echo ";\n";
    }
    else{
        echo ",\n";
    }

}
echo "\n\n";


echo "DROP TABLE IF EXISTS `fsfr`.`question` ;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `content` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
\n\n";


echo "INSERT INTO `question` (`id`, `chapter_id`,`topic_id`, `content`) VALUES\n";
for($i=0;$i < count($question);$i ++){
    echo "(".$question[$i][0].",".$question[$i][1].",".$question[$i][2].",'".$question[$i][3]."')";

    if($i == count($question)-1){
        echo ";\n";
    }
    else{
        echo ",\n";
    }

}
echo "\n\n";



echo "DROP TABLE IF EXISTS `fsfr`.`answer` ;

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

\n\n";



echo "INSERT INTO `answer` (`id`, `question_id`,`content`, `is_correct`) VALUES\n";
for($i=0;$i < count($answer);$i ++){
    //print_r($answer);
    echo "(".$answer[$i][0].",".$answer[$i][1].",'".$answer[$i][2]."',".$answer[$i][3].")";

    if($i == count($answer)-1){
        echo ";\n";
    }
    else{
        echo ",\n";
    }

}
echo "\n\n";
