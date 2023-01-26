<?php
namespace AlexExtraCore\App\RestApi;


/**
 * вывод мета нужен планин и включение через хук - смотрите предидущию версую
* этого решения ( пример: плагин acf to rest api  и хук включения этой настроки)
 */
class RestApi{

	private static $instance;

    public function __construct(){

       $this->restApi();
    }

    private function restApi(){


    }

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}

		return static::$instance;

	}


}
