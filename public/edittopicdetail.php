<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="container well">
						<div>
							<?for($i = 0; $i < count($tags); $i++){?>
							<button type="button" class="btn btn-primary btn-sm" disabled="disabled"><?echo $tags[$i]['Tag']['tname'];?></button>
							<?}?>
						</div>
						<input type="text" class="form-control form-element" placeholder="<?echo $topicinfo['Topic']['title'];?>"></input>
						<div style="height:600px" contentEditable="true" class="editable-div form-control form-element">
							<?echo $topicinfo['Topic']['details']; ?>
							<?for($i = 0; $i < count($images); $i++){?>
								<img src="http://127.0.0.1/MiAnswer/public/img/<?echo $images[$i]['Topicimage']['imagename'];?>"></img>
							<?}?>
						</div>
						<button class="btn btn-primary pull-right">确定</button>
				</div>
				<?if($topicinfo['Topic']['active'] == 0){?>
				<?for($i = 0; $i < count($answers); $i++){?>
					<?if($answers[$i]['Answer']['accept'] == 0)
						continue;?>
					<div class="row">
						<div class="answer-wrap">
							<div class="votebar">
								<button class="btn btn-primary uparrow">
									<span class="glyphicon glyphicon-chevron-up upicon"></span>
									<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
								</button>
								<button class="btn btn-primary downarrow">
									<span class="downcount"><?echo $answers[$i]['Answer']['dislikes'];?></span>
									<span class="glyphicon glyphicon-chevron-down downicon"></span>			
								</button>
							</div>
						
							<div class="answer-content">
								<div class="answer-head">
									<a class="answer-head" ref="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $answers[$i]['User']['uid'];?>"><?echo $answers[$i]['User']['uname'];?></a>
									<strong><?echo $answers[$i]['User']['description'];?></strong>
									<button class="btn btn-success pull-right active">被采纳</button>
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
				<?}?>

				<?for($i = 0; $i < count($answers); $i++){?>
				<?if($answers[$i]['Answer']['accept'] == 1)
					continue;?>
				<div class="row">
					<div class="answer-wrap">
						<div class="votebar">
							<button  class="btn btn-primary uparrow">
								<span class="glyphicon glyphicon-chevron-up upicon"></span>
								<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
							</button>
							<button class="btn btn-primary downarrow">
								<span class="downcount"><?echo $answers[$i]['Answer']['dislikes'];?></span>
								<span class="glyphicon glyphicon-chevron-down downicon"></span>			
							</button>
						</div>
						
						<div class="answer-content">
							<div class="answer-head">
								<a class="answer-head" ref="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $answers[$i]['User']['uid'];?>"><?echo $answers[$i]['User']['uname'];?></a>
								<strong><?echo $answers[$i]['User']['description'];?></strong>
								<?if(($topicinfo['Topic']['active'] == 1) && isset($_SESSION['uid']) && ($_SESSION['uid'] == $topicinfo['Topic']['uid'])){?>
								<button class="btn btn-primary pull-right">采纳</button>
								<?}?>

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
				<?if(($topicinfo['Topic']['active'] == 1) && isset($_SESSION['uid'])){?>
				<div class="row">
					<div class="post-content">
						<div class="answer-head">
							<a href="#"><?=$_SESSION['uname']?></a>
							<strong><?=$_SESSION['description']?></strong>
							<form action="../index.php/users/register" method="post" class="form-inline">
								<div id="post-area" style="height:300px" contentEditable="true" class="editable-div form-control form-element"></div>
								<div class="pull-right">
									<label for="inputFile">选择图片</label>
									<input type="file" class="form-element" id="inputFile">
								</div>
								<button class="btn btn-primary post-btn" type="submit">发布</button>
							</form>
						</div>
					</div>
				</div>
				<?}?>
			</div>

