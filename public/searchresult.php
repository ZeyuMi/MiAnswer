<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="well row">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#questions" data-toggle="tab">提问</a></li>
					    <li><a href="#answers" data-toggle="tab">回答</a></li>
						<li><a href="#tags" data-toggle="tab">标签</a></li>
						<li><a href="#users" data-toggle="tab">用户</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
					    <div class="tab-pane active" id="questions">
							<?for($i = 0; $i < count($searchtopics); $i++){?>
								<h3 id="t<?=$searchtopics[$i]['Topic']['tid']?>"><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $searchtopics[$i]['Topic']['tid'];?>"><?echo $searchtopics[$i]['Topic']['title']?></a></h3>
							<?}?>
						</div>
						<div class="tab-pane" id="answers">
							<?for($i = 0; $i < count($searchanswers); $i++){?>
								<h3 id="a<?=$searchanswers[$i]['Answer']['aid']?>"><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $searchanswers[$i]['Topic']['tid'] ?>"><?echo $searchanswers[$i]['Topic']['title'];?></a></h3>
								<p><?echo $searchanswers[$i]['Answer']['details']?></p>
							<?}?>
						</div>
						<div class="tab-pane" id="tags">
							<?for($i = 0; $i < count($searchtags); $i++){?>
								<?if(($i % 3) == 0) echo "<div class=\"row\">";?>
								<div class="col-md-4">
									<a href="http://127.0.01/MiAnswer/index.php/tags/show?tagid=<?echo $searchtags[$i]['Tag']['tagid']?>" class="btn btn-primary"><?echo $searchtags[$i]['Tag']['tname'];?></a>
									<h5>被引用<?=$searchtags[$i]['Tag']['num']?>次</h5>
								</div>
								<?if(($i % 3) == 2) echo '</div>';?>
							<?}?>
							<?if(($i % 3) != 0) echo '</div>';?>
						</div>
						<div class="tab-pane" id="users">
							<?for($i = 0; $i < count($searchusers); $i++){?>
								<h3 id="a<?=$searchusers[$i]['User']['uid']?>"><a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $searchusers[$i]['User']['uid'] ?>"><?echo $searchusers[$i]['User']['uname'];?></a></h3>
							<?}?>
						</div>
					</div>
				</div>
			</div>

