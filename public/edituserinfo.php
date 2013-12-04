<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="well row">
					<h4><?echo $userinfo['User']['uname'];?></h4>
					<div class="row">
						<div class="col-md-2">
							<a href="#"><img class="pull-left" src="http://127.0.0.1/MiAnswer/public/img/<?echo $userinfo['User']['bigimage'];?>"></img></a>
						</div>
						<div class="col-md-10" style="padding:0px">
							<h4><?echo $userinfo['User']['uid'];?></h4>
							<input type="text" class="input-style form-control form-element" placeholder="<?echo $userinfo['User']['description'];?>"></input>
							<button class="btn btn-primary">确定</button>
						</div>
					</div>
				</div>

				<div class="well row">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#questions" data-toggle="tab">提问</a></li>
					    <li><a href="#answers" data-toggle="tab">回答</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
					    <div class="tab-pane active" id="questions">
							<?for($i = 0; $i < count($topics); $i++){?>
							<div id="t<?=$topics[$i]['Topic']['tid']?>" class="row editable-element">
							<h3 style="display:inline"><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $topics[$i]['Topic']['tid'];?>"><?echo $topics[$i]['Topic']['title']?></a></h3>
							<button type="button"  onclick="deleteTopic(<?=$topics[$i]['Topic']['tid']?>)" class="close pull-right" aria-hidden="true">&times;</button>
							</div>
							<?}?>
						</div>
						<div class="tab-pane" id="answers">
							<?for($i = 0; $i < count($answers); $i++){?>
							<div id="a<?=$answers[$i]['Answer']['aid']?>" class="row editable-element">
							<h3 style="display:inline"><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $answers[$i]['Topic']['tid'] ?>"><?echo $answers[$i]['Topic']['title'];?></a></h3>
							<button type="button" onclick="deleteAnswer(<?=$answers[$i]['Answer']['aid']?>)" class="close pull-right" aria-hidden="true">&times;</button>
							<p><?echo $answers[$i]['Answer']['details']?></p>
							</div>
							<?}?>
						</div>
					</div>
				</div>
			</div>
