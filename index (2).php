<?php 
include_once("path/to/config.inc.php"); 


$conn = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

session_start();
//die($_SESSION['myusername']);
if(!isset($_SESSION["myusername"]) ){
header("location:main_login.php");
}

$sql_select_user = "SELECT * FROM members WHERE name="."'".$_SESSION['myusername']."'"; 
    $member_result = mysqli_query($conn, $sql_select_user);
    $member = mysqli_fetch_array($member_result);


$weekNumber = date("W");

$sql_rq = "SELECT * FROM timetable WHERE rq=1 ORDER BY date"; 
$result_rq = mysqli_query($conn, $sql_rq);

$sql_days = "SELECT * FROM timetable WHERE (worker_id=".$_SESSION['user_id']." AND rq=0) OR (rq_id=".$_SESSION['user_id']." AND worker_id!=".$_SESSION['user_id'].") ORDER BY week"; 

$result_days = mysqli_query($conn, $sql_days);

$userid = $_SESSION['user_id'];


if(isset($_GET['solved'])) {
    
    if($userid == $_GET['requester']){
            echo '<script language="javascript">';
            echo 'alert("You can not complete your own request!");';
            echo 'window.location = "index.php";';
            echo '</script>';
        } else {

            $_SESSION['user_tickets'] = $_SESSION['user_tickets'] +1;

            $sql_plusticket = "UPDATE members SET tickets=".$_SESSION['user_tickets']." WHERE id=".$userid;
            mysqli_query($conn, $sql_plusticket);

            $sql_update_timetable = "UPDATE timetable SET rq_id=".$userid.",rq=0 WHERE id=".$_GET['solved'];
            mysqli_query($conn , $sql_update_timetable );

            echo '<script language="javascript">';
            echo 'alert("You earned a TICKET!");';
            echo 'window.location = "index.php";';
            echo '</script>';      
        }
}


