<?php
session_start(); // Rozpocznij sesję

$conn = mysqli_connect('localhost', 'root', '', 'clients');
mysqli_set_charset($conn, 'utf8');

if (isset($_POST['submit'])) {
    // Sprawdź, czy formularz został już wysłany
    if (!isset($_SESSION['form_submitted'])) {
        $name = $_POST['name'];
        $nick = $_POST['nick'];
        $reason = $_POST['reason'];
        $pr = $_POST['pr'];
        $earn = $_POST['earn'];
        $tracker = $_POST['tracker'];

        $sql = "INSERT INTO clients (id, name, nick, reason, pr, earnings, tracker) VALUES (NULL, '$name', '$nick', '$reason', '$pr', '$earn', '$tracker')";
        $result = mysqli_query($conn, $sql);

        // Ustaw flagę w sesji, że formularz został wysłany
        $_SESSION['form_submitted'] = true;

        // Przekieruj użytkownika na tę samą stronę, aby uniknąć ponownego wysłania formularza
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Wyczyść flagę po załadowaniu strony
unset($_SESSION['form_submitted']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeNext.</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <form action="sent.html" method="post">
            <label for="name"><p>Name:</p><input type="text" name="name" id="name"></label>
            <label for="nick"><p>Nick:</p><input type="text" name="nick" id="nick" required></label>
            <label for="reason"><p>Reason why would like to join:</p><input type="text" name="reason" id="reason" required></label>
            <label for="pr"><p>Power ranking (pr):</p><input type="text" name="pr" id="pr"></label>
            <label for="earn"><p>Earnings:</p><input type="text" name="earn" id="earn"></label>
            <label for="tracker"><p>Tracker:</p><input type="text" name="tracker" id="tracker" required></label><br>
            <label for="submit"><input type="submit" value="Submit" name="submit"></label>
        </form>
    </main>
</body>
</html>