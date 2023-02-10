<?php
class Todo extends Model
{
    const TABLE = 'work';

    public function getAll() {
        return $this->all(self::TABLE);
    }

    public function storeRecord($data): array|bool
    {
         return $this->store(self::TABLE, $data);
    }

    public function detailRecord($id): array
    {
        return $this->find(self::TABLE, $id);
    }

    public function deleteRecord($id): bool|array|null
    {
        return $this->delete(self::TABLE, $id);
    }

    public function updateRecord($data, $id): mysqli_result|bool
    {
        return $this->update(self::TABLE, $data, $id);
    }

}