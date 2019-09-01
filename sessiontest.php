<?php
class session{
 public $link='';
 function __construct($userid,$tranformerid, $voltage){
  $this->connect();
  $this->storeInDB($userid, $tranformerid,$voltage);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'power_consumption') or die('Cannot select the DB');
 }
 
 function storeInDB($userid, $tranformerid,$voltage){
  $query = "insert into session set userid='".$userid."', transformerid='".$tranformerid."', voltage='".$voltage."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['userid'] != '' and  $_GET['transformerid'] != '' and $_GET['voltage']!= ''){
    $userid=1;
    $k=1;
    for ($x = 0; $x <= 5; $x++) {
        //sleep(2);
        
 $se1ssion=new session(1,148,1);
    }

}
?>