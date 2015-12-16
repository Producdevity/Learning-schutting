<div class="main_content">
<h2 class="main_title">In de Radio 1 Tour Top 100<a href="index.php"><img class="today_arrow" src="images/today_arrow.png"></a></h2>

    <?php
    
     if($detail['id'] >= 2){
            echo "
            <div class='previous_song_title'>
                  <img class='left_arrow' src='images/left_arrow.png'>
                  <div class='clear'></div>
                  <p class='detail_num'>".$song_back['id']."</p>
                  <a class='sub_title' href='index.php?page=detail&song_id=".$song_back['id']."'><p>".$song_back['title']."</p></a>
            </div>";
     } else {
         echo "<div class='previous_song_title'></div>";
     }

        echo "
       <div class='detail_container'>
    		<div class='detail_ranking_number'>".$detail['id']."</div>
    		<div class='article_detail_title'>".$detail['artist']." - ".$detail['title']."</div>
    		<div class='clear'></div>
		</div>";  
    
        if($detail['id'] < 100){
            echo "
            <div class='next_song_title'>
                <img class='right_arrow' src='images/right_arrow.png'>
                <div class='clear'></div>
                <p class='detail_num'>".$song_next['id']."</p>
                <a class='sub_title' href='index.php?page=detail&song_id=".$song_next['id']."'><p>".$song_next['title']."</p></a>
		    </div>";
        }
    

    ?>
        


		
		<div class="clear"></div>

		<div class="detail_video"><iframe src="" frameborder="0" allowfullscreen></iframe></div>
        
        <?php
    
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    
        
        
        echo 
        "<p class='detail_description'>".$description."</p>
		<img src='images/mail_icon.png' class='social_media' />
		<img src='images/twitter_icon.png' class='social_media' />
		<img src='images/facebook_icon.png' class='social_media' />
		<h2 class='main_title'>Reageer op dit bericht</h2>
        
        <form method='POST' action='logic/comment.php'>
    	    <input type='hidden' name='song_id' value='".$detail['id']."'>";

    ?>
        	<h6>Naam</h6>
        	<input type="text" name="naam" value="">
        	<div class="clear"></div>
        
        	<h6 id="email">E-mail</h6> <p id="hide">(wordt niet getoond)</p>
        	<div class="clear"></div>
        	<input type="text" name="email" value="">
    
        	<h6>Website</h6>
        	<input type="text" name="website" value="">
        
        	<h6>Reactie</h6>
        	<textarea name="reactie"></textarea>
        	<div class="checkbox">
        		<div class="check">
        				<input type="checkbox" name="rememberData">
        				<h6 class="check_text">Gegevens onthouden</h6>
        				<input id="send" type="submit" value="" name="comment">
        		</div>
        		<div class="check">
        				<input type="checkbox">
        				<h6 class="check_text">Mail me bij nieuwe reacties</h6>
        		</div>
        	</div>
        </form>
<h2 class="main_title_sub" id="comments_section">Reacties op dit bericht [ <?php echo "$num_rowsC \n";?>]<img class="title_comment_icon" src="images/title_comments_icon.png"></h2>
<?php 
        while($comment = mysqli_fetch_array($result_comments)){
            echo "
            <div class='comment'>
				<p class='name'>".$comment['name']."</p>
				<p class='date'>".$comment['date']."</p>
				<p class='reactie'>".$comment['comment']."</p>
				<a class='alert' href='#'>
					<img class='alert_icon' src='images/alert.png'>
					<h6>Waarschuw de redactie over deze</h6>
				</a>
			</div>";
        }
?>

	</div>