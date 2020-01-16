<?php

//starting session   
session_start();
include "inc/questions.php";
var_dump($_SESSION);
//setting couter to 0 if new session.
if (empty($_SESSION["count"])) {
    $_SESSION["count"] = 0;
}

//mixing questions and putting sequence into session
if (empty($_SESSION["sequence"])) {
    for ($i = 0; $i < count($questions); $i++) {
        $_SESSION["sequence"][] = $i;
    }
    shuffle($_SESSION["sequence"]);
}

//mixing thre possible answers
$possible_answers = ["correctAnswer", "firstIncorrectAnswer", "secondIncorrectAnswer"];
shuffle($possible_answers);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">

    <?php
    if (isset($_SESSION["last_answer"])) {
        if ($_SESSION["last_answer"] == 1) {
            echo "<h1>Great, last answer was correct.</h1>";
        } elseif ($_SESSION["last_answer"] == 0) {
            echo "<h1>Uh, last answer was wrong.</h1>";
        }
    }
    ?>
</head>

<body>
    <div class="container">
        <div id="quiz-box">
            <p class="breadcrumbs">Question <?php echo $_SESSION["count"] + 1 ?></p>
            <p class="quiz">What is <?php echo $questions[$_SESSION["sequence"][$_SESSION["count"]]]["leftAdder"] ?> + <?php echo $questions[$_SESSION["sequence"][$_SESSION["count"]]]["rightAdder"] ?>?</p>
            <form action="inc/quiz.php" method="post">
                <input type="hidden" name="id" value="0" />
                <input type="submit" class="btn" name="answer" value='<?php echo $questions[$_SESSION["sequence"][$_SESSION["count"]]][$possible_answers[0]] ?>' />
                <input type="submit" class="btn" name="answer" value="<?php echo $questions[$_SESSION["sequence"][$_SESSION["count"]]][$possible_answers[1]] ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $questions[$_SESSION["sequence"][$_SESSION["count"]]][$possible_answers[2]] ?>" />
            </form>
        </div>
    </div>
</body>

</html>