<?php
class Router
{
    protected $_controller,
              $_action,
              $_view,
              $_params,
              $_route;
          
    public function __construct($_route) {

        $this->_route = $_route;
        $this->_controller = 'index';
        $this->_params = array(); 
        $this->_view = false; 
    }
	
	private function parseRoute() {

        if (isset($this->_route)) {

            $url_array = array(); 
            $url_array = explode('/', trim($this->_route));

            array_filter($url_array);
            array_shift($url_array);

            $this->_controller = isset($url_array[0]) && $url_array[0] !== "" ? $url_array[0] : $this->_controller;
            array_shift($url_array);

            $this->_action = isset($url_array[0]) ? $url_array[0] : 'index';

            array_shift($url_array);

            $query_string = $url_array;

        }

        // gets the request method

        $method = $_SERVER["REQUEST_METHOD"];   
     
        // // assign params by methods  
        switch($method) {

            case "GET": 

                unset($_GET['_route']);

                $this->_params = array_merge($query_string, $_GET);   

            break;
            case "POST": 
            case "PUT":  
            case "DELETE": 
            {
               
                if(!array_key_exists('HTTP_X_FILE_NAME', $_SERVER))
                {
                    if($method == "POST") {
                        $this->_params = array_merge($this->_params, $_POST); 
                    } else {           
                        // temp params 
                        $p = array();
                        // the request payload
                        $content = file_get_contents("php://input");
                        // parse the content string to check we have [data] field or not
                        parse_str($content, $p);
                        // if we have data field
                        $p = json_decode($content, true);
                        // merge the data to existing params
                        $this->_params = array_merge($this->_params, $p);
                    }   
                }          

            }

            break;         
                   
        }

		// if(!empty($id)){		 
  //           $this->_params['id']=$id;
		// }

  //       if(!empty($keyword)){         
  //           $this->_params['keyword'] = $keyword;
  //       }

  //       if($this->_controller == 'index'){
  //           $this->_params = array($this->_params);
  //       }  					
	}
    
    public function dispatch() {

   		$this->parseRoute();

      $this->_action = MyHelpers::camelCase($this->_action);
      $this->_controller = MyHelpers::camelCase($this->_controller);

      $controllerName = $this->_controller;

      $model = $this->_controller.'Model';

      $model = class_exists($model) ? $model : 'Model';

      $this->_controller .= 'Controller';

      $this->_controller = MyHelpers::camelCase($this->_controller);

      $this->_controller = class_exists($this->_controller) ? $this->_controller : 'Controller';

      $dispatch = new $this->_controller($model, $controllerName, $this->_action);

      $hasActionFunction = (int)method_exists($this->_controller, $this->_action);
      
      $c = new ReflectionClass($this->_controller);

		  $m = $hasActionFunction ? $this->_action : 'defaultAction';

      $f = $c->getMethod($m);
      $p = $f->getParameters(); 
      $params_new = array();
      $params_old = $this->_params;
      // re-map the parameters
      for($i = 0; $i<count($p);$i++){
          $key = $p[$i]->getName();
          if(array_key_exists($key, $params_old)){
              $params_new[$i] = $params_old[$key];
              unset($params_old[$key]);
          }
      }
        
        $params_new = array_merge($params_new, $params_old);

        $this->_view = call_user_func_array(array($dispatch, $m), $params_new);	

        // finally, we print it out
        if($this->_view){
           echo $this->_view;
        }
    }
}