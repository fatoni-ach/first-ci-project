<?php

namespace App\Controllers;

use App\Models\Post;
use CodeIgniter\HTTP\Request;

class PostController extends BaseController
{
    public function index(): string
    {
        $posts = (new Post)->findAll();
        // $posts = [];
        // dd($posts);
        $data = [
            'posts' => $posts,
        ];
        return view('post/index', $data);
    }

    public function store()
    {
        $postData = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
        ];
        // $post = (new Post())->insert($postData);
        $post = (new Post())->save($postData);
        
        return redirect()->back();
    }

    public function update() 
    {
        $postData = [
            'id' => $this->request->getVar('id_update'),
            'title' => $this->request->getVar('title_update'),
            'description' => $this->request->getVar('description_update'),
        ];

        // $postModel = (new Post())->update($postData);
        $postModel = (new Post())->save($postData);

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $post = (new Post())->delete($id);

        return redirect()->back();
    }
}
