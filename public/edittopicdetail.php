<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="container well">
						<form action="http://127.0.0.1/MiAnswer/index.php/topics/editTopic" id="edit-topicform" enctype="multipart/form-data"  method="post">
							<input type="hidden" value="<?echo $topicinfo['Topic']['tid'];?>" name="tid">
							<input type="text" name="newtitle" class="form-control form-element" value="<?echo $topicinfo['Topic']['title'];?>"></input>
							<div style="height:600px" contentEditable="true" class="editable-div form-control form-element" id="newdetailedinfo">
								<?echo $topicinfo['Topic']['details']; ?>
							</div>
							<label for="newinputFile">选择图片</label>
							<input type="file" name="newimage" class="form-element"  id="newinputFile">
							<div class="control-group">
								<label class="control-label" for="tags">标签</label>
								<input type="text" name="newtags" class="form-control mywidth form-element" id="newtags" placeholder="用空格分开不同的标签">
							</div>
							<div class="control-group">
								<label class="control-label" for="scores">积分</label>
								<select class="form-control" id="newscores" name="newscores">
									<?$scores = $_SESSION['scores'] + $topicinfo['Topic']['scores'];?>
									<?for($i=1; $i<=$scores; $i++){?>
										<?if($i == $topicinfo['Topic']['scores']){?>
											<option selected="selected"><?=$i?></option>
										<?}else{?>
											<option><?=$i?></option>
										<?}?>
									<?}?>
								</select>
							</div>
							<input name="oldscores" value="<?echo $topicinfo['Topic']['scores'];?>" type="hidden"/>
							<button type="submit" class="btn btn-primary pull-right">确定</button>
						</form>
				</div>
			<?if($topicinfo['Topic']['active'] == 0){?>
				<?for($i = 0; $i < count($answers); $i++){?>
					<?if($answers[$i]['Answer']['accept'] == 0)
						continue;?>
					<div class="row">
						<div class="answer-wrap">
							<div class="votebar">
								<button 
									<?if(isset($likes)){?>
										<?for($j = 0; $j < count($likes); $j++){?>
											<?if($answers[$i]['Answer']['aid'] == $likes[$j]['Likerelation']['aid']){?>
												disabled="disabled"
											<?}?>
										<?}?>
									<?}?>
									<?if(isset($_SESSION['uid'])){?> onclick="like(this, <?=$answers[$i]['Answer']['aid']?>, <?=$topicinfo['Topic']['tid']?>)" <?}?>  class="btn 
										<?if(isset($likes)){?>
										<?for($j = 0; $j < count($likes); $j++){?>
											<?if($answers[$i]['Answer']['aid'] == $likes[$j]['Likerelation']['aid']){?>
												active
											<?}?>
										<?}?>
										<?}?>
									btn-primary uparrow">
									<span class="glyphicon glyphicon-chevron-up upicon"></span>
									<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
								</button>
								<button
									<?if(isset($dislikes)){?>
										<?for($j = 0; $j < count($dislikes); $j++){?>
											<?if($answers[$i]['Answer']['aid'] == $dislikes[$j]['Dislikerelation']['aid']){?>
												disabled="disabled"
											<?}?>
										<?}?>
									<?}?>
									<?if(isset($_SESSION['uid'])){?> onclick="dislike(this, <?=$answers[$i]['Answer']['aid']?>, <?=$topicinfo['Topic']['tid']?>)" <?}?>  class="btn 
										<?if(isset($dislikes)){?>
										<?for($j = 0; $j < count($dislikes); $j++){?>
											<?if($answers[$i]['Answer']['aid'] == $dislikes[$j]['Dislikerelation']['aid']){?>
												active
											<?}?>
										<?}?>
										<?}?>
									btn-primary downarrow">
									<span class="downcount"><?echo $answers[$i]['Answer']['dislikes'];?></span>
									<span class="glyphicon glyphicon-chevron-down downicon"></span>			
								</button>
							</div>
						
							<div class="answer-content">
								<div class="answer-head">
									<a class="answer-head" href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $answers[$i]['User']['uid'];?>"><?echo $answers[$i]['User']['uname'];?></a>
									<strong><?echo $answers[$i]['User']['description'];?></strong>
									<button class="btn btn-success pull-right active">被采纳</button>
								</div>
								<p><?echo $answers[$i]['Answer']['details'];?></p>
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
							<button 
								<?if(isset($likes)){?>
									<?for($j = 0; $j < count($likes); $j++){?>
										<?if($answers[$i]['Answer']['aid'] == $likes[$j]['Likerelation']['aid']){?>
											disabled="disabled"
										<?}?>
									<?}?>
								<?}?>
								<?if(isset($_SESSION['uid'])){?> onclick="like(this, <?=$answers[$i]['Answer']['aid']?>, <?=$topicinfo['Topic']['tid']?>)" <?}?>  class="btn
									<?if(isset($likes)){?>
									<?for($j = 0; $j < count($likes); $j++){?>
										<?if($answers[$i]['Answer']['aid'] == $likes[$j]['Likerelation']['aid']){?>
											active
										<?}?>
									<?}?>
									<?}?>	
								btn-primary uparrow">
								<span class="glyphicon glyphicon-chevron-up upicon"></span>
								<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
							</button>
							<button
								<?if(isset($dislikes)){?>
									<?for($j = 0; $j < count($dislikes); $j++){?>
										<?if($answers[$i]['Answer']['aid'] == $dislikes[$j]['Dislikerelation']['aid']){?>
											disabled="disabled"
										<?}?>
									<?}?>
								<?}?>
								<?if(isset($_SESSION['uid'])){?> onclick="dislike(this, <?=$answers[$i]['Answer']['aid']?>, <?=$topicinfo['Topic']['tid']?>)" <?}?>  class="btn 
									<?if(isset($dislikes)){?>
									<?for($j = 0; $j < count($dislikes); $j++){?>
										<?if($answers[$i]['Answer']['aid'] == $dislikes[$j]['Dislikerelation']['aid']){?>
											active
										<?}?>
									<?}?>
									<?}?>
								btn-primary downarrow">
								<span class="downcount"><?echo $answers[$i]['Answer']['dislikes'];?></span>
								<span class="glyphicon glyphicon-chevron-down downicon"></span>			
							</button>
						</div>
						
						<div class="answer-content">
							<div class="answer-head">
								<a class="answer-head" href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $answers[$i]['User']['uid'];?>"><?echo $answers[$i]['User']['uname'];?></a>
								<strong><?echo $answers[$i]['User']['description'];?></strong>
								<?if(($topicinfo['Topic']['active'] == 1) && isset($_SESSION['uid']) && ($_SESSION['uid'] == $topicinfo['Topic']['uid'])){?>
								<a href="http://127.0.0.1/MiAnswer/index.php/topics/acceptAnswer?tid=<?=$topicinfo['Topic']['tid']?>&aid=<?=$answers[$i]['Answer']['aid']?>"class="btn btn-primary pull-right">采纳</a>
								<?}?>

							</div>
							<p><?echo $answers[$i]['Answer']['details'];?></p>
							<?for($j = 0; $j < count($aimages); $j++){?>
							<?if($aimages[$j]['Answerimage']['aid'] != $answers[$i]['Answer']['aid'])
								continue;?>
							<img src="http://127.0.0.1/MiAnswer/public/img/<?echo $aimages[$j]['Image']['imagename'];?>"></img>
							<?}?>
							<span class="date-wrap"><?echo $answers[$i]['Answer']['time'];?></span>
						</div>
					</div>
				</div>
				<?}?>

			</div>

