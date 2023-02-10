<?php
require "./Database/Database.php";
class Model extends Database
{
    protected mysqli|bool $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function all($table): array
    {
        $sql = "SELECT * FROM ${table}";
        $query = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }
    public function find($table,$id): array
    {
        $id = (int)$id;
        if($id)
        {
            $sql = "SELECT * FROM ${table} WHERE id = ${id} LIMIT 1";
            $query = $this->query($sql);
            return mysqli_fetch_assoc($query);
        }
        else
        {
            return [];
        }

    }
    public function delete($table,$id): bool|array|null
    {
        $id = (int)$id;
        $sql = "DELETE FROM ${table} WHERE id = ${id}";
        return $this->query($sql);
    }
    public function store($table, array $data =[]): array|bool
    {
        $columns = implode(',',array_keys($data));
        $values = array_map(function($value) {
           return "'" . $value ."'";
        }, array_values($data));

        $values = implode(',',$values);
        $sql = "INSERT INTO ${table}(${columns}) VALUES (${values})";
        if($this->query($sql)) {
            $getNewRecordString = "SELECT * FROM ${table} ORDER BY id DESC LIMIT 1";
            $query = $this->query($getNewRecordString);
            return mysqli_fetch_assoc($query);
        };
        return false;
    }
    public function update($table ,$data, $id): mysqli_result|bool
    {

        $dataUpdate = [];
        foreach ($data as $key => $value) {
            $dataUpdate[] = "${key} = '" . $value . "'";
        }

        $inSql = implode(',', $dataUpdate);
        $sql = "UPDATE $table SET $inSql WHERE id = $id";
        return $this->query($sql);
    }

    private function query($sql): mysqli_result|bool
    {
        return mysqli_query(
            $this->connect,
            $sql
        );
    }
}