if(isset($_GET['request'])) {
    
    $conn = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);
	

    if ($_SESSION['user_tickets'] == 0){
        echo '<script language="javascript">';
        echo 'alert("You have no more tickets!");';
        echo 'window.location = "index.php";';
        echo '</script>';
    }else{
    
    $_SESSION['user_tickets'] = $_SESSION['user_tickets'] - 1;
    
    $sql_plusticket = "UPDATE members SET tickets=".$_SESSION['user_tickets']."  WHERE id=".$_SESSION['user_id'];
    mysqli_query($conn, $sql_plusticket);
        
    $sql_rq = "UPDATE timetable SET rq=1, rq_id=0 WHERE worker_id=".$_SESSION['user_id']." AND id=".$_GET['rq_date_id'];
    mysqli_query($conn, $sql_rq);
    
        echo '<script language="javascript">';
        echo 'alert("Your request is completed!");';
        echo 'window.location = "index.php";';
        echo '</script>';
        
    
}
}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ticket Logs <?php  echo $VERSION; ?></title>
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

      <!-- Main Header include -->
      
    <?php include('views/header.php'); ?>
     
    
    <!-- Left side column include. contains the logo and sidebar -->
      
      <?php include('views/nav.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <!-- Your Page Content Here -->
        <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php
                      $sql_countR = "SELECT * FROM timetable WHERE rq=1";
                      $resultR = mysqli_query($conn, $sql_countR);
                      $num_rowsR = mysqli_num_rows($resultR);

                      echo "$num_rowsR \n";
                       ?></h3>
                  <p>Open Requests</p>
                </div>
                <div class="icon">
                  <i style="font-size: 80px" class="fa fa-comments fa-5xfa fa-comments fa-5x"></i>
                </div>
                  <?php 
                    if ($_SESSION['user_admin'] == 1){
                        echo "<a href='admin_logs.php' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>";
                    }else{
                        echo "<a href='#' class='small-box-footer'> <i class='fa fa-arrow-circle-right'></i></a>";
                    }
                ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php 
                        echo $_SESSION['user_tickets'];    
                      ?></h3>
                  <p>Available Tickets</p>
                </div>
                <div class="icon">
                  <i style="font-size: 80px" class="glyphicon glyphicon-credit-card fa-4x"></i>
                </div>
                <?php 
                    if ($_SESSION['user_admin'] == 1){
                        echo "<a href='#' class='small-box-footer'> <i class='fa fa-arrow-circle-right'></i></a>";
                    }else{
                        echo "<a href='#' class='small-box-footer'> <i class='fa fa-arrow-circle-right'></i></a>";
                    }
                ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
                    <?php
                        $sql_countM = "SELECT * FROM members";
                        $resultM = mysqli_query($conn, $sql_countM);
                        $num_rowsM = mysqli_num_rows($resultM);

                        echo "$num_rowsM \n";
                    ?>
                    </h3>
                  <p>The Staff</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <?php 
                    if ($_SESSION['user_admin'] == 1){
                        echo "<a href='admin_staff.php' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>";
                    }else{
                        echo "<a href='profile.php' class='small-box-footer'> <i class='fa fa-arrow-circle-right'></i></a>";
                    }
                ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php
                      $sql_countR = "SELECT * FROM timetable WHERE rq_id=".$_SESSION['user_id'];
                      $resultR = mysqli_query($conn, $sql_countR);
                      $num_rowsR = mysqli_num_rows($resultR);

                      echo "$num_rowsR \n";
                       ?></h3>
                  <p>My Logs</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="mylogs.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
            
            <!-- open requests -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
             

              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Open Requests</h3>
                </div>
                  
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  
                    <?php 


                        while ($requests = mysqli_fetch_array($result_rq)) {
                            $sql_select_user = "SELECT * FROM members WHERE id="."'".$requests['worker_id']."'"; 
                            $member_result = mysqli_query($conn, $sql_select_user);
                            $member = mysqli_fetch_array($member_result);

                           echo "
                           <div class='item'>
                    <img src='dist/img/user4-128x128.jpg' alt='user image' class='online'>
                    <p class='message'>
                      <a href='#' class='name'>
                        <small class='text-muted pull-right'> ".$requests['date']."  <i class='fa fa-clock-o'></i> ".$requests['time']." - ".$requests['end_time']."</small>
                        ".$member['full_name']."
                      </a>
                      
                    </p>
                    <div class='attachment'>
                      <h4>Available Function(s):</h4>
                      
                      <p class='filename'>
                        ".$requests['function']."
                      </p>
                      
                      <div class='pull-right'>
                      ".'<a href="index.php?solved='.$requests['id']."&requester=".$member['id'].'">
                        <button class="btn btn-primary btn-sm btn-flat">WORK & EARN</button>
                      </a>'."    
                      </div>
                    </div><!-- /.attachment -->
                  </div>";
                           
                           
                            
                        }
                        
                        
                        ?>
                    
                    
                    
                  
                </div><!-- /.chat -->
                
              </div>
            
              </section>
            </div>
            
            
            <div class="row">
                <div class="col-lg-12">
              <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Request</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="get">
                    <select name="rq_date_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php 
                            while ($day = mysqli_fetch_array($result_days)) {   
                                //2015-W04-3
                                $dayno = array('monday'=>'1', 'tuesday'=>'2', 'wednesday'=>'3', 
                                               'thursday'=>'4', 'friday'=>'5', 'saturday'=>'6', 'sunday'=>'7');
                                $cday = $dayno[$day['day']];
                                $weekno = $day['week'];
                                
                                if($weekno < 10) {
                                    $W0 = "0"; 
                                }else{
                                    $W0 = "";
                                }
                                
                                $yr = $day['year'];
                                $dt = $yr."-W".$W0.$weekno."-".$cday;
                                $date =  date('d-m-Y',strtotime( $dt));
                                
                                //$strtotime = "2015-W0".$day['week']."-".$day['day'];
                                //$date = date( "d-m-Y", strtotime('2015-W01-3'));
                                echo "<option value='".$day['id']."'>".$day['day']." - Week ".$day['week']." - ".$date."</option>";
                            }
                        ?>
                    </select>   
                   
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <input class="btn btn-sm btn-info btn-flat pull-left" type="submit" name="request" value="Request!"/>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View My Logs</a>
                </div><!-- /.box-footer -->
              </div>            
             </form>
                </div>
            </div>
            
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      
    <?php include('views/footer.php'); ?>
     
    </div><!-- ./wrapper -->

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
