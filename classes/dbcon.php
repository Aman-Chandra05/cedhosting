<?php
session_start();
class Dbcon
{
 public $conn;
 public function conn()
 {
	$conn = new mysqli("localhost", "root", "", "cedhosting");
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}
	else
 	{
 		return $conn;
 	}
 }
 /*function __construct()
 {
	$this->conn = new mysqli("localhost", "root", "", "cedhosting");
	if ($this->conn->connect_error) 
	{
    	die("Connection failed: " . $this->conn->connect_error);
	}
 }*/
}
?>