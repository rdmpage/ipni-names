<?php

// IPNI data browser

require_once(dirname(__FILE__) . '/config.inc.php');
require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');


//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	$config['db_user'] , $config['db_passwd'] , $config['db_name']);

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


//--------------------------------------------------------------------------------------------------
function default_display()
{
	global $config;
	
	echo '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="' . $config['web_root'] . '" />
		<link type="text/css" href="' . $config['web_root'] . 'css/main.css" rel="stylesheet" />
		<title>' . $config['site_name'] . '</title>
	</head>
	<body>
		<div style="float:right;">
			<form method="get" action="index.php">
			<input type="search"  name="q" id="q" value="" placeholder="Genus"></input>
			<input type="submit" value="Search" ></input>
			</form>
		</div>
		<h1>IPNI Browser</h1>
	</body>
</html>';
}


//--------------------------------------------------------------------------------------------------
function display_search($query)
{
	global $config;
	global $db;
	
	$found = false;
	
	$query = trim(mysql_escape_string($query));
	
	if (preg_match('/^\w+$/', $query))
	{
		$sql = 'SELECT * FROM names WHERE Genus = ' . $db->qstr($query) . ' LIMIT 1';
	
		$result = $db->Execute($sql);
		if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
		
		if ($result->NumRows() == 1)
		{
			$genus = $query;
			display_genus($query);
			$found = true;
		}
	}
	
	if (!$found)
	{
		echo '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="' . $config['web_root'] . '" />
		<link type="text/css" href="' . $config['web_root'] . 'css/main.css" rel="stylesheet" />
		<title>' . $config['site_name'] . '</title>
	</head>
	<body>
		<div style="float:right;">
			<form method="get" action="index.php">
			<input type="search"  name="q" id="q" value="" placeholder="Genus"></input>
			<input type="submit" value="Search" ></input>
			</form>
		</div>
		<p>Sorry, your search for "' . $query . '" didn\'t match any data (note that you can only search for genus names).</p>
	</body>
</html>';

	
	
	
	}

}


//--------------------------------------------------------------------------------------------------
function display_genus($genus)
{
	global $config;
	global $db;
	
	$species = array();
	$major_group ='';
	$family = '';
	
	$sql = 'SELECT * FROM names WHERE Genus = "' . $genus . '" ORDER BY Species';
	
	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);
	while (!$result->EOF) 
	{
		$record = new stdclass;
		$record->id = $result->fields['Id'];
		$record->html = '<i>' . $result->fields['Genus'] . '</i>';
		
		switch ($result->fields['Rank'])
		{
			case 'sect.':
			case 'ser.':
			case 'subgen.':
				$record->html .= ' ' . $result->fields['Rank'] . '<i> ' . $result->fields['Infra_genus'] . '</i>';					
				break;
				
			case 'spec.':
				$record->html .= ' <i>' . $result->fields['Species'] . '</i>';					
				break;
				
			case 'f.':
			case 'forma':
			case 'subsp.':
			case 'var.':
				$record->html .= ' <i>' . $result->fields['Species'] . '</i> ' . $result->fields['Rank'] . ' <i>' . $result->fields['Infra_species'] . '</i>';					
				break;
			
			default:
				break;
		}
		$record->html .= ' ' . utf8_encode($result->fields['Authors']);
		$record->publication = trim(utf8_encode($result->fields['Publication']) . ' ' . utf8_encode($result->fields['Collation']));
		if ($result->fields['Page'] != '')
		{
			$record->publication .= ' '  . $result->fields['Page'];
		}
		$record->publication .= ' ' . $result->fields['Publication_year_full'];
		
		// identifiers
		
		$identifiers = array('issn', 'doi', 'jstor', 'biostor', 'bhl', 'cinii', 'url', 'pdf', 'handle');
		foreach ($identifiers as $i)
		{
			if ($result->fields[$i] != '')
			{
				$record->{$i} = $result->fields[$i];
			}
		}
		
		
		$species[] = $record;
		$result->MoveNext();	
	
	}
	
	$title = $genus;
	
	// Display...
	echo 
