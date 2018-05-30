<?php

//connection variables
$host = "10.10.2.189";
$database = "neomaa";
$user = "yusuf";
$pass = "pancen yusuf";

//connection to the database
mysql_connect($host, $user, $pass)
or die ('cannot connect to the database: ' . mysql_error());

//select the database
mysql_select_db($database)
or die ('cannot select database: ' . mysql_error());

//loop to show all the tables and fields
$loop = mysql_query("SHOW tables FROM $database")
or die ('cannot select tables');

while($table = mysql_fetch_array($loop))
{

    echo "
        <table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"75%\">
            <tr bgcolor=\"#666666\">
                <td colspan=\"5\" align=\"center\"><b><font color=\"#FFFFFF\">" . $table[0] . "</font></td>
            </tr>
            <tr>
                <td>Field</td>
                <td>Type</td>
                <td>Key</td>
                <td>Default</td>
                <td>Extra</td>
            </tr>";
    echo "</table><br/><br/>";
    $i = 0; //row counter
    $row = mysql_query("SELECT * FROM " . $table[0]." LIMIT 0, 1")
    or die ('cannot select table fields');

    while ($col = mysql_fetch_array($row))
    {
        echo '<pre>';
        print_r($col);
        echo '</pre>';
        $i++;
    } //end row loop
} //end table loop
?>