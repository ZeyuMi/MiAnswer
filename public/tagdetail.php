	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="row well tag">
						<button class="btn btn-primary"><?echo $taginfo['Tag']['tname'];?></button>
						<h5>233322次</h5>
						<p><?echo $taginfo['Tag']['description'];?></p>
				</div>
				<?for($i = 0; $i < count($topics); $i++){?>
				<div class="row topic-element">
					<div class="col-md-2">
						<a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $topics[$i]['User']['uid'];?>"><img class="pull-right img-rounded" src="http://127.0.0.1/MiAnswer/public/img/<?echo $topics[$i]['User']['smallimage']?>"></img></a>
					</div>
					<div class="col-md-10">
						<div class="row">
							<span class="date-wrap pull-right"><?echo gettime($topics[$i]['Topic']['time']);?></span>
							<h4><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $topics[$i]['Topic']['tid'];?>"><?echo $topics[$i]['Topic']['title']; ?></a></h4>
						</div>
						<div class="row">
							<span><?=$topics[$i]['Topic']['details']?></span>
						</div>
					</div>
				</div>
				<?}?>
			</div>
