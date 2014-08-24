<?php
#¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
#   version......: 0.3.2
#   last.change..: 2014-08-24
#   created.by...: Jan Jastrow
#   contact......: jan@schwerkraftlabor.de
#   license......: MIT license
#   source.......: https://github.com/Gehirnfussel/Find-Soup-Duplicates
#_________________

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '
<!DOCTYPE HTML>
<html>
<head>
<style>
html {
    font-family: sans-serif;
    font-size: 12pt;
    height: 100%;
}
.log {
    border: 1px solid black;
    font-size: 10pt;
    padding: 1.3em;
    overflow: auto;
    display: inline-block;
    height: 30%;
}
.log ul {
    margin: 0;
    padding-left: 1em;
}
.log ul li {
    line-height: 1.9;
    margin: 0;
    padding: 0;
}
</style>
</head>
<body>';


$path = "Images/";
$arr_files = scandir($path);

if (count($arr_files) <= 2) {
    echo "<p>No images in Folder “".$path."”. Please provide at least a couple of files.</p>";
    echo "</body></html>";
    die();
}

set_time_limit(600); // seconds

if (!file_exists($path."/deleteme")){
    if (mkdir($path."/deleteme") == TRUE) {
        mkdir($path."/deleteme");
    }
}

echo "Files: ".count($arr_files);
echo '<p>Log:</p>';
echo '<div class="log"><ul>';
$i_moved = 0;
$i = 2;
while ($i < count($arr_files)) {
    $filename_shrt = substr($arr_files[$i], 0, 9);
    $i2 = 0;
    $founds = array();
        while ($i2 < count($arr_files)) {
            $searchMe = "z".strpos($arr_files[$i2], $filename_shrt);
            if ($searchMe == "z0") {
                $founds[] = $arr_files[$i2];
            }
        $i2++;
        }
    $i3 = 0;
    while (count($founds) == 2 && $i3 <= count($arr_files)) {
        if (is_file($path.$founds[0]) && is_file($path.$founds[1])) {
            # Look for image size
            $filesize0 = getimagesize($path.$founds[0])[0];
            $filesize1 = getimagesize($path.$founds[1])[0];
            if ($filesize0 > $filesize1) {
                echo "<li>Moving $founds[1]</li>";
                rename($path.$founds[1], $path."deleteme/".$founds[1]);
            } else {
                echo "<li>Moving $founds[0]</li>";
                rename($path.$founds[0], $path."deleteme/".$founds[0]);
            }
            $i_moved++;
            break;
        }
        $i3++;
        unset($founds);
        $founds = array();
    }
    while (count($founds) == 3 && $i3 <= count($arr_files)) {
        if (is_file($path.$founds[0]) && is_file($path.$founds[1]) && is_file($path.$founds[2])) {
            # Look for image size
            $filesize = array();
            $filesize[0] = getimagesize($path.$founds[0])[0];
            $filesize[1] = getimagesize($path.$founds[1])[0];
            $filesize[2] = getimagesize($path.$founds[2])[0];
            /*
            echo $filesize[0].'<br />';
            echo $filesize[1].'<br />';
            echo $filesize[2].'<br />';
            echo 'Max:'.max($filesize).'<br />';
            */
            $biggest_file = array_search(max($filesize), $filesize);
            if ($biggest_file == 0) {
                echo "<li>Moving $founds[1]</li>"; rename($path.$founds[1], $path."deleteme/".$founds[1]);
                echo "<li>Moving $founds[2]</li>"; rename($path.$founds[2], $path."deleteme/".$founds[2]);
            } elseif ($biggest_file == 1) {
                echo "<li>Moving $founds[0]</li>"; rename($path.$founds[0], $path."deleteme/".$founds[0]);
                echo "<li>Moving $founds[2]</li>"; rename($path.$founds[2], $path."deleteme/".$founds[2]);
            } elseif ($biggest_file == 2) {
                echo "<li>Moving $founds[0]</li>"; rename($path.$founds[0], $path."deleteme/".$founds[0]);
                echo "<li>Moving $founds[1]</li>"; rename($path.$founds[1], $path."deleteme/".$founds[1]);
            }
            $i_moved++;
            break;
        }
        $i3++;
        unset($founds);
        $founds = array();
    }
    $i3 = 0;

    $i++;
}
echo '</ul></div>';
echo "<p>Moved Files: ".$i_moved."</p>";
echo "</body></html>";
?>
