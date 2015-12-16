
<?php


    include_once("path/to/config.inc.php"); 


    include("views/header.html"); 
    include("views/content.php"); 
    
    $page = isset($_GET['page'])?$_GET['page']:'home';   

    switch($page){
        case 'home':
            require("logic/select_songs.php");
            include("views/home.php");
        break;
        case 'detail':
            require("logic/select_detail_nav.php");
            require("logic/select_song_detail.php");
            require("logic/select_comments.php");
            include("views/detail.php");
        break;
        case 'top100':
            require("logic/select_top100.php");
            include("views/top100.php");
        break;
        case 'testimonials':
            $search_result = isset($_POST['search_string'])?$_POST['search_string']:'';
            $pageNr = isset($_GET['page_nr'])?$_GET['page_nr']:1;
            $templateParser->assign('pageNr',$pageNr);
            require 'logic/search_newsarticles.php';
            $templateParser->assign('result',$result);
            $templateParser->display('nav.tpl');
            $templateParser->display('search_result.tpl');
        break;
        case 'prijsvraag':

        break;
        default:
            include("views/home.php");
        break;
    }

    
    include("views/sidebar.html");
    include("views/footer.html");
    
?>
    