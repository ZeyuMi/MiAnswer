	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<?for($i = 0; $i < count($tags); $i++){?>
					<?if(($i % 3) == 0) echo "<div class=\"row\">";?>
					<div class="col-md-4">
						<a href="http://127.0.01/MiAnswer/index.php/tags/show?tagid=<?echo $tags[$i]['Tag']['tagid']?>" class="btn btn-primary"><?echo $tags[$i]['Tag']['tname'];?></a>
						<h5>被引用<?=$tags[$i]['Tag']['num']?>次</h5>
						<p><?echo $tags[$i]['Tag']['description'];?></p>
					</div>
					<?if(($i % 3) == 2) echo '</div>';?>
				<?}?>
				<?if(($i % 3) != 0) echo '</div>';?>
			</div>
