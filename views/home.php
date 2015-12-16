<div class="main_content">

	<h2 class="main_title">Vandaag in de Radio 1 Tour Top 100</h2>
    
    <?php
    
    $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...";
    
     while ($song = mysqli_fetch_array($result_songs)) {
         
         $resultC = mysqli_query($conn, "SELECT * FROM comments WHERE song_id=".$song['id']);
         $num_rowsC = mysqli_num_rows($resultC);

        echo 
        "<article class='articles_container'>
			<div class='today_article_thumbnail'><img src=''><div class='play_video'></div></div>
			<div class='today_article_ranking_number'>".$song['id']."</div>
			<div class='article_title'>".$song['artist']." - ".$song['title']." ...</div><p class='description'>".$description."</p>
            <footer class='article_footer'>
            [ ".$num_rowsC." ] | <a href='index.php?page=detail&song_id=".$song['id']."'>Lees meer &raquo;</a>
                <img src='images/mail_icon.png' class='social_media' />
                <img src='images/twitter_icon.png' class='social_media' />
                <img src='images/facebook_icon.png' class='social_media' />
            </footer>
			<div class='clear'></div>
		</article>";
         
         
     }

    ?>
    
		
</div>