'<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="' . $config['web_root'] . '" />
		<link type="text/css" href="' . $config['web_root'] . 'css/main.css" rel="stylesheet" />
		<script type="text/javascript" src="' . $config['web_root'] . 'js/jquery-1.4.4.min.js"></script>
		<title>' . $title . ': ' . $config['site_name'] . '</title>
		
		<script>
		
			function show_doi(doi)
			{
				$("#details").html("");
				$.getJSON("pub.php?doi=" + encodeURIComponent(doi),
					function(data){
						var html = data.html;
						$("#details").html(html);
					}
					
				);	
				//$("#details").html("xxx");
			}
			
			function show_cinii(cinii)
			{
				$("#details").html("");
				$.getJSON("pub.php?cinii=" + cinii,
					function(data){
						var html = data.html;
						$("#details").html(html);
					}
					
				);	
				//$("#details").html("xxx");
			}
			
		</script>
	</head>
	<body>
		<div style="float:right;">
			<form method="get" action="index.php">
			<input type="search"  name="q" id="q" value="" placeholder="Genus"></input>
			<input type="submit" value="Search" ></input>
			</form>
		</div>
		<h1><i>' . $title . '</i></h1>
		<h2>Species in genus <i>' . $title . '</i></h2>';

	echo '<div style="position:relative;">';
	echo '<div style="width:800px;height:400px;overflow:auto;border:1px solid rgb(128,128,128);">';

	echo '<table id="specieslist">';
	echo '<tbody style="font-size:12px;">';
	
	$odd = true;
	
	foreach ($species as $sp)
	{
		echo '<tr';
		
		/*
		if ($odd)
		{
			echo ' style="background-color:#def;"';
			$odd = false;
		}
		else
		{
			echo ' style="background-color:#fff;"';
			$odd = true;
		}
		
		*/
		
		
		echo '>';
		echo '<td>' . $sp->id . '</td>';
		echo '<td>' . $sp->html . '</td>';
		echo '<td>' . $sp->publication . '</td>';
		
		echo '<td>';
		if (isset($sp->issn))
		{
			echo str_replace('-', '', $sp->issn);
		}		
		echo '</td>';
		
		
		echo '<td>';
		if (isset($sp->doi))
		{
			echo '<span onclick="show_doi(\'' . $sp->doi . '\');">';
			echo $sp->doi;
			echo '</span>';
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->handle))
		{
			echo $sp->handle;
		}		
		echo '</td>';
		
		echo '<td>';
		if (isset($sp->jstor))
		{
			echo $sp->jstor;
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->biostor))
		{
			echo $sp->biostor;
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->bhl))
		{
			echo $sp->bhl;
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->cinii))
		{
			echo '<span onclick="show_cinii(\'' . $sp->cinii . '\');">';
			echo $sp->cinii;
			echo '</span>';
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->url))
		{
			echo '<a href="' . $sp->url . '" title="' . $sp->url . '">';
			echo substr($sp->url, 7, 20) . '...';
			echo '</a>';
		}		
		echo '</td>';

		echo '<td>';
		if (isset($sp->pdf))
		{
			echo '<a href="' . $sp->pdf . '" title="' . $sp->pdf . '">';
			echo substr($sp->pdf, 7, 20) . '...';
			echo '</a>';
		}		
		echo '</td>';
		
		
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	
	echo '<div style="font-size:12px;position:absolute;top:0px;left:800px;width:auto;padding-left:10px;">';
	echo '<p style="padding:0px;margin:0px;" id="details"></p>';
	echo '</div>';
	
	echo '</div>';
	
	echo
'	</body>
</html>';

}




//--------------------------------------------------------------------------------------------------
function main()
{
	global $config;
	global $debug;
	
	$query = '';
		
	// If no query parameters 
	if (count($_GET) == 0)
	{
		default_display();
		exit(0);
	}

	$major_group = '';
	$family = '';
	$genus = '';
	
	if (isset($_GET['q']))
	{
		$query = $_GET['q'];
		display_search($query);
	}
	
	/*
	if (isset($_GET['family']))
	{	
		$family = $_GET['family'];
		display_family($family);
	}
	*/

}


main();
		
?>