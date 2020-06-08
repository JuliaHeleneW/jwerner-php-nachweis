<?php

//start session for storage of run name
session_start();

//form validation: checks if input fields are empty and returns false if they are
function isFormValid(){
	if(!isset($_POST['num-input'])){
		return false;
	}
	if(!isset($_POST['job-name'])){
		return false;
	}
	return true;
}

//Form-Einreichungs-Handler
if(isset($_POST['submit'])){
	//Form-Validierung, um Fehler zu vermeiden
	if(isFormValid()){
		//Name und Pfad der Datei, die modifiziert werden soll
		$fileName = 'myfile.txt';

		//Zahlen-Input des Users
		$num_input=$_POST['num-input'];

		//Name des Jobs
		$job_name=$_POST['job-name'];

		//Jobname wird in Session gespeichert und später genutzt
		$_SESSION['run-name']=$run_name;

		//Beginn in Zeile 0
		$line_num=0;

		//Daten für die Änderung
		$data="Number = ".$num_input."\n";

		//Datei wird geöffnet oder es kommt eine Fehlermeldung, wenn dies nicht möglich ist
		$fileHandle = fopen($fileName, 'r') OR die ("Can't open file\n");

		//Finden der korrekten Zeile für die Änderung
		while(!feof($fileHandle)) {
      		$line_num++;
			$line = fgets($fileHandle,4096);
			if(substr($line, 0, 8) == "Number = "){
				break;
			}
		}
		fclose($fileHandle);

		//$contents: Aller Inhalt der Datei
		$contents = file($fileName);
		//die gesuchte Zeile wird durch die modifizierten Daten ersetzt
		$contents[$line_num-1]=$data;
		//die Inhalte werden nun tatsächlich in die Datei transferiert
		file_put_contents($fileName , implode('', $contents));

		//Wechsel zur nächsten Seite im geplanten Flow
		header('Location:nextpage.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>File Modification</title>
	<!--Fontawesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
		<link rel="stylesheet" href="https://unpkg.com/@clr/ui/clr-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body></br></br></br>
	<div class="clr-row clr-justify-content-center">
		<div class="clr-col-lg-5 clr-col-md-8 clr-col-12">
			<div class="card">
				<!-- Card Header -->
				<div class="card-header">
					<!-- Title -->
					<h3>File Modification</h3>
					<!--Icon-->
					<div class="d-flex justify-content-end social_icon">
						<img src="https://img.icons8.com/color/98/000000/vmware.png">
					</div>
				</div>
				<!-- Card Body -->
				<div class="card-block">
					<form class="clr-form" method="post">
						<!-- Number input label -->
						<label>Number Input</label>
						<div class="clr-control-container">
							<!-- Number Input -->
							<div class="clr-input-wrapper">
								<input type="number" type="text" class="form-control" placeholder="Enter here" name="num-input">
								<clr-icon class="clr-validate-icon" shape="exclamation-circle"></clr-icon>
							</div>
						</div>
						</br><hr width=50% align=left>
						<!-- Job Name Label -->
						<label>Job Name</label>
						<div class="clr-control-container">
							<!-- Text Input for Run Name -->
							<div class="clr-input-wrapper">
								<input type="text" type="text" class="form-control" placeholder="Enter here" name="job-name">
								<clr-icon class="clr-validate-icon" shape="exclamation-circle"></clr-icon>
							</div>
						</div>
						<!-- Submit -->
						<div class="form-group">
							</br><input type="submit" value="Run" name="submit" class="btn float-right login_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>