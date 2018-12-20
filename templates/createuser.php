<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('GoAnywhere/css/styles.css')?>" />
	<title>Opret Upload Bruger</title>	
	<script>
		function checkForm(theForm) {
			if (theForm.mail.value === '') {
				alert("Angiv venligst en email-addresse");
				return false;
			}
			if (theForm.acceptbox.checked == true) {
				return true;
			}
			alert("Du skal acceptere for at kunne fortsætte");
			return false;
		}
	</script>
</head>

<body class="theme-yellow form" >
	<header class="org-c3af7b08-07d8-4a3e-8b12-5b6de87acf0c">
  		<div class="inner-content grid-container">
    			<div class="grid-x">
      				<div class="small-6 large-3 cell" >
        				<div class="logo">&nbsp;</div>
      				</div>
			</div>
		</div>
	</header>
	
<form id="creatuserform" onsubmit="return checkForm(this);" action="<?php echo htmlspecialchars($this->data['yesTarget']); ?>">
	
 	<div class="grid-container">
    		<div class="grid-x grid-margin-x grid-margin-y">
      			<div class="cell">
          			<h1>Velkommen</h1>
				<p>Du oprettes nu som bruger i Det Kgl. Biblioteks upload-system</p>
     			</div>
<input type="hidden" name="stateId" value="<?php echo htmlspecialchars($this->data['stateId']); ?>" />

			<div class="cell">
				<h4>Fornavn</h4>
        			<div class="mol-ef63e9db-1c74-43c1-82e7-4c8b8c5bfa00 float-label">
    					<div class="wrapper">
<input type="text" name="gn" value="<?php echo $this->data['gn']; ?>" />
					</div>
				</div>
        			<h4>Efternavn</h4>
        			<div class="mol-ef63e9db-1c74-43c1-82e7-4c8b8c5bfa00 float-label">
                			<div class="wrapper">
<input type="text" name="sn" value="<?php echo $this->data['sn']; ?>" />
                			</div>
        			</div>
        			<h4>Mailadresse</h4>
        			<div class="mol-ef63e9db-1c74-43c1-82e7-4c8b8c5bfa00 float-label">
                			<div class="wrapper">
<input type="text" name="mail" value="<?php echo $this->data['mail']; ?>" />
                			</div>
        			</div>
				<p>
Vi behandler personlige oplysninger i henhold til <a href="http://www.kb.dk/da/kb/webstedet/cookiepolitik.html" target="_new">privatlivs- og persondatapolitik for Det Kgl. Bibliotek</a>. Derudover behandler vi specifikt persondata om din mailadresse og dit navn, som bevares i vores brugerdatabase efter du har oprettet dig. Disse personoplysninger er nødvendige at indsamle for at du kan anvende hjemmesidens funktioner.
				</p>
				<!--div class="atom-e7937846-48b1-4797-9eb4-8cd4837fc421"-->
					<input type="checkbox" id="acceptbox" name="acceptbox">
					<label for="checkbox"><?php echo htmlspecialchars("Jeg accepterer") ?></label>
				<!--/div-->
			</div>
			<div class="cell">	
				<button class="button" type="submit" name="yes" id="yesbutton">
        				<?php echo htmlspecialchars("Videre") ?>
    				</button>
			</div>	

		</div>	
	</div>
</form>
</body>
</html>
