<div class="main_content">
    <h2 class="main_title">Complete tour top<img id="logo100" src="images/top100logo.png"></h2>

    <?php

    
    		$day = date("d");
		
		 while ($song = mysqli_fetch_array($result_songs)) {
			
             $maxItems = 4;
             $endSelect = 100 - ($day * $maxItems);
             
			if ($song['id'] > $endSelect){
				 $top100item = 
                    "<div class='song'>
                        <a href='?page=detail&song_id=".$song['id']."' class='link'>
                            <div class='num passed'>".$song['id']."</div>
                            <p class='song_title'>".$song['artist']." - ".$song['title']."</p>
                        </a>
                    </div>";
			} else {
				$top100item = 
                    "<div class='song'>
                        <a href='?page=detail&song_id".$song['id']."' class='link'>
                            <div class='num'>".$song['id']."</div>
                            <p class='song_title'>".$song['artist']." - ".$song['title']."</p>
                        </a>
                    </div>";
			}
		
			echo $top100item;
		}

    
    ?>

</div>