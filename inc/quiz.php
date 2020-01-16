<?php
session_start();

//if not set: adding to session: last answer, wrong or correct marker to zero.
if (isset($_POST["answer"])) {
    $_SESSION["answer"] = $_POST["answer"];
}

if (empty($_SESSION["correct"])) {
    $_SESSION["correct"] = 0;
}

if (empty($_SESSION["wrong"])) {
    $_SESSION["wrong"] = 0;
}

// Include questions
include "questions.php";

// if count below number of questions: evaluate answer and update right/wrong counter and count
if (($_SESSION["count"] < 9) && $_SESSION["answer"] == $questions[$_SESSION["sequence"][$_SESSION["count"]]]["correctAnswer"]) {
    $_SESSION["count"] = $_SESSION["count"] + 1;
    $_SESSION["correct"] = $_SESSION["correct"] + 1;
    $_SESSION["last_answer"] = 1;
    header('location: /index.php?');
}
elseif (($_SESSION["count"] < 9) && $_SESSION["answer"] != $questions[$_SESSION["sequence"][$_SESSION["count"]]]["correctAnswer"]) {
    $_SESSION["wrong"] = $_SESSION["wrong"] + 1;
    $_SESSION["count"] = $_SESSION["count"] + 1;
    $_SESSION["last_answer"] = 0;
    header('location: /index.php?');
} 
elseif ($_SESSION["count"] >= 9) {
    
    echo "<h1>Correct answers:" . $_SESSION["correct"] . ". </h1>";
    echo "<h1>Wrong answers:" . $_SESSION["wrong"] . "</h1>";
}





