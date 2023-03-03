<?php
namespace AlexExtraCore\App\Helper;

/**
*helper functions are here
 */

class Helper {

	private static $instance;

	public function __construct (){


	}

	public static function cloneFolderWithFiles($source, $target) {
		if (is_dir($source))  {
			@mkdir($target);
			$d = dir($source);
			while (FALSE !== ($entry = $d->read())) {
				if ($entry == '.' || $entry == '..') continue;
				$Entry = $source . '/' . $entry;
				if (is_dir($Entry)) full_copy($Entry, $target . '/' . $entry);
				else copy($Entry, $target . '/' . $entry);
			}
			$d->close();
		}
		else copy($source, $target);
	}

	public static function removeDirWithFiles($dir) {
		if ($objs = glob($dir.'/*')) {
        foreach($objs as $obj) {
         is_dir($obj) ? removeDirWithFiles($obj) : unlink($obj);
              }
             }
        rmdir($dir);
        }

	public static function  issetCheckFormSecurity(){
		if( empty($_POST) || !isset($_POST[AlexExtraCoreNonceName])
		    || empty($_POST[AlexExtraCoreNonceName]) ){
			return false;
		}
		if(!wp_verify_nonce(  $_POST[ AlexExtraCoreNonceName ] , AlexExtraCoreNonceAction)){
			Helper::addAdminNotice('error');
			return false;
		}
		return true;
	}

	public static function  getAlexExtraCoreOptions($notice_type='success' ){
		$result  = get_option( AlexExtraCorePluginOptionName );
		if( is_serialized( $result ) ) {
			$result = unserialize($result);
		}
		return $result;

	}

	public static function  updateAlexExtraCoreOptions($options ){
		$result = false ;

		$options = maybe_serialize($options);

		$result = update_option(AlexExtraCorePluginOptionName ,   $options );

		return $result;

	}


	public static function doStringFromArray($array){
		$string = json_encode($array);
		return base64_encode($string)  ;
	}
	public static function doArrayFromString($string) {
		$fields  = base64_decode($string);
		return  json_decode($fields);
	}


    // input form id or form slug // output array of field with sanitise data and value;
    public static function getFormDataBy($form_id){
	    $fields = [];
	    $result = [];
	    $fields_raw = alex_extra_core_get_settings()[$form_id]['fields'] ;

	    foreach($fields_raw as $key => $field){
		    $fields[] = [$key , $field['type']];
	    }

	    foreach($fields as $field){
		    $name = $field[0];
		    $type = $field[1];
		    $value = '';

		    if($type ==='text' || $type ==='tel'   ||  $type === 'textarea' ) {
			    $value = esc_html( $_POST[ $name ] );
		    }elseif($type ==='email'){
			    $value = sanitize_email( $_POST[ $name ] );
		    }elseif($type ==='checkbox' && isset($_POST[$name] ) ){
			    $value =  intval(esc_html($_POST[$name]));
		    }else{
		        $value = false;
            }

		    $result[] = ['name'=>$name , 'type'=>$type  , 'value'=> $value ] ;

	    }

	    return $result;
    }

    public static function validateFormPhoneNumber($str){
	    // Корректные номера
//	    $correctNumbers = [
//		    '84951234567',
//		    '+74951234567',
//		    '8-495-1-234-567',
//		    ' 8 (8122) 56-56-56',
//		    '8-911-1234567',
//		    '8 (911) 12 345 67',
//		    '8-911 12 345 67',
//		    '8 (911) - 123 - 45 - 67',
//		    '+ 7 999 123 4567',
//		    '8 ( 999 ) 1234567',
//		    '8 999 123 4567'
//	    ];


		    $patt = '~' .
		            '^(?:\+7|8)\d{10}$|' . '^(?:7|8)\d{10}$|' .
		            '^8[\s-]\d{3}-\d(?:-\d{3})+$|' .
		            '^\s?8\s?\(\d{4}\)\s?\d{2}(?:-\d{2}){2}$|' .
		            '^8-\d{3}-\d{7}$|' . '^7-\d{3}-\d{7}$|' .
		            '^8\s?\(\d{3}\)\s?\d{2}\s?\d{3}\s?\d{2}$|' . '^7\s?\(\d{3}\)\s?\d{2}\s?\d{3}\s?\d{2}$|'  .
		            '^8-\d{3}\s?\d{2}\s?\d{3}\s?\d{2}$|' .
		            '^8\s?\(\d{3}\)\s?-\s?\d{3}(?:\s?-\s?\d{2}){2}$|' .
		            '^\+\s?7(?:\s?\d{3}){2}\s?\d{4}$|' .
		            '^8\s?\(\s?\d{3}\s?\)\s?\d{7}$|' .
		            '^8(?:\s?\d{3}){2}\s?\d{4}$' .
		            '~';
		    return preg_match($patt, $str);
    }

	public static function validateFormUserName($str){
		$patt = '/' . '^[a-zA-Zа-яА-Я]{4,40}$' . '/ui';
		return preg_match($patt, $str);
	}

	public static function  addAdminNotice($notice_type='success' ){
		if('success' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php  esc_attr_e('Настройки обновлены!' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}elseif('error' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php  esc_attr_e('Неизвестная ошибка!' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}elseif('warning' === $notice_type){
			add_action( 'admin_notices', function ( ){
				?>
				<div class="notice notice-warning  is-dismissible">
					<p><?php  esc_attr_e('Проверьте заполнение полей. Url обязательные поле' , 'alex-theme');   ?></p>
				</div>
				<?php
			} );
		}

	}


	public static function write($filename , $data){
		// Запись.
		$dataSerialize = serialize($data);      // PHP формат сохраняемого значения.
		//$data = json_encode($bookshelf);  // JSON формат сохраняемого значения.
		file_put_contents($filename, $dataSerialize);
	}
	//writeData($filename , $result);


	public static function read($filename){
		// Чтение.
		$data = file_get_contents($filename);
		//$bookshelf = json_decode($data, TRUE); // Если нет TRUE то получает объект, а не массив.
		return unserialize($data);
	}


	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return static::$instance;
	}
}