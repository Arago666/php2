<?php

namespace app\controllers;

use app\engine\Render;
use app\interfaces\IRenderer;
use app\model\Basket;

abstract class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = true;
    protected $renderer;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function runAction($action = null){
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        }else{
            Die("Action не существует");
        }
    }

    public function render($template, $params = []){
        if($this->useLayout){
            return $this->renderTemplate("layouts/{$this->layout}",[
//                'menu' => $this->renderTemplate('menu',$params),
                'menu' => $this->renderTemplate('menu',[
                    'count' => Basket::getCountWhere('session_id', 1)
                ]),
                'content' => $this->renderTemplate($template,$params)
            ]);
            //TODO session id 'count' => Basket::getCountWhere('session_id', session_id())
        }else{
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []){
        return $this->renderer->renderTemplate($template, $params);
    }
}