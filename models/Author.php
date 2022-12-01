<?php

namespace app\models;

use app\core\db\DbModel;

class Author extends DbModel
{
    public string $profile;
    public string $intro;
    public string $name;

    public function attributes(): array
    {
        return ['profile', 'intro', 'name'];
    }

    public static function tableName(): string
    {
        return 'authors';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public static function sort(): array
    {
       return [];
    }
}