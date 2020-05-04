<?php
if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

require_once(HEADERF);

e107::lan('eventcalender');
e107::meta('keywords','Ninja4Ever, Kuroi Fenikkusu Dojo Kampfkunstverein e.V., Ninjutsu, Kampfsport, Kampfkunst, Berlin, Spandau, Berlin-Spandau, Event, Seminar, Veranstaltung, Kalender,');

$sql = e107::getDB();
$tp = e107::getParser();
$ns = e107::getRender();

		$eintraege = $sql->gen("SELECT * FROM #eventcalender WHERE ec_ID > 0 ORDER BY ec_Beginn ASC");
		$text = '';
		if($eintraege)
		{
			$text .= "<p>Irgendwo scheint noch ein kleiner Fehler zu sein. Solltet Ihr nur ein Event sehen, ist die Wahrscheinlichkeit groß, dass das nicht richtig ist. Dann bitte einfach einen Reload machen, dann wird sicher alles angezeigt. Ich werde den Fehler noch finden.</p><hr>";
			
			while($row = $sql->fetch())
			{
				$date_format = e107::getPlugPref('eventcalender', 'date_format', '%A, %d. %B %Y - %H:%M');
				$name = $row['ec_Name'];
				$url = $row['ec_URL'];
				$beginn = $row['ec_Beginn'];
				$beginn = e107::getDate()->convert_date($beginn, $date_format);
				$ende = $row['ec_Ende'];
				$ende = e107::getDate()->convert_date($ende, $date_format);
				$description = nl2br($row['ec_Beschreibung']);
				$text .= "<h3>".$name."</h3>";
				$text .= "<p><strong>".LAN_EC_01."</strong> ".$beginn." Uhr<br>";
				$text .= "<strong>".LAN_EC_02."</strong> ".$ende." Uhr<br>";
				$text .= LAN_EC_03." <a href='".$url."' target='_blank'>".$url."</a></p>";
				$text .= "<p>".$description."</p>";
				$text .= "<hr>";
			}
			$text .= "<p>".LAN_EC_05."</p>";
		}
		else
		{
			$text .= "<div class='alert alert-info text-center'>".LAN_EC_06."</div>";
		}
		$caption = LAN_EC_CAPTION;
		$ns->tablerender($caption, $text);

require_once(FOOTERF);
exit; 
?>