<?php
$firstnameErr = $lastnameErr = $phoneErr = $emailErr = $subjectErr = $messageErr = "";
$firstname = $lastname = $phone = $email = $subject = $message = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $firstnameErr = "* First Name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "* Last name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "* Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$^", $phone)) {
            $phoneErr = "Only numbers allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "* Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["subject"])) {
        $subjectErr = "* Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $messageErr = "* Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    if ($firstnameErr == '' and $lastnameErr == '' and $phoneErr == '' and $emailErr == '' and $subjectErr == '' and $messageErr == '') {
        header('Location:success.php');
        exit();
    }


}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>My test page</title>
    <style>
        form {
            width: 700px;
            border: 1px solid #CCC;
            padding: 1em;
            border-radius: 1em;
        }
        .error {color: #FF0000;}
    </style>
</head>

<body>
    <form id="contact" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div>
            <input placeholder="Your first name" type="text" name="firstname" value="<?= $firstname ?>" autofocus>
            <span class="error"><?= $firstnameErr ?></span>
        </div>
        <br>
        <div>
            <input placeholder="Your last name" type="text" name="lastname" value="<?= $lastname ?>" autofocus>
            <span class="error"><?= $lastnameErr ?></span>
        </div>
        <br>
        <div>
            <input placeholder="Your Email" type="text" name="email" value="<?= $email ?>">
            <span class="error"><?= $emailErr ?></span>
        </div>
        <br>
        <div>
            <input placeholder="Your Phone Number" type="text" name="phone" value="<?= $phone ?>">
            <span class="error"><?= $phoneErr ?></span>
        </div>
        <br>
        <div>
            <select class="form-control" id="selectsubject" name="subject">
                <option>Subject 1</option>
                <option>Subject 2</option>
                <option>Subject 3</option>
            </select>
            <span class="error"><?= $subjectErr ?></span>
        </div>
        <br>
        <div>
            <textarea name="message" rows="6" cols="50" value="<?= $message ?>"></textarea>
            <span class="error"><?= $messageErr ?></span>
        </div>
        <br>
        <div class="button">
            <button type="submit">Send your message</button>
        </div>
    </form>
</body>

</html>