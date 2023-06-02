<?php
$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');
?>

<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Pre Week</a> <!--Previous week-->
<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Next Week</a> <!--Next week-->

<table>
    <tr>
        <td>Employee</td>

<?php
$row=[];
do {
    $row[]=$dt->format('m/d/Y');
    //echo "<td>" . $dt->format('l') . "<br>" . $dt->format('m/d/Y') . "</td>\n";
    $dt->modify('+1 day');
} while ($week == $dt->format('W'));

foreach($row as $rows){
    echo "<td>".$rows."</td>";
}
?>
    </tr>
</table>