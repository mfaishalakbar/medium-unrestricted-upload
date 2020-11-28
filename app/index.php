<?php session_start(); ?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploadish!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <style>
        .container-centered {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container-upload-box {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="">
                <strong>Uploadish!</strong>
            </a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Home
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary">
                            <strong>Register</strong>
                        </a>
                        <a class="button is-light">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="mt-6 container container-centered">
        <h1 class="title">Uploadish!</h1>
        <h2 class="subtitle">Basically you can upload anything here.</h2>
        <?php
            if(isset($_SESSION['upload_status'])) {
                if($_SESSION['upload_status']) { ?>
                    <div class="notification is-success is-light">
                                <?php echo $_SESSION['upload_message'];?>
                    </div>
                <?php } else { ?>
                    <div class="notification is-danger is-light">
                                <?php echo $_SESSION['upload_message'];?>
                    </div>
                <?php }

                unset($_SESSION['upload_status']);
                unset($_SESSION['upload_message']);
            }
        ?>
        
        <form method="POST" action="./upload.php" enctype="multipart/form-data">
            <div class="mt-3 container-upload-box">
                <div class="file has-name is-right">
                    <label class="file-label">
                        <input class="file-input" type="file" id="file_select" name="file">
                        <span class="file-cta" id="file_select_btn">
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name" id="file_select_name">
                            None
                        </span>
                    </label>
                </div>

                <button action="submit" name="submit" class="ml-3 button"> <i class="fas fa-upload mr-3"></i> Upload</button>
            </div>
        </form>
    </div>

    <script>
        const __file_select = document.querySelector("#file_select");
        const __file_select_name = document.querySelector("#file_select_name");

        __file_select.onchange = function () {
            __file_select_name.innerText = __file_select.files.item(0).name
        }
    </script>
</body>

</html>
