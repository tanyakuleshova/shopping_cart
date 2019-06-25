<?php
class View{
    protected $data;
    protected $path;

    public function __construct($data = array(), $path = null){

        $this->path = $path;
        $this->data = $data;
    }
    public function render(){
        $data = $this->data;
        ob_start();
        include($this->path);
        $content = ob_get_clean();
        return $content;
    }
}