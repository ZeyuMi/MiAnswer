	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="row well tag">
						<button class="btn btn-primary"><?echo $taginfo['Tag']['tname'];?></button>
						<h5>233322次</h5>
						<p><?echo $taginfo['Tag']['description'];?></p>
				</div>
				<?for($i = 0; $i < count($topics); $i++){?>
				<div class="row">
					<div class="col-md-2">
						<a href="#"><img class="pull-right" src="http://127.0.0.1/MiAnswer/public/img/<?echo $topics[$i]['User']['smallimage'];?>"></img></a>
					</div>
					<div class="col-md-10">
						<div class="row">
							<h5 class="pull-right"><?echo gettime($topics[$i]['Topic']['time']);?></h5>
							<h4><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $topics[$i]['Topic']['tid'];?>"><?echo $topics[$i]['Topic']['title'];?></a></h4>
						</div>
						<div class="row">
							<p><span class="glyphicon glyphicon-comment"></span>12个回答</p>
						</div>
					</div>
				</div>
				<?}?>
			</div>
