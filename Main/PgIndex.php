<?
include_once("news/PgNews.php");
include_once("links/PgLinks.php");
class PgIndex
{
	public $title;
	public $description;
	public $keywords;
	public $miniimg;
	public function __construct() {
		$result = mysql_query("SELECT * FROM settings WHERE page='main'");
		$myrow = mysql_fetch_array($result);
		$this->title = $myrow['title'];
		$this->description = $myrow['description'];
		$this->keywords = $myrow['keywords'];
		$this->miniimg = $myrow['miniimg'];
	}
	public function GetContent() {
		printf("
		<script type=\"text/javascript\">
		function news_links(new_tab, new_content) {

        document.getElementById('article').style.display = 'none';
        document.getElementById('links').style.display = 'none';
        document.getElementById(new_content).style.display = 'block';   

        document.getElementById('li_1').className = 'link_passive';
        document.getElementById('li_2').className = 'link_passive';
        document.getElementById(new_tab).className = 'link_active';          
		}
		</script>

		<div class=\"main_block\">
    		<ul class=\"link_block\">
    			<li id=\"li_1\" style=\"margin-right:30px;\" class=\"link_active\">
					<a href=\"javascript:news_links('li_1', 'article');\">Новости сайта</a>
				</li>
        		<li id=\"li_2\" class=\"link_passive\">
					<a href=\"javascript:news_links('li_2', 'links');\">Ссылки</a>
				</li>
    		</ul>
		<div id=\"article\">");
		$page = new PgNews();
		$page->PrintListNews(0,7); 
		printf("</div>
		<div id=\"links\" style=\"display:none;\">");
		$page = new PgLinks();
 		$page->PrintListLinks(0,7); 
		printf("
			</div>
			</div>");
	}
};
?>