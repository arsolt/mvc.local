<?php
include_once ROOT . '/models/News.php';

class NewsController
{
	public function actionIndex()
	{
		//echo 'Список новостей';
		$newsList = array();
		$newsList = News::getNewsList();
		
/* 		echo '<pre>';
		print_r($newsList);
		echo '</pre>'; */
		require_once(ROOT.'/views/news/index.php'); 
				
		return true;
	}
	
	public function actionView($id)
	{
		echo 'Просмотр одной новости ' , $id , '<br>';
				
		if($id){
			$newsItem = News::getNewsItemById($id);
			
/* 			echo '<pre>';
			print_r($newsItem);
			echo '</pre>'; */
			require_once(ROOT.'/views/news/view.php'); 			
		}
		
		return true;		
	}
	
	public function actionView2($category, $id)
	{
		echo 'Просмотр одной новости' . '<br>';
		echo $category . '<br>';
		echo $id;
		
		return true;		
	}

	public function actionEdit($id)
	{
//		echo 'Редактирование одной новости ' , $id , '<br>';
		if(!empty($_POST)){
			return header("Location: /");
		}

		if($id){
			$newsItem = News::getNewsItemById($id);

/*			 			echo '<pre>';
                        print_r($newsItem);
                        echo '</pre>';*/
			require_once(ROOT.'/views/news/edit.php');
		}

		return true;
	}
	
}