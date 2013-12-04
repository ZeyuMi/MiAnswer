	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div id="topiccontent" class="container well">
						<div>
							<?for($i = 0; $i < count($tags); $i++){?>
							<button type="button" class="btn btn-primary btn-sm" disabled="disabled"><?echo $tags[$i]['Tag']['tname'];?></button>
							<?}?>
						</div>
						<h3><?echo $topicinfo['Topic']['title'];?></h3>
						<p><?echo $topicinfo['Topic']['details']; ?></p>
						<?if(isset($_SESSION['uid']) && $userinfo['User']['uid'] == $_SESSION['uid']){?>
						<a href="http://127.0.0.1/MiAnswer/index.php/topics/beforeEdit?tid=<?echo $topicinfo['Topic']['tid']?>" class="pull-right btn btn-danger">修改</a>
						<?}?>
				</div>
			<?if($topicinfo['Topic']['active'] == 0){?>
				<?for($i = 0; $i < count($answers); $i++){?>
					<?if($answers[$i]['Answer']['accept'] == 0)
						continue;?>
					<div class="row">
						<div class="answer-wrap">
							<div class="votebar">
								<button <?if(isset($_SESSION['uid'])) echo "onclick=\"like('<?=$answers[$i]['Answer']['aid']?>')\""; ?> class="btn btn-primary uparrow">
									<span class="glyphicon glyphicon-chevron-up upicon"></span>
									<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
								</button>
								<button <?if(isset($_SESSION['uid'])) echo "onclick=\"dislike('<?=$answers[$i]['Answer']['aid']?>')\""; ?> class="btn btn-primary downarrow">
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
							<button <?if(isset($_SESSION['uid'])) echo "onclick=\"like('<?=$answers[$i]['Answer']['aid']?>')\""; ?> class="btn btn-primary uparrow">
								<span class="glyphicon glyphicon-chevron-up upicon"></span>
								<span class="upcount"><?echo $answers[$i]['Answer']['likes'];?></span>
							</button>
							<button <?if(isset($_SESSION['uid'])) echo "onclick=\"dislike('<?=$answers[$i]['Answer']['aid']?>')\""; ?> class="btn btn-primary downarrow">
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


				

				<?if(isset($_SESSION['uid'])){?>
				<div class="row">
					<div class="post-content">
					<div class="answer-head">
					<a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?=$_SESSION['uid']?>"><?=$_SESSION['uname']?></a>
					<strong><?=$_SESSION['description']?></strong>
					<form action="http://127.0.0.1/MiAnswer/index.php/answers/postAnswer" id="answerform" enctype="multipart/form-data"  method="post">

							<input type="hidden" value="<?echo $topicinfo['Topic']['tid'];?>" name="tid">
							<div style="height:300px" contentEditable="true" class="editable-div form-control form-element" id="answerdetail">
							</div>
							<label for="answerinputFile">选择图片</label>
							<input type="file" name="answerimage" class="form-element"  id="answerinputFile">
							<button type="submit" class="btn btn-primary pull-right">确定</button>
					</form>
					</div>
					</div>
				</div>
				<?}?>
			</div>

