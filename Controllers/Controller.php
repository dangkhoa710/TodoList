<?php

class Controller
{
    const VIEW_FOLDER_NAME = 'Views';
    public function index()
    {
       return $this->view('welcome');
    }

    public function view($viewPath, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $viewPath = self::VIEW_FOLDER_NAME .'/'. str_replace('.','/',$viewPath) .'.php';
        require ($viewPath);
    }
}