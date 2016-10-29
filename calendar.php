<?php

session_start();

  //use session variable called like variable and have it go back to the same html header() and then back in html there a php code isset and returns a boolean and if it\
 isnt set do nothingbut if it is then show the info i need to show                                                                                                       
include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

//times of taken appointments                                                                                                                                            
$timeArr = [];
//times of available appointments                                                                                                                                        
$time2Arr = [];
//students in appointment                                                                                                                                                
$student = [];
//group appointments taken                                                                                                                                               
$group = [];
//group appointments available                                                                                                                                           
$group2 = [];

$count = 0;

//month, date, and student in database                                                                                                                                  \
                                                                                                                                                                         
$DBmonth;
$DBDay;
$DBYear;
$DBstud;
$currDate;



if(isset($_POST['selDate'])){

$_SESSION['date'] = '';

$date = ($_POST['selDate']);
//echo("Date is: ".$date."\n");                                                                                                                                          



$_SESSION['date'] = '2016';
$_SESSION['day'] = $date;
$_SESSION['month'] = '11';
$_SESSION['date'] .= '-';
$_SESSION['date'] .= $_SESSION['month'];
$_SESSION['date'] .= '-';
$_SESSION['date'] .= '0';
$_SESSION['date'] .= $_SESSION['day'];

//get all the values from the table of advisor info                                                                                                
$sql = mysql_query("SELECT *  FROM `advisor_table`");



$_SESSION['adName'] = "Advisor 1";

//get the inputed rows in the table                                                                                                                
while($row = mysql_fetch_array($sql)) {
  //  $DBDay = substr($row["date"], -2);                                                                                                           
  $DBmonth = substr($row["date"], 5, -3);

 //taken group meetings                                                                                                                                                 
  if($row["available"] == "F" and $row["name"] == "Group" and $DBmonth==$_SESSION['month']) {
    $DBDay = substr($row["date"], -2);
    $DBmonth = substr($row["date"], 5, -3);
    if($DBDay == $date) {
      //      $rawTime = $row['time'];                                                                                                                                   
      //      $time = substr($rawTime, 0, -2);                                                                                                                           
      //      $time .= ":";                                                                                                                                              
      //      $time .= substr($rawTime, 2);                                                                                                                              

      $group[] = $row['time'];
      //      print_r($group);                                                                                                                                           
    }
  }
   //available group meetings                                                                                                                                           
    if($row["available"] == "T" and $row["name"] == "Group" and $DBmonth==$_SESSION['month']) {
      $DBDay = substr($row["date"], -2);
      $DBmonth = substr($row["date"], 5, -3);
      if($DBDay == $date) {
	//      $rawTime = $row['time'];                                                                                                                                 
        //      $time = substr($rawTime, 0, -2);                                                                                                                         
        //      $time .= ":";                                                                                                                                            
        //      $time .= substr($rawTime, 2);                                                                                                                            

        $group2[] = $row['time'];


      }
    }


 //taken individual meetings                                                                                                                                            
  if($row["available"] == "F" and $row["name"] == $_SESSION['adName'] and $DBmonth==$_SESSION['month']) {
    //echo "date: ".$row["date"]. " - Time: " . $row["time"] . " - Available: " . $row["available"];                                                                     
    $DBDay = substr($row["date"], -2);
    $DBmonth = substr($row["date"], 5, -3);
    if($DBDay == $date) {
      //echo"row time is: ".$row["time"]."<br>";                                                                                                                         
      //      $rawTime = $row['time'];                                                                                                                                   
      //      $time = substr($rawTime, 0, -2);                                                                                                                           
      //      $time .= ":";                                                                                                                                              
      //      $time .= substr($rawTime, 2);                                                                                                                              

      $timeArr[] = $row['time'];


    }

  }
  //available individual meetings                                                                                                                                        
  if($row["available"] == "T" and $row["name"] == $_SESSION['adName'] and $DBmonth==$_SESSION['month']) {
    $DBDay = substr($row["date"], -2);
    $DBmonth = substr($row["date"], 5, -3);
    //   echo"month: ".$DBmonth;                                                                                                                                         
    if($DBDay == $date) {
     // echo"row time is: ".$row["time"]."<br>";                                                                                                                         
      //      $rawTime = $row['time'];                                                                                                                                   
      //      $time = substr($rawTime, 0, -2);                                                                                                                           
      //      $time .= ":";                                                                                                                                              
      //      $time .= substr($rawTime, 2);                                                                                                                              

      $time2Arr[] = $row['time'];

    }
  }



}



}
/*                                                                                                                                                                       
for($x = 0; $x < count($timeArr); $x++)                                                                                                                                  
  {                                                                                                                                                                      
    echo"$timeArr[$x] <br>";                                                                                                                                             
  }                                                                                                                                                                      
*/
//echo("<html>");                                                                                                                                                        
//echo("<head>");                                                                                                                                                        
//echo("<body");                                                                                                                                                         

