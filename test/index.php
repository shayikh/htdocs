<?php
$imageNewName = uniqid().'_'.date("Y-M-H-i-s").".jpg";

$oldPath = "./image/ok.jpg";
$newPath = "./image/".$imageNewName;

$copied = copy($oldPath , $newPath);

if ((!$copied)) 
{
    echo "Error : Not Copied";
}
else
{ 
    echo "Copied Successful";
}