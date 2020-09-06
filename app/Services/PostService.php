<?php 

namespace App\Services;
use App\Post;

class PostService{

    public function createPost($Post){
        try{
            $newPost = Post::create($Post);
            return $newPost;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getPost($id){
        try{
            $post = Post::where(['id' => $id])->first();
            return $post;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getAllPosts($params){
        try{
            $post = new Post();
            if(isset($params['title'])){
               $post = $post->where('title','like', '%'.$params['title'].'%');
            }
            return $post->paginate(4);
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function updatePost($post,$id){
        try{
            $updatedPost = Post::find($id);
            $updatedPost['title'] = $post['title'];
            $updatedPost['subtitle'] = $post['subtitle'];
            $updatedPost['content'] = $post['content'];
            $updatedPost->save();
            
            return $updatedPost;

        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function deletePost($id){
        try{
            $deleted = Post::where(['id' => $id])->delete();
            return $deleted;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }
}