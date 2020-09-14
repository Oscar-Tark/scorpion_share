<?php
$includer = new Includer;

$includes_templates = array(
    'PHP' => "modules/generic/phpinclude/modules/*.php",
    'JS' => "modules/generic/jsinclude/modules/*.js",
    'CSS' => "modules/gui/cssinclude/*.css",
    'CUST_JS' => "custom_modules/jsinclude/*.js",
    'CUST_PHP' => "custom_modules/phpinclude/*.php",
    'CUST_CSS' => "custom_modules/cssinclude/*.css",
    'DEF' => null
);

$includes_templates_functionality = array(
    'PHP' => function($path)
    {
        include_once($path);
        return;
    },
    'JS' => function($path)
    {
        echo "<script src='".$path."'></script>";
        return;
    },
    'CSS'=> function($path)
    {
        echo "<link rel='stylesheet' href='".$path."'>";
        return;
    },
    'DEF' => null
);

class Includer
{
	function includes($concatenation_level, $type)
	{
		//Takes: int = 0 = ./ = 1 = ../ = 2 = ../../ etc...
		global $includes_templates, $includes_templates_functionality;
		$concat = "./";
		if($concatenation_level != 0 && $concatenation_level != -1 && $concatenation_level != 88)
			$concat = $this->create_concatenation($concatenation_level);
		else if($concatenation_level == 88)
			$concat = $this->create_concatenation(2) . "scorpion-php-api/";
    
		foreach(glob($concat.$includes_templates[$type]) as $filename)
			$includes_templates_functionality[$type]($filename);
			
		$this->include_google_fonts();
		return;
	}

	function includes_custom($concatenation_level, $type)
	{
		global $includes_templates, $includes_templates_functionality;
		$concat = "./";
		if($concatenation_level != 0 && $concatenation_level != -1 && $concatenation_level != 88)
			$concat = $this->create_concatenation($concatenation_level, $concat);
		$final_path = $concat.$includes_templates[$type];
		
		//REPLACE CUST_ with '' if is custom
		$type = str_replace('CUST_', '', $type);
		foreach(glob($final_path) as $filename)
			$includes_templates_functionality[$type]($filename);
		return;
	}

	function create_concatenation($concatenation_level)
	{
		$concatenation = "";
		$intup = 0;

		while($intup < (int)$concatenation_level)
		{
			$concatenation = $concatenation."../";
			$intup++;
		}
		return $concatenation;
	}
	
	function include_google_fonts($fonts = array("Lato", "Courgette", "Mukta+Mahee"))
	{
		foreach($fonts as $font)
			echo '<link href="https://fonts.googleapis.com/css?family='.$font.'" rel="stylesheet">';
		return;
	}
}
?>
