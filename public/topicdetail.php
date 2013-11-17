	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="container well">
						<div>
							<?for($i = 0; $i < count($tags); $i++){?>
							<button type="button" class="btn btn-primary btn-sm" disabled="disabled"><?echo $tags[$i]['Tag']['tname'];?></button>
							<?}?>
						</div>
						<h3><?echo $topicinfo['Topic']['title'];?></h3>
						<p><?echo $topicinfo['Topic']['details']; ?></p>
						<?for($i = 0; $i < count($images); $i++){?>
						<img src="http://127.0.0.1/MiAnswer/public/img/<?echo $images[$i]['Topicimage']['imagename'];?>"></img>
						<?}?>
				</div>
				<?for($i = 0; $i < count($answers); $i++){?>
				<div class="row">
					<div class="answer-wrap">
						<div class="votebar">
							<button  class="uparrow">
								<span class="glyphicon glyphicon-chevron-up upicon"></span>
								<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
							</button>
							<button class="downarrow">
								<span class="downcount"><?echo $answers[$i]['Answer']['dislikes'];?></span>
								<span class="glyphicon glyphicon-chevron-down downicon"></span>								</button>
						</div>
						
						<div class="answer-content">
							<div class="answer-head">
								<a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $answers[$i]['User']['uid'];?>"><?echo $answers[$i]['User']['uname'];?></a>
								<strong><?echo $answers[$i]['User']['description'];?></strong>
							</div>
							<p><?echo $answers[$i]['Answer']['details'];?></p>
							<?for($j = 0; $j < count($aimages); $j++){?>
							<?if($aimages[$j]['Answerimage']['aid'] != $answers[$i]['Answer']['aid'])
								continue;?>
							<img src="http://127.0.0.1/MiAnswer/public/img/<?echo $aimages[$j]['Answerimage']['imagename'];?>"></img>
							<?}?>
							<span class="date-wrap"><?echo $answers[$i]['Answer']['time'];?></span>
						</div>
					</div>
				</div>
				<?}?>

				<div class="row">
					<div class="post-content">
						<div class="answer-head">
							<a href="#">糜泽羽</a>
							<strong>，南京大学软件学院学生。</strong>
							<form action="../index.php/users/register" method="post" class="form-inline">
								<textarea id="post-area" class="form-control mywidth form-element" style="height:200px"></textarea>
								<label id="anonymous"class="checkbox">
									<input type="checkbox" value="remember-me"> 匿名
								</label>
								<button class="btn btn-primary post-btn" type="submit">发布</button>
							</form>
						</div>
					</div>
				</div>
			</div>

