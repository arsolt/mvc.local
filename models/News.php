<?php

class News
{
	/**
	 *
	 * возвращает одну новость по id
	 */
	public static function getNewsItemById($id)
	{
		$id = intval($id);
		
		// Запрос к БД
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM news WHERE id=' . $id);
		
		// по умолчанию fetch возвращает ассацивный и цифровой индекс поэтому нужно установить что требуется
		//$result->setFetchMode(PDO::FETCH_NUM);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$newsItem = $result->fetch();		
		
		return $newsItem;
	}
	
	/**
	 *
	 * возвращает массив новостей
	 */
	public static function getNewsList()
	{
		$db = Db::getConnection();
		
		$newsList = array();
		
		$result = $db->query('SELECT * FROM news ORDER BY date DESC LIMIT 5');
		// echo gettype ($result);	это объект			
		
/*  		$i = 0; 										// 1-й вариант
		while ($row = $result->fetch()){
			//echo 'test';
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$i++; 
		} */	
		$newsList = $result->fetchAll(PDO::FETCH_ASSOC); // 2-й вариант
		
		return $newsList;
	}

	public static function editNewsItemById($id)
	{
		$id = intval($id);

		// Запрос к БД
		$db = Db::getConnection();
		$result = $db->query("UPDATE news SET title=" . $_POST['title'] . ", content=". $_POST['content'] . "WHERE id=" . $id);

		// по умолчанию fetch возвращает ассацивный и цифровой индекс поэтому нужно установить что требуется
		//$result->setFetchMode(PDO::FETCH_NUM);
//		$result->setFetchMode(PDO::FETCH_ASSOC);
//		$newsItem = $result->fetch();

		return $newsItem;
	}
	
}