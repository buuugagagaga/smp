<html>
<head></head>
<body>
<?php

if(isset($_GET["month"])&&isset($_GET["year"])){
    $month = $_GET["month"];
    $year = $_GET["year"];
}
else {
    $month = date("n");
    $year = date("Y");
}
$m;
$y;
if($month != "1"){
    $m=$month-1;
    $y = $year;
}else{
    $m=12;
    $y = $year-1;
}
echo "><<</a>";
echo "${year} ".getdate(mktime(0,0,0,$month+1, 0,$year))["month"];
if($month != "12"){
    $m=$month+1;
    $y = $year;
}else{
    $m=1;
    $y = $year+1;
}
echo "<a href=\"calendar.php?month={$m}&year={$y}\">>></a>";

echo "<table style='border-radius: 10px; color: #ff3e41; background: #55ff30; text-align: center;'>";
echo '<tr><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>';
for($i=0, $month_day=0; $i<5; $i++){
    echo "<tr>";
    for($j=0; $j<7; $j++){
        $wday = (getdate(mktime(0,0,0,$month, $month_day,$year))["wday"]);
        if($j<$wday) {
            echo"<td></td>";
        }else{
            if($month_day<cal_days_in_month(CAL_GREGORIAN, $month, $year)){
                $month_day++;
                echo"<td>{$month_day}</td>";
            }
        }
    }
    echo "</tr>";
}
echo "</table>";



?>
</body>
</html>