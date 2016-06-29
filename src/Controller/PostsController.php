<?php
namespace App\Controller;


class PostsController extends AppController
{

    public function index()
    {
        $this->loadModel('Post');
        $posts = $this->Post->getAll();
        $this->set(compact('posts'));
    }

    public function show($id)
    {
    }
}
    