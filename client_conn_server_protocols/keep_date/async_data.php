<?php


setInterval(function(){
    $wallet_data = array();
    if(isset($_SESSION['wallet'])){
        $wallet_data = $_SESSION['wallet'];
    }
    echo "<script>";
    echo "element = document.getElementById(\"data_content_none\");\n";
    echo "if(typeof(element) == 'undefined' || element == null){element.remove();}\n";
    echo "</script>";
    echo "<div id='data_content_none'>";
    echo "<h4 style=\"display: none\">" . json_encode($wallet_data) . "</h4>";
    echo "</div>";
}, 1000);




function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f();
        sleep($seconds);
    }
}

?>
