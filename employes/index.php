<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<form action="#" method="post">
    <select name="quan" id="quantitycols">
        <option value="twenty" name="twenty" id="twenty">20</option>
        <option value="fourty" name="fourty" id="fourty">40</option>
        <option value="fifty" name="fifty" id="fifty">50</option>
        <option value="hundred" name="hundred" id="hundred">100</option>
    </select>
    <input type="submit" name="submit">
</form>


<?php
require_once 'db.php';
abstract class Employee
{
    protected $fullname, $birthday_date, $department,$salary;
}

class RateEmployee extends Employee
{
    protected $salary_type = 'rate';

    public function __construct($fullname, $birthday_date, $department,$salary)
    {

        $this->fullname = $fullname;
        $this->birthday_date = $birthday_date;
        $this->department = $department;
        $this->salary = $salary;
        $this->insert();
    }
    public function insert(){
        $data = [$this->fullname,$this->birthday_date,$this->department,$this->salary_type,$this->salary];
        $sql = DB::run("INSERT INTO employes (fullname, birthday_date, department,salary_type,salary) VALUES (?,?,?,?,?)",$data);
    }
}

class HourlyEmployee extends Employee
{
    protected $salary_type = 'hourly';
    protected $hours;
    public function __construct($fullname, $birthday_date, $department,$salaryph,$hours)
    {
        $this->fullname = $fullname;
        $this->birthday_date = $birthday_date;
        $this->department = $department;
        $this->salary = $salaryph;
        $this->hours = $hours;
        $this->insert();
    }
    public function insert(){
        $data = [$this->fullname,$this->birthday_date,$this->department,$this->salary_type,$this->salary,$this->hours];
        $sql = DB::run("INSERT INTO employes (fullname, birthday_date, department,salary_type,salary,hours) VALUES (?,?,?,?,?,?)",$data);
    }
}

/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";*/


class Router
{
    public $uri;
    public function __construct($uri)
    {
        $this->uri = $uri;
        //echo $this->uri;

    }

    public function call($pattern, $callback_func)
    {

        if (!is_callable($callback_func)) {
            return false;
        }

        $matches = [];

        if (preg_match($pattern, $this->uri, $matches)) {
            array_shift($matches);
            call_user_func($callback_func, $matches);
        } else {
            header("HTTP/1.0 404 Not Found");
            die();
        }


        return true;
    }

    public function getXml(){
        /*if (file_exists('employes.xml')){
            $obj = simplexml_load_file('employes.xml');
        }
       $data=[];
        //$newxml = new SimpleXMLElement($xmlstr);

        foreach ($obj->employes as $employee) {
          // итерация по дочерним элементам comp
            var_dump($employee['fullname']);
            foreach ($employee as $item) {
               // echo "<td>$item</td>";
                var_dump($item['fullname']);
            }

        }*/

    }

    public function AllEmpl()
    {

        require_once 'AllEmployes.php';

    }

    public function EmplPag($n)
    {
        require_once 'EmplPagin.php';
    }

    public function EmplDepPag($d)
    {
        require_once 'EmplDepPagin.php';
    }


    public function AllEmplDep($d)
    {
        require_once 'AllEmplDep.php';
    }
    public function salary($salary,$hours){
        $salary = intval($salary);
        $hours = intval($hours);
        return $salary*$hours;
    }
}

$router = new Router($_SERVER['REQUEST_URI']);
if (preg_match("/^\/employes\/(\d+)$/", $_SERVER['REQUEST_URI']))
    $router->call("/^\/employes\/(\d+)$/", 'Router::EmplPag');

if (preg_match("/^\/employes\/$/", $_SERVER['REQUEST_URI']))
   $router->call("/^\/employes\/$/", 'Router::AllEmpl');

if (preg_match("/^\/employes\/(dev|marketing|design)$/", $_SERVER['REQUEST_URI'])){
    $router->call("/^\/employes\/(dev|marketing|design)$/", 'Router::AllEmplDep');
}

if (preg_match("/^\/employes\/(dev|marketing|design)\/(\d+)$/", $_SERVER['REQUEST_URI']))
    $router->call("/^\/employes\/(dev|marketing|design)\/(\d+)$/", 'Router::EmplDepPag');

?>
<?php
$col = DB::run('SELECT count(id) from employes');
$col = $col->fetchAll();
$col = $col[0];
$col = $col['count(id)'];

?>

<script src="/script.js">

</script>
<?php
//$rateEmp = new RateEmployee('Illichov','1999-12-25','Dev',500);
//$hourEmp = new HourlyEmployee('Khyzhuk','1999-12-23','Design',20,8);
//$router->getXml();
?>
</body>

</html>