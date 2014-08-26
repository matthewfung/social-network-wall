<?php

// Create connection
$con=mysqli_connect('localhost',"root","","mydb");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function fetchRecords($sql)
{
  global $con;
  $rows = array();

  if ($result=mysqli_query($con,$sql))
  {
  	// Fetch one and one row
  	while ($row=mysqli_fetch_assoc($result))
    {
    	$rows[] = $row;
    }
  }
  return $rows;
}

function runQuery($sql)
{
	global $con;
	return mysqli_query($con,$sql);
}