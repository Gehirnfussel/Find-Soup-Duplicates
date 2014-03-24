<?php
#¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
#   version......: 0.1
#   last.change..: 2014-03-24
#   created.by...: Jan Jastrow
#   contact......: jan@schwerkraftlabor.de
#   license......: MIT license
#   source.......: https://github.com/Gehirnfussel/Find-Soup-Duplicates
#_________________

error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = "Images/";

#echo "Path: ".$path."</br />";

$arr_files = scandir($path);

#var_dump($arr_files);

$i = 2;

while ($i < count($arr_files)) {
    $sub = substr($arr_files[$i], 0, 9);
    $i2 = 0;
        while ($i2 < count($arr_files)) {
            $sub2 = "z".strpos($arr_files[$i2], $sub);
            $i3 = 0;
            if ($sub2 == "z0" && $i2 != $i) {
                echo "Lauf Nr.".$i." <br />";
                echo $arr_files[$i2]."<br />";
                echo "<br />";
                $i3++;
            }

            $i2++;
        }
    $i++;
}

?>
