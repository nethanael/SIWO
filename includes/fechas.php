
<?php
// Se asume que hoy es March 10th, 2001, 5:16:18 pm, y que estamos en la
// zona horaria Mountain Standard Time (MST)

$hoy = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
$hoy = date("m.d.y");                         // 03.10.01
$hoy = date("j, n, Y");                       // 10, 3, 2001
$hoy = date("Ymd");                           // 20010310
$hoy = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
$hoy = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
$hoy = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
$hoy = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
$hoy = date("H:i:s");                         // 17:16:18
$hoy = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL)
?>
