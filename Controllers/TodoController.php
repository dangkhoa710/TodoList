<?php

class TodoController extends Controller
{
    private Todo $todo;
    private Status $status;
    public function __construct()
    {
        $this->loadModel('Todo');
        $this->todo = new Todo;

        $this->loadModel('Status');
        $this->status = new Status;
    }

    public function index()
    {
        $title = 'TodoList';
        $works = $this->todo->getAll();
        $status = $this->status->getAll();
        return $this->view('User.index', [
            'title' => $title,
            'works' => $works,
            'status' => $status,
        ]);
    }


    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'date' => date('Y-m-d'),
            'content' => $_POST['content-add'],
            'id_status' => 1,
            'created_at' => date('Y-m-d H:i:s', time())
        ];
        header('Content-Type: application/json');
        $data = $this->todo->storeRecord($data);
        if( $data == [] )
        {
            echo json_encode([
                'status' => 500,
                'data' => null
            ]);
        }
        echo json_encode([
            'status' => 201,
            'data' => $data
        ]);


    }

    public function detail()
    {
        $data = $this->todo->detailRecord($_GET['id']);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function delete()
    {
        $data = [
            'deleted_at' => date('Y-m-d H:i:s', time())
        ];
        header('Content-Type: application/json');
        if($this->todo->deleteRecord($data, $_GET['id']) !== true) {
            echo json_encode([
                'status' => 500,
                'data' => null
            ]);
        }
        echo json_encode([
            'status' => 200,
            'data' => null
        ]);

    }
    public function update()
    {
        $data = [
            'name' => $_POST['name-update'],
            'date' => $_POST['datepicker-update'],
            'content' => $_POST['content-update'],
            'id_status' => $_POST['status-update'],
            'updated_at' => date('Y-m-d H:i:s', time())
        ];
        header('Content-Type: application/json');
        if($this->todo->updateRecord($data, $_GET['id']) !== true )
        {
            echo json_encode([
                'status' => 500,
                'data' => null
            ]);
        }
        echo json_encode([
            'status' => 201,
            'data' => $data
        ]);
    }

    public function done()
    {
        $data = [
            'id_status' => $_GET['id_status'],
            'updated_at' => date('Y-m-d H:i:s', time())
        ];
        header('Content-Type: application/json');
        if($this->todo->updateRecord($data, $_GET['id']) !== true )
        {
            echo json_encode([
                'status' => 500,
                'data' => null
            ]);
        }
        echo json_encode([
            'status' => 201,
            'data' => $data
        ]);
    }
}