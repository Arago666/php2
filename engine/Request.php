<?php


namespace app\engine;


class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $params = [];
    protected $method;

    /**
     * Request constructor.
     * @param $requestString
     */
    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest (){
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);

        //TODO когда уберу public из пути поменять на $url[1] и $url[2]
        $this->controllerName = $url[2];
        $this->actionName = $url[3];
        //get
        $this->params = $_REQUEST;
        $data = json_decode(file_get_contents('php://input'));
        if(!is_null($data)){
            foreach ($data as $key => $value){
                $this->params[$key] = $value;
            }
        }

    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }


}