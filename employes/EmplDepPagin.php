<?php
/**
 * Created by PhpStorm.
 * User: stowdgl
 * Date: 23.02.19
 * Time: 17:38
 */
//echo "<link rel=\"stylesheet\" href=\"../css/style.css\">";
echo "<h3>Department navigation:</h3>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/dev/1'>Development</a></div>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/marketing/1'>Marketing</a></div>";
echo "<div style='display:inline; margin: 5px;'><a href='/employes/design/1'>Design</a></div>";
$d[0] = ucfirst($d[0]);
$d[0] = htmlspecialchars($d[0]);
$stmt = DB::run("SELECT * FROM " . DB_TABLE . " WHERE department= '" . $d[0] . "' AND id>=(($d[1]*20)-20) AND id<=($d[1]*20)");
echo "<table>";
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

$n++;
       echo "<tr>";
       echo "<td>$n</td>";
       echo "<td>".$row['id']."</td>";
       echo "<td>".$row['fullname']."</td>";
       echo "<td>".$row['birthday_date']."</td>";
       echo "<td>".$row['department']."</td>";
       echo "<td>".$row['salary_type']."</td>";
       echo "<td>".$row['salary']."</td>";

       echo "</tr>";
}
echo "</table>";