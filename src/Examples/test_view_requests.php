<?php
/*if ($_POST == null)
    echo 'Richiesta non con post';
else
    print_r ($_POST);

if ($_GET == null)
    echo 'Richiesta non con get';
else
    var_dump($_GET); // non leggibile*/



if ($_SERVER["REQUEST_METHOD"] == 'GET')
{
    echo 'Richiesta con get';
    //
    //
    foreach ($_GET as $key=>$value)
    {
        echo "$key=$value<br>"
        echo "<br";
    }
}
else
{
    echo 'Richiesta con post';
    foreach ($_POST as $key=>$value)
    {
        echo "$key=$value<br>"
        echo "<br";
    }
}
?>