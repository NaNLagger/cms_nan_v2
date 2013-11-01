<?
class PgLinks
{
	public $title;
	public $description;
	public $keywords;
	public $miniimg;
	public function __construct() {
		$result = mysql_query("SELECT * FROM settings WHERE page='links'");
		$myrow = mysql_fetch_array($result);
		$this->title = $myrow['title'];
		$this->description = $myrow['description'];
		$this->keywords = $myrow['keywords'];
		$this->miniimg = $myrow['miniimg'];
	}
	public function PrintListLinks($start_id, $amoung) {
		global $URL_SITE;
		$result = mysql_query("SELECT * FROM 3party ORDER BY id DESC LIMIT $start_id,$amoung");
		$myrow = mysql_fetch_array($result);
		do 
		{	 
		printf ("
		<div style=\"border-bottom:1px solid #999; height:130px; padding-top:20px; padding-bottom:20px;\">
		<img class='line1' src='%slinks/image/%s'>
		<a class='anews' href='%s'>%s</a><p style=\"margin:0px; padding:0px; font-size:11px; color:#666;\">Дата: %s.   
		Автор: <a href=\"%sprofile/user-%s\">%s</a>.</p>%s
		</div>",$URL_SITE, $myrow['img'], $myrow['url'], $myrow['title'], $myrow['date'], $URL_SITE, $myrow['author'], $myrow['author'], $myrow['description']);
		}
		while ($myrow = mysql_fetch_array($result));
	}
};
?>