//echo("<p>hello</p>");                                                                                                                                                  

include("startCal.html");



//echo"<div style='float:left; width:75%;'>";                                                                                                                            
//echo"Select date using calenadar on the left";                                                                                                                         

///////////////html///////////////                                                                                                                                       
echo"<h1>Current Appointments</h1>";
//lists group appointments                                                                                                                                               
echo"<h2 style='text-align:left;'>Group Appointments</h2>";
for($x = 0; $x < count($group); $x++)
  {
    $pTime = myTime($group[$x]);
    echo"$pTime - Taken <br>";
  }
for($x = 0; $x < count($group2); $x++)
  {
    $pTime = myTime($group2[$x]);
    echo"$pTime - Available <br>";
  }
echo"<br>";
//lists individual appointments                                                                                                                                          
echo"<h2 style='text-align:left;'>Individual Appointments</h2>";

for($x = 0; $x < count($timeArr); $x++)
  {
    $pTime = myTime($timeArr[$x]);
    echo"$pTime - Taken  <br>";
  }

for($x = 0; $x < count($time2Arr); $x++)
  {
    $pTime = myTime($time2Arr[$x]);
    echo"$pTime - Available <br>";
  }
//echo"</div>";                                                                                                                                                          
echo"<br>";
//section to create new meeting          echo"<h2 style='text-align:left;'>Create New Appointment</h2>";
echo"<form action='newAppt.php' method='post' name='newAppointment'>";
echo"<input type='radio' name='apptType' value='indiv' style='text-align:left;'> Group<br>";
echo"<input type='radio' name='apptType' value='group' style='text-align:left;'> Individual<br>";
echo"<p>Time (in military format - no colon): <input type='text' name='apptTime' placeholder='1300 for 1:00pm'></p>";
echo"<p>Location: <input type='text' name='apptLoc' placeholder='ex. ITE 210'></p>";
echo"<input type='submit' name='newApp' value='Create'>";


echo"</form>";
echo"</body>";
echo"</head>";
echo"</html>";



//This function takes the whole value string containing time and date and formats it into hh:mm am - hh:mm am (or pm). The "&nbsp" puts space at the end of the line so \
that the date looks lined up when displayed on the screen.                                                                                                               
function myTime($value) {
  $string = "";
  //$valueTime = substr($value, 5);                                                                                                                                      
  switch($value) {
  case "0800":
    return $string = "8:00am - 8:30am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0830":
    return $string = "8:30am - 9:00am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0900":
    return $string = "9:00am - 9:30am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0930":
    return $string = "9:30am - 10:00am &nbsp;&nbsp;&nbsp";
  case "1000":
    return $string = "10:00am - 10:30am &nbsp;";
  case "1030":
    return $string = "10:30am - 11:00am &nbsp;";
  case "1100":
    return $string = "11:00am - 11:30am &nbsp;";
  case "1130":
    return $string = "11:30am - 12:00pm &nbsp;";
  case "1200":
    return $string = "12:00pm - 12:30pm &nbsp;";
  case "1230":
    return $string = "12:30pm - 1:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1300":
    return $string = "1:00pm - 1:30pm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1330":
    return $string = "1:30pm - 2:00pm &nbsp;&nbsp;&nbsp;&nbsp;";
  case "1400":
    return $string = "2:00pm - 2:30pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1430":
    return $string = "2:30pm - 3:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1500":
    return $string = "3:00pm - 3:30pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1530":
    return $string = "3:30pm - 4:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  }
    return $string;
}



?>
