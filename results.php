<?php
  
include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

$question ="";
$question = $_POST['question'];
$submit = $_POST['submit'];
$type = isset($_POST['type']) ? $_POST['type'] : "";
$answer = $_POST['answerSelection'];

echo("Submit is: ".$submit);
echo("Type is: ".$type);

if($_POST['type'] == "MC") {
//if($type == 'MC') {
  $Option1 = ($_POST['option1']);
  $Option2 = ($_POST['option2']);
  $Option3 = ($_POST['option3']);
  $Option4 = ($_POST['option4']);
  $Option5 = ($_POST['option5']);

  $question = ($_POST['question']);
  $answer = ($_POST['answerSelection']);

  $sql = "INSERT INTO question(`count`, `question`, `type`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`) VALUES ('','$question', '$type','$Option1','$Option2','$Option3','$Option4','$Option5','$answer')";

  //$sql = "insert into `question` (`question`, `type`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`) values('$question', '$type', '$Option1', '$Option2', '$Option3', '$Option4', '$Option5', '$answer') ";

}


else { //if(isset($_POST['submit1'])){

  //$question = ($_POST['question']);
  //$answer = ($_POST['answerSelection']);

  $sql = "insert into question (`question`, `type`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`) values('$question', '$type', 'True', False', NULL, NULL, NULL, '$answer') ";

}

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

/*//For true/false question
if($types == 'TF') {
  $tfQuestion = strval($_POST['tfQuestion']);
  $radioSelected = $_POST['tfChoice'];
  //echo($radioSelected);
  $tfAnswer;
  if($radioSelected && $radioSelected == 'true') {
    $q1tfField1 = strval($_POST['q1tfField1']); 
    $tfAnswer = $q1tfField1;
    echo($tfAnswer);
  } else {
    $q1tfField2 = strval($_POST['q1tfField2']);
    $tfAnswer = $q1tfField2;
    echo($tfAnswer);
  }
}

//For multiple choice question
else if($types == 'MC') {
  $mcQuestion = strval($_POST['mcQuestion']);
  $radioMC = $_POST['mcChoice'];
  echo($radioMC);
  
  $mcAnswer;
  if($radioMC) {
    if($radioMC == 'q2bField1') {
      echo("A");
    }
    else if($radioMC == 'q2bField2') {
      echo("B");
    }
    else if($radioMC == 'q2bField3') {
      echo("C");
    }
    else if($radioMC == 'q2bField4') {
      echo("D");
    }
    else if($radioMC == 'q2bField5') {
      echo("E");
    }
  }
  }*/

?>