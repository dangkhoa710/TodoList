<?php

class Todo extends Model
{
    const TABLE = 'work';

    public function getAll()
    {
        $conditions = [
            'deleted_at' => 'IS NULL'
        ];
        $joins = [
            [
                'table' => 'status',
                'connect' => 'JOIN',
                'condition_1' => 'id_status',
                'condition_2' => 'id',
                'select' => ['name_status'],
            ],
        ];
        return $this->all(self::TABLE, $conditions, $joins);
    }

    public function storeRecord($data): array|bool
    {
        return $this->store(self::TABLE, $data);
    }

    public function detailRecord($id): array
    {
        $joins = [
            [
                'table' => 'status',
                'connect' => 'JOIN',
                'condition_1' => 'id_status',
                'condition_2' => 'id',
            ],
        ];
        return $this->find(self::TABLE, $id, $joins);
    }

    public function deleteRecord($data, $id): mysqli_result|bool
    {
        return $this->delete(self::TABLE, $data, $id);
    }

    public function updateRecord($data, $id): mysqli_result|bool
    {
        return $this->update(self::TABLE, $data, $id);
    }

}