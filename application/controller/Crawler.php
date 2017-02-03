<?php
namespace app\controller;
use xiaogouxo\phpfetcher\Crawler\CrawlerDefault;

class Crawler extends CrawlerDefault
{
	public function handlePage($page)
	{
		$title = $page->sel('//title');
		$link = $page->sel('//textarea[@id=magnetLink]');
		echo $this->head();
		for ($i=0; $i < count($link); ++$i) {
			echo '<div class="panel panel-default"><div class="panel-heading">';
			echo $title[$i]->plaintext;
			echo '</div><div class="panel-body">';
			echo '<textarea style="width:100%;">'.$link[$i]->plaintext.'</textarea>';
			echo '</div></div>';
		}
		echo $this->p();
		echo $this->footer();
	}

	public function head()
	{
		return '<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>SOSO</title>
				<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
				<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
				<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>
				<div class="container">';
	}

	public function p()
	{
		$page_str = '<div class="btn-group" role="group" aria-label="...">';
		$page_str .= '<a type="button" class="btn btn-default">Left</a>';
		$page_str .= '<a type="button" class="btn btn-default">Right</a></div>';
		return $page_str;
	}

	public function footer()
	{
		return '</div>
					</body>
				</html>';
	}
}
