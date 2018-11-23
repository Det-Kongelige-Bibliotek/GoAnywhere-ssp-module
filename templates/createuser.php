<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Opret GoAnywhere Bruger</title>	
</head>
<body>

Du oprettes nu som bruger i GoAnywhere
<form action="<?php echo htmlspecialchars($this->data['yesTarget']); ?>">
	<input type="hidden" name="stateId" value="<?php echo htmlspecialchars($this->data['stateId']); ?>" />
	Fornavn: <input type="text" name="gn" value="<?php echo $this->data['gn']; ?>" /><br>
	Efternavn: <input type="text" name="sn" value="<?php echo $this->data['sn']; ?>" /><br>
	Mail: <input type="text" name="mail" value="<?php echo $this->data['mail']; ?>" /><br>
	<button type="submit" name="yes" class="btn" id="yesbutton">
        	<?php echo htmlspecialchars("Ja det er OK") ?>
    	</button>	
</form>

<form action="<?php echo htmlspecialchars($this->data['noTarget']); ?>"method="get">
    <input type="hidden" name="StateId" value="<?php echo htmlspecialchars($this->data['stateId']); ?>" />
    <button type="submit" class="btn" name="no" id="nobutton">
        <?php echo htmlspecialchars("Nej tak") ?>
    </button>
</form>


</body>
</html>
