<?
	/* @author Rafael Campos
	 * @date 28 de Março de 2009
	 **/
	
	/*Configurações*/
	$server = "localhost";
	$username = "root";
	$password = "vertrigo";
	$database = "load";
	$altura_post = 20.5; 
	$table = "`post`";
	$field = "`post_titulo`";
	$table_border  = "0";
	$table_width = "300px";
	
	//Daqui para baixo não se mexe
	$conneccao = mysql_connect( $server, $username, $password );
	
	$ligacao = mysql_select_db  (  $database , $conneccao );
	
	if( isset( $_POST["colnumber"] ) && is_numeric( $_POST["colnumber"] ) ){
		
		$leitura = mysql_query ("Select $field From $table Limit ". $_POST["colnumber"].",1", $conneccao);
		
		if( mysql_num_rows($leitura) == 1 )
			echo utf8_encode(mysql_result($leitura,0,0));	
		
		mysql_free_result($leitura);
		
	} else if( isset( $_GET['screenheight'] ) && is_numeric( $_GET['screenheight'] ) ){
		
		$leitura = mysql_query ("Select $field From $table Limit 0,".ceil($_GET['screenheight']/$altura_post), $conneccao);
		
		echo "<table border=\"$table_border\" width=\"$table_width\">";
		
		while( $row =  mysql_fetch_array($leitura) ){
		
			echo "<tr><td>".utf8_encode($row[0])."</td></tr>";
		
		}
		
		echo "</table>";
		
		mysql_free_result($leitura);
		
	}
	
	mysql_close( $conneccao );
	
?>