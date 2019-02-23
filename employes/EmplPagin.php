<?php
/**
 * Created by PhpStorm.
 * User: stowdgl
 * Date: 23.02.19
 * Time: 17:30
 */
$n = intval($n[0]);
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
if (is_integer($n)) {
    $stmt = DB::run("SELECT * FROM " . DB_TABLE . " WHERE id>=(($n*20)-20) AND id<=($n*20)");
    echo "<table>";
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['birthday_date'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['salary_type'] . "</td>";
        echo "<td>" . $row['salary'] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
    $col = DB::run('SELECT count(id) from employes');
    $col = $col->fetchAll();
    $col = $col[0];
    $col = $col['count(id)'];

    for ($i=1;$i<ceil($col/20)+1;$i++){
        echo "<div style='display: inline;margin: 5px;'><a href='/employes/$i'>$i</a></div>";
    }
}