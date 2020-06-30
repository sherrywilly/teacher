<?php
session_start();
//login.php

include('config.php');

if (isset($_SESSION["teacher_id"])) {
    header('location:dashboard.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">

    <style type="text/css" media="screen">
        /* * {
            box-sizing: border-box;
        }

        #formhead {
            color: white;
            display: flex;
            justify-content: center;
        }

        #logo {
            font-family: serif;
            font-size: 5vh;
            text-align: auto;
            font-weight: 700;
            color: white;
        } */


        @media screen and (min-width: 760px) {
            #navbarNav {
                justify-content: flex-end;
            }

            ul li {
                margin: 2px 10px 2px 0;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark primary-color">
        <a class="navbar-brand" href="#" id="logo">Attendance management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">login <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">home</a>
                </li>
            </ul>
        </div>
    </nav>
    <span id="message"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4" style="margin-top:20px;">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div id="formhead" style="color: white"> Teacher Login</div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="teacher_login_form" autocomplete="off">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control" required />
                                <span id="erremail" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="teacher_password" id="teacher_password" class="form-control" required />
                                <span id="errpas" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="teacher_login" id="teacher_login" class="btn btn-info" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#teacher_login_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "login_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('#teacher_login').val('Validate...');
                        $('#teacher_login').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        if (data.success) {
                            location.href = "dashboard.php";
                        }
                        if (data.error) {
                            $('#teacher_login').val('Login');
                            $('#teacher_login').attr('disabled', false);
                            if (data.erremail != '') {
                                $('#erremail').text(data.erremail);
                            } else {
                                $('#erremail').text('');
                            }
                            if (data.errpas != '') {
                                $('#errpas').text(data.errpas);
                            } else {
                                $('#errpas').text('');
                            }
                        }

                    }
                })
            });
        });
    </script>

</body>

</html>