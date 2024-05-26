<?php
function getRevoxValue(){
    $file = '../real_time/revox_value';
    $file_content = file_get_contents($file);
    return $file_content;
}
?>