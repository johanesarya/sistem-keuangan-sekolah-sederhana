<?php
// Start the session
session_start();

	include 'conn.php';
	
    if(isset($_POST['submit'])){
        $user = mysqli_real_escape_string($conn,$_POST['user']);
        $pass = md5(mysqli_real_escape_string($conn,$_POST['pass']));
        $sql = "SELECT * FROM tbl_user WHERE username ='$user' AND password = '$pass'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0)
        {   
            $row = mysqli_fetch_array($query);
            // echo "<pre>";
            //     var_dump($row);
            // echo "</pre>";
            // echo $row["id"];
            // die();

            $_SESSION["user"] = $_POST['user'];
			$_SESSION["pass"] = $_POST['pass'];
            $_SESSION["jenjang"] = $row['jenjang'];
            echo "<script>alert('ANDA BERHASIL MASUK')</script>";
            echo "<script>window.location='index.php';</script>";        
            // header("location: index.php");
        }
        else
        {
            echo "<script language='javascript'>";
            echo "alert('USERNAME ATAU PASS SALAH, COBA LAGI')"; 
            echo "</script>";
        }

    }




?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    div.a {
        text-align: center;
        font-size: 14px;
        padding-top: 10px;
    }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Input Username dan Password</h1>
                                    </div>
                                    <form class="user" method="POST" action="#">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="user" name="user" placeholder="Masukkan username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="pass" name="pass" placeholder="Masukkan password...">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                                                Log In
                                            </button>
                                        <div class="a">
                                            <a href="signup.php">Sign Up
                                        </div>
                                        <hr>
                                    </form>	
                                    <!-- <div class="text-center">
                                        <a class="small" href="gateway.php">KEMBALI KE LAMAN SEBELUMNYA</a>
                                    </div> -->        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>

</html>


