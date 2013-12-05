	<div class="container">		
		<div class="row">
			<div class="col-md-9" id="topiclist">
				<?for($i = 0; $i < count($topics); $i++){ ?>
				<div class="row topic-element"> 
					<div class="col-md-2">
						<a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $topics[$i]['User']['uid'];?>"><img class="pull-right img-rounded" src="http://127.0.0.1/MiAnswer/public/img/<?echo $topics[$i]['User']['smallimage']?>"></img></a>
					</div>
					<div class="col-md-10">
						<div class="row">
							<span class="date-wrap pull-right"><?echo gettime($topics[$i]['Topic']['time']);?></span>
							<h4><a href="http://127.0.0.1/mianswer/index.php/topics/show?tid=<?echo $topics[$i]['Topic']['tid'];?>"><?echo $topics[$i]['Topic']['title']; ?></a></h4>
						</div>
						<div class="row">
							<span><?=$topics[$i]['Topic']['details']?></span>
						</div>
					</div>
				</div>
				<?}?>
				<?if(count($topics) == 10){?>
					<button id="loadmore" class="loadmore btn btn-default btn-block">更多</button>
				<?}?>
			</div>
