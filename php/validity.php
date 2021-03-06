<?php
function clean_data($value = "")
{
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
	$value = addslashes($value);
	return ($value);
}

function check_validity_reg_data($data)
{
	if (!isset($data) || strlen($data) < 3 || strlen($data) > 29 || empty($data))
		return (false);
	return (true);
}

function check_validity()
{
	$arr = array();
	$i = 0;
	foreach ($_POST as $value)
	{
		$value2 = clean_data($value);
		if (check_validity_reg_data($value2) != true)
			return(NULL);
		array_push($arr, $value2);
		$i++;
	}
	if (count($arr) != count($_POST))
		return (NULL);
	return ($arr);
}