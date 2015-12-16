<?php 
include_once("path/to/config.inc.php"); 

$conn = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(isset($_GET['add_user'])) {


    $sql_usernamecheck = "SELECT * FROM members WHERE name='".$_GET['name']."'";
    $resultCheck = mysqli_query($conn, $sql_usernamecheck);
    $num_rowsU = mysqli_num_rows($resultCheck);
   

      if ($num_rowsU != 0)
      {
        
                echo '<script language="javascript">';
                echo 'alert("Username already exists, try again.");';
                echo 'window.location = "register.php";';
                echo '</script>';
      }
      else
      {
                $hashedPW = hash('md5', $_GET['password']);

            //een variable die een query uitvoert.                Deze zoekt de input die word gemaakt in de form
            $query = "INSERT INTO members (name, full_name, birthdate, email, password) VALUES ('".$_GET['name']."', '".$_GET['full_name']."', '".$_GET['birthdate']."', '".$_GET['email']."', '".$hashedPW."')";
            //Basis iets om een variable in de database te krijgen ($query = de variable die ik heb aangemaakt voor de insert)
            mysqli_query($conn , $query );
                echo '<script language="javascript">';
                echo 'alert("Account successfully created!");';
                echo 'window.location = "main_login.php";';
                echo '</script>';
      }
}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket Logs
            <?php  echo $VERSION ; ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>L</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Ticket Logs </b><?php  echo $VERSION; ?></span>
                </a>


            </header>
            <!-- Left side column. contains the logo and sidebar -->


            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                <!-- Small boxes (Stat box) -->

                <br />
                <br />
                <br />
                <br />
                <br />

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-info box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-fw fa-edit"></i> Create account for Ticket Logs</h3>
                            </div>
                            <div class="box-body">


                                <table class="table table-striped">
                                    <form action="" method="get">
                                        <tr>
                                            <td><b><label for="naam">(Inlog) Name:</label></b></td>
                                            <td><b><input class="form-control" type="text" name="name" required="" /></b></td>
                                        </tr>
                                        <tr>
                                            <td><b><label for="fname">Full Name:</label></b></td>
                                            <td><b><input class="form-control" type="text" name="full_name" required="" /></b></td>
                                        </tr>
                                        <tr>
                                            <td><b><label for="date">Birthdate:</label></b></td>
                                            <td><b><input class="form-control" type="date" id="datepicker" name="birthdate" required="" /></b></td>
                                        </tr>
                                        <tr>
                                            <td><b><label for="starttime">Email Adress:</label></b></td>
                                            <td><b><input class="form-control" type="email" name="email" required="" placeholder="Example@example.com"></b></td>
                                        </tr>
                                        <tr>
                                            <td><b><label for="password">Password:</label></b></td>
                                            <td><b><input class="form-control" type="password" name="password" required="" placeholder="*****"></b></td>
                                        </tr>
                                        <tr>
                                            <td><b><label for="complete">Complete:</label></b></td>
                                            <td><b><input class="btn btn-primary" type="submit" name="add_user" value="Sign in" ></b></td>
                                        </tr>


                                    </form>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>



            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->

            <?php include('views/footer.php'); ?>
            
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED JS SCRIPTS -->

            <!-- jQuery 2.1.4 -->
            <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
            <!-- Bootstrap 3.3.5 -->
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/app.min.js"></script>

            <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
    </body>

    </html>