<?php
class Status extends Model
{
    const TABLE = 'status';

    public function getAll(): array
    {
        return $this->all(self::TABLE);
    }


}