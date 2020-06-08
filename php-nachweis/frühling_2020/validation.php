<?php

//Session starten
session_start();

//Funktion, um eine Session ID anhand von Nutzernamen und Passwort zu erhalten
function getSessionId(){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$domain=$_POST['domain'];

	//initialize CURL
	$ch=curl_init();

	//CURL Optionen für URL und Rückgabe (Session ID soll output sein)
	curl_setopt($ch, CURLOPT_URL,'https://'.$domain.'/rest/com/session');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//sÜbersetzung von CURL:  -c cookie-jar.txt
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie-jar.txt');

	//unsichere Verbindung (-k insecure)
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	//Nutzername und Passwort festlegen
	curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);

	//POST request, da Nutzername und Passwort benutzt werden
	curl_setopt($ch,CURLOPT_POST, true);

	//Header wird benötigt
	curl_setopt($ch,CURLOPT_HTTPHEADER ,array('Content-Length: 0','Access-Control-Allow-Origin:*'));

	// $output hat die Session ID im output
	$output = curl_exec($ch);

	// CURL schließen
	curl_close($ch); 

	//JSON-Resultat wird dekodiert
	$json = json_decode($output);

	//wenn die Authentifizierung fehlschlägt, kann keine Session ID zurückgegeben werden
	if($json->type=="com.api.std.errors.unauthenticated"){
		return "";
    }

	//Session ID kann nun aus JSON-Output entnommen werden
	$session_id=$json->value;

	//Session ID wird in PHP Session gespeichert, um für mehrere Seiten genutzt zu werden
	$_SESSION['sessionid']=$session_id;

	return $session_id;
}

//Funktion zur Validierung von bestimmten Daten
function validateData($data_name,$store_name,$error1){
	$_SESSION[$store_name]="";
	$store_info=javaExec($data_name);
	$_SESSION[$store_name]=$store_info;
	if($store_info[0]=="java.lang.NullPointerException"){
		$error1="Error: invalid data, no available storage found. Please try another option.";
	}
	else{
		$error1="";
	}
	return $error1;
}

//Email-Validierung mit eingebauter PHP-Funktion
function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

//IP-Validierung mit eingebauter PHP-Funktion
function validateIP($ip){
    if(!filter_var($ip, FILTER_VALIDATE_IP)){
        return false;
    }
	return true;
}

//Funktion, um Login-Daten zu validieren
function validateSignin(){

	//mögliche Error-Nachricht
	$error="";
    
	//checken, ob irgendwelche Felder leer sind
	if(empty($_POST['domain'])){
		$error="Error: domain field must not be empty.";
		return $error;
	}
	if(empty($_POST['username'])){
		$error="Error: username field must not be empty.";
		return $error;
	}
	if(empty($_POST['password'])){
		$error="Error: password field must not be empty.";
		return $error;
	}

    //checken, ob Checkbox-feld ausgewählt ist und nur dann die gewählten Daten validieren
    if(isset($_POST['email-notify'])){

        //verify nothing is empty
        if(empty($_POST['email'])){
            $error="Error: email field cannot be empty, if you wish to receive email notification.";
            return $error;
        }
        if(empty($_POST['ip'])){
            $error="Error: email SMTP field cannot be empty, if you wish to receive email notification.";
            return $error;
        }
        if(empty($_POST['email-2'])){
            $error="Error: email from field cannot be empty, if you wish to receive email notification.";
            return $error;
        }

        //Wenn kein Feld leer ist, werden Email-Felder validiert
        if(!validateEmail($_POST['email'])||!validateEmail($_POST['email-2'])){
            $error="Error: invalid email input.";
            return $error;
        }

        //IP oder Domain-Name validieren
        if(!validateIP($_POST['ip'])&&!validateIP(gethostbyname($_POST['ip']))){
            $error="Error: invalid email SMTP input.";
            return $error;
        }
    }

    //Session ID mit getSessionId()-Funktion validieren
    $session_id=getSessionId();
    if($session_id==""){
        $error="Error: invalid input. Please reenter your sign in information.";
    }

	//Fehlermeldung wird zurückgegeben, wenn keine Fehler passiert sind, ist diese leer
    return $error;
}

//Funktion, um sicherzustellen, dass Daten in einem Array vorhanden sind
function validateDataExistence($arr){
    $error="";
	
	//wenn keine Daten vorhanden sind: Fehlermeldung anzeigen
    if(empty($arr)){
        $error="Error: no valid data found. Please make sure to have at least one available option in the array.";
    }
    return $error;
}