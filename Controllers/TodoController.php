<?php

class TodoController extends Controller
{
    private Todo $todo;
    public function __construct()
    {
        $this->loadModel('Todo');
        $this->todo = new Todo;
    }

    public function index()
    {
        $title = 'TodoList';
        $works = [
            [
                'id' => 1,
                'name' => 1,
                'content' => 1,
                'status' => 1,
                'date' => 1,
            ],
            [
                'id' => 2,
                'name' => 2,
                'content' => 2,
                'status' => 2,
                'date' => 2,
            ],
        ];
        return $this->view('User.index', [
            'title' => $title,
            'works' => $works,
        ]);
    }

    public function create()
    {
        echo __METHOD__;
    }

    public function store()
    {
        echo __METHOD__;
    }

    public function detail()
    {
        echo __METHOD__;
    }

    public function delete()
    {
        echo __METHOD__;
    }
}