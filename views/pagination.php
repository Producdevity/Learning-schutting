		<?php 

        $day_click = isset($_GET['days'])?$_GET['days']:date("d"); 

		$day = date("d");
		
		for ($i = 1; $i < 25; $i ++) {
			
			if ($i == $day || $i == $day_click){
				$pagDay = "	<a href='index.php?days=".$i."'>
								<li class='days on'>".$i."</li>
							</a>";
			} else if ($i < $day){
				$pagDay = "	<a href='index.php?days=".$i."'>
								<li class='days grey'>".$i."</li>
							</a>";
			} else {
				$pagDay = "<li class='days'>".$i."</li>";
			}
		
			echo $pagDay;
		}
		
		?>