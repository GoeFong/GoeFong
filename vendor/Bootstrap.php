<?php 
/**
* 
*/
class Bootstrap
{

	function UrlProcess(){
        if( isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
	}
	function __construct()
	{
		// $url = isset($_GET['url']) ? $_GET['url'] : null;
		// $url = rtrim($url,'/');
		// $url = filter_var($url, FILTER_SANITIZE_URL);
		// $url = explode('/',$url);
		$url = $this->UrlProcess();
		if(empty($url[0])){
			require_once 'controllers/IndexController.php';
			$object_controller = new IndexController();
			$object_controller->index();
			return false;
		} else {
			$controller = ucfirst($url[0])."Controller";
			$ctrlerPath = "";
			// print_r ($url[0]);
			if(file_exists("controllers/".$controller.".php")){
				$ctrlerPath = "controllers/".$controller.".php";
			} else {
				$ctrlerPath = "";
			}
			
			if($ctrlerPath != ""){
				require_once $ctrlerPath;
				$object_controller = new $controller;
				
				if(empty($url[1])){
					$object_controller->index();
				} else {
					if(method_exists($controller, $url[1])){
						$classMethod = new ReflectionMethod($controller,$url[1]);
						$argumentCount = count($classMethod->getParameters());
						$argsArr = array();
						for($i=2;$i<=$argumentCount+1;$i++){
							if(isset($url[$i])){
								$argsArr[] = $url[$i];
							}/* else {
								echo "Thieu tham so";
								return 0;
							}*/
						}	
						$args = implode(",",$argsArr);
						$args = rtrim($args);
						// print_r ($args);
						if(isset($url[$argumentCount+2])){
							echo "du tham so";
							return 0;
						}
						$object_controller->{$url[1]}($args);
					} else {
						// echo "ERR 404: Request not found!";
						print_r ("empty($url[1])");
						return false;
					}
				}
			} else {
				echo "ERR 404: Request not found!";
				// print_r ($args);
				return false;
			}

			
		}
	}
}

?>