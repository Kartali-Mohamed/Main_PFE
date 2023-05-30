<?php
$header = "Video | ".$title;
require('inc/header.php');
?>
<script>
console.log("Just for testing");
function getVote(int) {
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("poll").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","inc/vote.php?user="+<?php if(empty($usr_id))echo $ip; else echo $usr_id; ?>+"&vote="+int+"&vid="+<?php echo $id; ?>,true);
  xmlhttp.send();
}
</script>

<div class="video">
	<video controls name="media" poster="<?=$video['thumbnail_loca']?>">
		<source src="<?=$video['vid_loca']?>" type="video/mp4">
			Media Player Error.
	</video>
	<h3>
		<?=$title?>
			<?php if(@$_SESSION['id']==$uploader['vid'] || get_session('username') == "admin"):?>
				<form method="POST" class="btn-dlt">
					<input type="text" name="id" value="<?=$id?>" style="display:none;">
					<input type="submit" value="Supprimer cette vidéo" name="Vdel">
				</form>
			<?php endif;?>
	</h3>
	<span>
		Telechargé par
		<a href="profile.php?username=<?php echo $username; ?>"><b><?php echo $fullname; ?></b></a>
		en
		<b><?php echo $date; ?></b>

	</span>
	<div class="vote-sec">
		<form id="poll">

			<input type="button" value="UpVote" onclick="getVote(1)">
			<span><?php echo $like; ?></span>
			<input type="button" value="DownVote" onclick="getVote(0)">
			<span><?php echo $dislike; ?></span>

		</form>
	</div>
</div>


<div class="video">
	<b>Description</b>
	<p>
	<?php echo $description; ?>
	</p>
</div>

<div class="video">
	<b>Commentaires</b>
	<?php if(!loggedin()): ?>
			<center><h6>Veuillez vous connecter pour Commenter</h6></center>
	<?php elseif(empty($comments)): ?>
			<center><< Aucun Commentaire à afficher >></center>
	<?php else: ?>
			<?php foreach($comments as $k => $i): ?>
					<div class="comment">
						<b><a href="profile.php?username=<?=$i['fullname']?>"><?=$i['fullname']?></a></b> @ <?=$i['username']?><span class="separate"> | </span><i><?=$i['date']?></i>
						<?php if(@$_SESSION['id']==$i['id_owner'] || get_session('username') == "admin"):?>
							<form method="POST" class="btn-dlt">
								<input type="text" name="id" value="<?=$i['id']?>" style="display:none;">
								<input type="submit" class="btn-dlt" value="Supprimer ce commentaire" name="Cdel">
							</form>
						<?php endif; ?>
						<p><?=$i['content']?></p>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
</div>

<div class="video" style="<?php if(!loggedin()){ echo "display:none;";}?>">
	<b>Écrivez votre Commentaire</b>
	<form action="" method="POST">
		<textarea name="comment" cols="122" rows="5"></textarea>
		<input type="submit" value="comment">
	</form>
</div>
<?php require('inc/footer.php');?>
