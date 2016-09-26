<?php

/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router
{

    /**
     * Свойство для хранения массива роутов
     * @var array 
     */
    private $routes; // это массив в котором будут храниться маршруты из файла routes.php

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Путь к файлу с роутами-маршрутами
        $routesPath = ROOT . '/config/routes.php'; //путь к маршрутам

        // Получаем роуты из файла
        $this->routes = include($routesPath); //загрузка маршрутов
		//print_r($this->routes); // проверяем загрузку
    }

    /**
     * Возвращает строку запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
			// trim - Удаляет пробелы (или другие символы в нашем случае '/') из начала и конца строки
			// '/news/arhive' -> 'news/arhive'
        }
    }

    /**
     * Метод для обработки запроса
     */
    public function run() // метод принимает управление от фронтконтроллера
    {
        // Получаем строку запроса
        $uri = $this->getURI();
		//echo $uri; //это то что стоит после mvc.local/, mvc.local/news/22 -> news/22
		//$uri = news/sport/114 - строка запроса
		
        // Проверяем наличие такого запроса в массиве маршрутов (routes.php скопировали в $this->routes в конструктере)
		// 'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2'
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
			// $uriPattern = 'news/([a-z]+)/([0-9]+)'
			// $uri = news/sport/114
			if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу.
				// $path = 'news/view/$1/$2'
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				// $internalRoute будет равно = news/view/sport/114
				
                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);
				// explode - Разбивает строку с помощью разделителя, Возвращает массив строк

                $controllerName = array_shift($segments) . 'Controller';
				// array_shift - получает значение первого элемента в массиве и удаляет его из массива
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;
				
				/*в параметрах останется массив из 2-х значений
				$parameters = Array(
					[0] => sport
					[1] => 114) */

                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;

                /* Вызываем необходимый метод ($actionName) у определенного 
                 * класса ($controllerObject) с заданными ($parameters) параметрами
                 */
				 // вариант 1
				 // $result = $controllerObject->$actionName($parameters);
				 // вариант2
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				// в этом случае массив $parameters будет передан в метод как переменные

                // Если метод контроллера успешно вызван, завершаем работу роутера
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
