<?php

	function prawidlowaWartosc($wartosc)
	{
		if (is_numeric($wartosc))
		 return $wartosc;
		else
		 return null;
	}

	$link = @mysql_connect("localhost", "root", "vertrigo") or die("nie udało się połączyć");
		
	@mysql_select_db("test") or die ("nie udało się wybrać bazy danych");
	mysql_query("SET NAMES 'utf8'");

	$powierzchniamin = prawidlowaWartosc($_GET['powierzchniamin']);
	$powierzchniamax = prawidlowaWartosc($_GET['powierzchniamax']);
	$ludnoscmin = prawidlowaWartosc($_GET['ludnoscmin']);
	$ludnoscmax = prawidlowaWartosc($_GET['ludnoscmax']);
	
	$query = "SELECT nazwa, powierzchnia, ludnosc FROM wojewodztwa";
	
	if ($powierzchniamin != null || $powierzchniamax != null || $ludnoscmin != null || $ludnoscmax != null)
	 $query .= " WHERE id > 0";
	 
	if ($powierzchniamin != null)
	 $query .= " AND powierzchnia >= ".$powierzchniamin;
	 
	if ($powierzchniamax != null)
	 $query .= " AND powierzchnia <= ".$powierzchniamax;	 
	 
	if ($ludnoscmin != null)
	 $query .= " AND ludnosc >= ".$ludnoscmin;

	if ($ludnoscmax != null)
	 $query .= " AND ludnosc <= ".$ludnoscmax;	 
	 	 
	$result = mysql_query($query) or die("nie udało się pobrać danych");
	
	echo "<table id='wojewodztwa'>";
	
	echo "<tr><th>Nazwa:</th><th>Pow.:(km2)</th><th>Ludność:</th></tr>";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		echo "<tr>";
		foreach($row as $klucz => $wartosc)
		{
			if ($klucz == "nazwa")
			    echo "<td class='rekord'>".$wartosc."</td>";
			else if ($klucz == "powierzchnia")
				echo "<td class='rekord'>".$wartosc."</td>";
			else if ($klucz == "ludnosc")
				echo "<td>".$wartosc."</td>";		
		}	
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo $powierzchniamin;
	mysql_close($link);
?>