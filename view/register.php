<?php
include '../class/auth.php';

$authClass = new Auth();
$register = $authClass->register($_POST);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Register Form</title>
</head>

<body>
    <div class="container">

        <div class="login-root">
            <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
                <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                    <div class="formbg-outer">
                        <div class="formbg">
                            <div class="formbg-inner padding-horizontal--48">
                                <h2>
                                    Register Form
                                </h2>
                                <div><?= $authClass->message ?></div>
                                <form id="stripe-login" action="" method="POST">


                                    <div class="field padding-bottom--24">
                                        <label for="username"><i class="fa-solid fa-user"></i> Username</label>
                                        <input type="text" name="username" id="username" style="<?= $authClass->msgUsername ? 'border: 1px solid red;' : '' ?>" autocomplete="username" autofocus>

                                        <p style="color: rgb(239 68 68); font-weight: 400;"><?= $authClass->msgUsername ?></p>
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                                        <input type="email" name="email" id="email" style="<?= $authClass->msgEmail ? 'border: 1px solid red;' : '' ?>" autocomplete="email">

                                        <p style="color: rgb(239 68 68); font-weight: 400;"><?= $authClass->msgEmail ?></p>
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                                        <input type="password" name="password" id="password" style="<?= $authClass->msgPass ? 'border: 1px solid red;' : '' ?>">

                                        <p style="color: rgb(239 68 68); font-weight: 400;"><?= $authClass->msgPass ?></p>
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <label for="confirmPass"><i class="fa-solid fa-lock"></i> Confirm Password</label>
                                        <input type="password" name="confirmPass" id="confirmPass" style="<?= $authClass->msgConfirm ? 'border: 1px solid red;' : '' ?>">

                                        <p style="color: rgb(239 68 68); font-weight: 400;"><?= $authClass->msgConfirm ?></p>
                                    </div>
                                    <div>
                                        <button type="submit" name="submit" style="margin-bottom: 10px;">Submit</button>
                                    </div>
                                    <div>
                                        Already have an account? <a href="/pwpb-login/view/login.php" style="font-weight: 450;">Sign in</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

    </div>

</body>

</html>