<head>
    <title>Bro Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .brand {
            background: coral !important;
        }
        .brand-text {
            color: coral !important;
        }
        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="<?php
                if (!isset($_SESSION['user'])){
                    echo "index.php";
                } else {
                    echo "message_list.php";
                }
            ?>" class="brand-logo brand-text"> Bro Chat</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <?php if (isset($_SESSION['user'])):?>
                    <li><a href="new_message.php" class="btn brand z-depth-0">Send new message</a></li>
                    <li><a href="config/log_out.php" class="btn brand z-depth-0">Log Out</a></li>
                <?php else: ?>
                    <li><a href="register.php" class="btn brand z-depth-0">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>