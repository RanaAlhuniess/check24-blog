<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Post;

class BlogController extends Controller
{
    public function overview()
    {
        $post = new Post();
        $posts = $post->getAll(10, 0);
        $postsToView = [];
        foreach ($posts as $post) {
            $postVm = new \app\viewModels\Post();
            $postVm->id = $post['id'];
            $postVm->author_name = $post['name'];
            $postVm->summary = $post['summary'];
            $postVm->title = $post['title'];
            $postVm->published_at = $post['published_at'];
            $postVm->image_url = $post['image_url'];
            $postsToView[] = $postVm;
        }
        return $this->render('overview');
    }
}