<?
class PgNews
{
	public $title;
	public $description;
	public $keywords;
	public $miniimg;
	public function __construct() {
		$result = mysql_query("SELECT * FROM settings WHERE page='news'");
		$myrow = mysql_fetch_array($result);
		$this->title = $myrow['title'];
		$this->description = $myrow['description'];
		$this->keywords = $myrow['keywords'];
		$this->miniimg = $myrow['miniimg'];
	}
	public function PrintListNews($start_id, $amoung) {
		global $URL_SITE;
		$result = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT $start_id,$amoung");
		$myrow = mysql_fetch_array($result);
		do 
		{	 
		printf ("
		<div style=\"border-bottom:1px solid #999; height:130px; padding-top:20px; padding-bottom:20px;\">
		<img class='line1' src='%snews/image/stories/%s'><h4><a class='anews' href='%snews/id-%s'>%s</a></h4>
		<p style=\"margin:0px; padding:0px; font-size:11px; color:#666;\">
		Дата: %s.   
		Автор:<a href=\"%sprofile/user-%s\">%s</a>.</p>
		%s<br>
		<a class=\"readon\" href=\"%snews/id-%s\">Читать далее</a>
		</div>",$URL_SITE, $myrow['miniimg'], $URL_SITE, $myrow['id'], $myrow['title'], $myrow['date'], $URL_SITE, $myrow['author'], $myrow['author'], $myrow['description'], $URL_SITE, $myrow['id']);
		}
		while ($myrow = mysql_fetch_array($result));
	}
	
	public function PrintNew($id) {
		global $URL_SITE;
		$result = mysql_query("SELECT * FROM news WHERE id='$id'");
		$myrow = mysql_fetch_array($result);
		printf ("
		<table class='viewnews'>
  		<tr>
    		<td><h2><a href='%snews/id-%s'>%s</a></h2></td>
  		</tr>
  		<tr>
    		<td><div class='data_and_author'>Дата: %s.   Автор: %s.</div>
				<table>
					<tr>
						<td>
						<div id='vk_like'></div>
						<script type='text/javascript'>
						VK.Widgets.Like(\"vk_like\", {type: \"mini\", height: 24});
						</script>
						</td>
						<td>
						<g:plusone></g:plusone>
						</td>
						<td>
						<div class='fb-like' data-send='false' data-layout='button_count' data-width='120' data-show-faces='true'
						data-font='verdana'></div>
						</td>
						<td>
						<a href='https://twitter.com/share' class='twitter-share-button' data-lang='ru'>Твитнуть</a>
						<script>!function(d,s,id) {var js,fjs=d.getElementsByTagName(s)[0]; if(!d.getElementById(id))
						{js=d.createElement(s); js.id=id; js.src=\"//platform.twitter.com/widgets.js\";
						fjs.parentNode.insertBefore(js,fjs);}} (document,\"script\",\"twitter-wjs\"); </script>
						</td>
					</tr>
				</table>
			</td>
  		</tr>
  		<td><a href=\"%snews/image/stories/%s\" rel=\"lightbox\" title=\"%s\"><img src=\"%snews/image/stories/%s\" class='imgviewnews' ></a><div class='vstyplenie'>%s</div><br><div class='osnovnoe'>%s</div>
		</td>
  	</tr>
  </tr>
</table>",$URL_SITE ,$myrow['id'],$myrow['title'],$myrow['date'],$myrow['author'],$URL_SITE ,$myrow['img'],$myrow['title'],$URL_SITE ,$myrow['img'],nl2br($myrow['description']),nl2br($myrow['text']));
	}
};
?>