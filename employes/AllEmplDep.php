<?php
/**
 * Created by PhpStorm.
 * User: stowdgl
 * Date: 23.02.19
 * Time: 17:31
 */
$quan = 20;
if (isset($_POST['quan'])){
    switch ($_POST['quan']){
        case 'twenty':
            echo "<script>f('twenty')</script>";
            $quan = 20;
            break;
        case 'fourty':
            $quan = 40;
            break;
        case 'fifty':
            $quan = 50;
            break;
        case 'hundred':
            $quan = 100;
            break;

    }}

$d = ucfirst($d[0]);

settype($d,'string');
$stmt = DB::run("SELECT * FROM ".DB_TABLE." WHERE department='".$d. "' LIMIT " .$quan);
echo "<h3>Department navigation:</h3>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/dev'>Development</a></div>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/marketing'>Marketing</a></div>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/design'>Design</a></div>";

echo "<table>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['fullname']."</td>";
    echo "<td>".$row['birthday_date']."</td>";
    echo "<td>".$row['department']."</td>";
    echo "<td>".$row['salary_type']."</td>";
    echo "<td>".$row['salary']."</td>";

    echo "</tr>";
}
echo "</table>";
?>
<div></div>
