<?php
//Session starten
session_start();

//Funktion für ein GET request mit einer REST API und CURL; die JSON-Daten werden dekodiert zurückgegeben
function getrequestJson($url,$value_param,$name_param,$session_id){
	//CURL initialisieren
	$ch = curl_init();

	//URL bestimmen
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//GET request kreieren
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	//unsichere Verbindung
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	//Header kreieren, wird benötigt
	curl_setopt($ch,CURLOPT_HTTPHEADER ,array('Content-Length: 0','Access-Control-Allow-Origin:*'));

	//CURL wird ausgeführt und Ergebnisse werden in $result gespeichert
	$result = curl_exec($ch);

	//CURL schließen
	curl_close($ch);

	//dekodiertes JSON wird zurückgegeben
	$json=json_decode($result);
	return $json;
}

//Funktion, die echo benutzt, um Dropdown-Menüs mithilfe von GET request zu erstellen
function getrequest($url,$value_param,$name_param,$session_id){

	//JSON-Output von getrequestJson() funktion wird mithilfe von foreach-loop als Dropdown ausgegeben
	$json=getrequestJson($url,$value_param,$name_param,$session_id);
	foreach ($json->value as $item) {
	   echo '<option value="'.$item->$value_param.'|'.$item->$name_param.'">'.$item->$name_param.'</option>';
	}
}

//selbe Funktion wie getrequest-Funktion mit dem Unterschied, dass die Outputs gespeichert werden
function getrequestStore($url,$value_param,$name_param,$session_id){
	$json=getrequestJson($url,$value_param,$name_param,$session_id);
	$results=array();
	foreach ($json->value as $item) {
	   array_push($results,$item->$value_param.'|'.$item->$name_param);
	}
	return $results;
}

//selbe Funktion wie getRequestStore, nur dass name->param und value->param separat in Array gespeichert werden
function getrequestStoreTwo($url,$name_param,$value_param,$session_id){
	$json=getrequestJson($url,$value_param,$name_param,$session_id);
	$results=array();
	foreach ($json->value as $item) {
	   array_push($results,array($item->$name_param,$item->$value_param));
	}
	return $results;
}

//Funktion, um Session-Variablen zu bestimmen; zwei Werte sind im Option value mit | getrennt und werden hier getrennt gespeichert
function setSessionVars($value,$postval){
	$values=explode('|',$_POST[$postval]);
	$_SESSION[''.$value.'']=$values[1];
	$_SESSION[''.$value.'-value']=$values[0];
}

//Funktion, um Java shell-commands mit Input gespeichert in der PHP Session auszuführen
function javaExec($user_input){

	//shell_exec: shell command ausführen und den output nicht speichern; in diesem Fall sollte auch kein Output kommen
	shell_exec('javac -cp "Test.jar:lib/*:." JavaFile.java');

	//shell command zur Ausführung einer Java-Datei mit Werten der PHP Session als Input
 	$command='java -cp "Test.jar:lib/*:." JavaFile '.$_SESSION['value1'].' '.$_SESSION['value2'].' '.$_SESSION['value3'].' '.$_SESSION[$user_input];
	
	//shell command wird ausgeführt und in $output gespeichert
	exec($command,$output);

	//der Output könnte zum Beispiel ein Optionen-Array sein
    return $output;
}

//Funktion, um ein Array mit Echo wiederzugeben (z.B. für Dropdown-Menü)
function printArray($values){
    foreach($values as $val){
		echo $val;
   }
}

//Funktion, um ein Array mit key-value (associative array) wiederzugeben als Dropdown-Menü
function printKeyValue($arr){

	//Key und Value werden getrennt als zwei Variablen
	foreach($arr as $key=>$value){
		//Aufteilung in Doppelwert mit explode()
		$key_name=explode('|',$key)[1];
		//echo kreiert dies als Dropdown-Option
		echo "<option value='".$key."'>".$key_name."</option>";
	}
}

//Funktion, um eine Reihe eines verschachtelten Arrays mit 2 Werten wiederzugeben
function printNestings($arr,$row_val){

	//Reihe wird gefunden
	$row=$arr[$row_val];

	//Wert wird mit | getrennt, um 2 Werte speichern zu können
	foreach($row as $entry){
		echo "<option value='".$entry[1].'|'.$entry[0]."'>".$entry[0]."</option>";
	}
}
?>