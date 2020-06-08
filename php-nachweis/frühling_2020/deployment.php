<!--
    Diese Datei ist für Deployment mit einem shell command gedacht.
-->
<!DOCTYPE html>
<html>
<head>
	<title>Deployment</title>
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
				<div class="card-header deploy-run">
                    <!-- Title -->
                    <h3>Deployment in progress...</h3>
                    <!--Icon-->
                    <div class="d-flex justify-content-end social_icon">
                        <img src="https://img.icons8.com/color/98/000000/vmware.png">
                    </div>
                    <!--Loading circle-->
                    <div class="loader justify-content-center"></div>
				</div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
//shell command für das Deployment
exec('java -jar /path/to/JarFile.jar -c inputFile',$output,$return_val);

//shell command wird Ausgabe in txt file speichern, was zum Debugging beitragen kann
file_put_contents('deploy-log.txt',$output);

//Error-Route
if($return_val|| exec('grep "ERROR" ./deploy-log.txt')) {
	header('Location:deployment-error.php');
}
//Erfolgs-Route
else if(!$return_val){
	header('Location:index.php');
}
?>