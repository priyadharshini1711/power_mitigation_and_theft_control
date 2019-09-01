<?php
class dist{
 public $link='';
 function __construct($name,$tranformerid, $phoneno,$adharno,$address,$reading,$amount){
  $this->connect();
  $this->storeInDB($name,$tranformerid, $phoneno,$adharno,$address,$reading,$amount);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'power_consumption') or die('Cannot select the DB');
 }
 
 function storeInDB($name,$tranformerid, $phoneno,$adharno,$address,$reading,$amount){
  $query = "insert into distribution set name='".$name."', transformerid='".$tranformerid."', phoneno='".$phoneno."', address='".$address."', adharno='".$adharno."', reading='".$reading."', amount='".$amount."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
  
 }
 
}
if($_GET['name']!=''and $_GET['transformerid']!='' and $_GET['phoneno']!='' and$_GET['adharno']!='' and $_GET['address']!='' and $_GET['reading']!='' and $_GET['amount']){
 $dist=new dist($_GET['name'],$_GET['transformerid'],$_GET['phoneno'],$_GET['adharno'],$_GET['address'],$_GET['reading'],$_GET['amount']);
}
?>