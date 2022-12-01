<?php

namespace app\models;

use app\core\db\DbModel;

class Post extends DbModel
{
    public string $title = '';
    public string $summary = '';
    public string $content = '';
    public bool $published = false;
    public string $published_at = '';
    public string $image_url = '';

    public static function tableName(): string
    {
        return 'posts';
    }
    public function attributes(): array
    {
        return ['title', 'summary', 'content', 'published_at', 'image_url'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function getAll($limit, $offset)
    {
        return Post::findAllWithAssoc($limit, $offset);
    }

    public static function sort(): array
    {
        return ['published_at DESC ' ];
    }
}