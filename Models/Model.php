<?php
require "./Database/Database.php";

class Model extends Database
{
    protected mysqli|bool $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function all($table, $conditions = [], $joins = []): array
    {
        $sql_condition = [];
        $sql_join = [];
        $inSql = null;
        $sql_select = [];
        $inSql_select = null;
        if ($joins) {
            foreach ($joins as $join) {
                $sql_join[] = " " . $join['connect'] . " " . $join['table'] . " ON " . $table . "." . $join['condition_1'] . "=" . $join['table'] . "." . $join['condition_2'];
                foreach ($join['select'] as $select) {
                    $sql_select[] = $join['table'].".".$select;
                }
            }
            $inSql = implode(' ', $sql_join);
            $inSql_select = ",".implode(',', $sql_select);
        }
        if ($conditions) {
            foreach ($conditions as $key => $condition) {
                $sql_condition[] = $table . "." . $key . " " . $condition;
            }
            $inSql .= " WHERE " . implode(' AND ', $sql_condition);
        }
        $sql = "SELECT ${table}.*".$inSql_select." FROM ${table}" . $inSql;
        $query = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }

    public function find($table, $id, $joins = []): array
    {
        $id = (int)$id;
        if ($id) {
            $sql = "SELECT * FROM ${table} WHERE id = ${id} LIMIT 1";
            $query = $this->query($sql);
            return mysqli_fetch_assoc($query);
        } else {
            return [];
        }

    }

    public function delete($table, $data, $id): mysqli_result|bool
    {
        return $this->update($table, $data, $id);
    }

    public function store($table, array $data = []): array|bool
    {
        $columns = implode(',', array_keys($data));
        $values = array_map(function ($value) {
            return "'" . $value . "'";
        }, array_values($data));

        $values = implode(',', $values);
        $sql = "INSERT INTO ${table}(${columns}) VALUES (${values})";
        if ($this->query($sql)) {
            $getNewRecordString = "SELECT * FROM ${table} ORDER BY id DESC LIMIT 1";
            $query = $this->query($getNewRecordString);
            return mysqli_fetch_assoc($query);
        };
        return false;
    }

    public function update($table, $data, $id): mysqli_result|bool
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