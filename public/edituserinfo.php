<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<div class="well row">
				
					<form action="http://127.0.0.1/MiAnswer/index.php/users/editPersonalInfo" id="edit-userform" enctype="multipart/form-data"  method="post">
						<div class="col-md-2">
							<div id="thumbnail">
								<img class="pull-left img-rounded" style="margin-bottom:20px" src="http://127.0.0.1/MiAnswer/public/img/<?echo $userinfo['User']['bigimage'];?>"></img>
							</div>
							<label for="newinputFile">上传头像</label>
							<input type="file" name="userimage" class="form-element"  id="inputUserImage">

						</div>
						<div class="col-md-10">
							<input type="hidden" id="uid" value="<?echo $userinfo['User']['uid'];?>" name="uid"/>
							<div class="control-group">
								<label class="control-label" for="uname">昵称</label>
								<input type="text" id="uname" name="uname" class="form-control form-element" value="<?echo $userinfo['User']['uname'];?>"/>
							</div>
							<div class="control-group">
								<label class="control-label" for="description">个人描述</label>
								<input type="text" name="description" id="description"  class="form-control form-element" value="<?echo $userinfo['User']['description'];?>"></input>
							</div>
							<button type="submit" class="btn btn-primary pull-right">确定</button>
						</div>
					</form>
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
