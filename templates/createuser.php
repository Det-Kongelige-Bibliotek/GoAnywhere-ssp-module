<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('GoAnywhere/css/styles.css')?>" />
	<title>Opret Upload Bruger</title>	
</head>

<body class="theme-yellow" >


    <header class="org-c3af7b08-07d8-4a3e-8b12-5b6de87acf0c">
  <div class="inner-content grid-container">
    <div class="grid-x">
      <div class="small-6 large-3 cell" >
        <div class="logo">&nbsp;</div>
      </div>
</div>
</div>
</header>
<main>
	
	
 <div class="content-header">
    <div class="grid-x grid-margin-x">
      <div class="cell medium-8">
          <h1>Velkommen</h1>
      </div>
      <div class="cell small-12 large-8">
        <p>Du oprettes nu som bruger i Det Kgl. Biblioteks upload-system</p>
      </div>
    </div>
  </div>
</div>

<form action="<?php echo htmlspecialchars($this->data['yesTarget']); ?>">
	<input type="hidden" name="stateId" value="<?php echo htmlspecialchars($this->data['stateId']); ?>" />
<div class="grid-container">

<div class="cell">
	<h3>Fornavn</h3>
        <div class="mol-ef63e9db-1c74-43c1-82e7-4c8b8c5bfa00 float-label">
    		<div class="wrapper">
        		<input type="text" name="gn" value="<?php echo $this->data['gn']; ?>" />
</div>
</div>
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

</main>
</body>
</html>
