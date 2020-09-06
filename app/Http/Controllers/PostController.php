<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PostService;
use App\Http\Requests\StorePost;
class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function createPost(StorePost $request){
        try{

            $validPost = $request->validate([
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'content' => 'required',
            ]);
            $newPost = $this->postService->createPost($validPost);
            return response($newPost, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function getPost(Request $request, $id){
        try{
            
            $post = $this->postService->getPost($id);
            $status = empty($post) ? '404' : '200';
            return response($post, $status);

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
    public function getAllPosts(Request $request){
        try{
            
            $post = $this->postService->getAllPosts($_GET);
            $status = empty($post) ? '404' : '200';
            return response($post, $status);

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
    public function updatePost(StorePost $request,$id){
        try{

            $validPost = $request->validate([
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'content' => 'required',
            ]);
            
            $updatedPost = $this->postService->updatePost($validPost,$id);
            return response($updatedPost, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function deletePost(Request $request,$id){
        try{

            $deleted = $this->postService->deletePost($id);
            return response($deleted, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
}
