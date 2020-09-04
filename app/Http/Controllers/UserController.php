<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function createUser(Request $request){
        try{

            $validUser = $request->validate([
                'email'    => 'required|min:10|max:255|email|unique:users',
                'name'     => 'required|min:2|max:255',
                'password' => 'required|min:6|max:255',
            ]);
            $newUser = $this->userService->createuser($validUser);
            return response($newUser, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function getUser(Request $request, $id){
        try{
            
            $user = $this->userService->getUserById($id);
            $status = empty($user) ? '404' : '200';
            return response($user, $status);

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
    public function getAllUsers(Request $request){
        try{
            
            $user = $this->userService->getAllUsers($_GET);
            $status = empty($user) ? '404' : '200';
            return response($user, $status);

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
    public function updateUser(Request $request,$id){
        try{

            $validUser = $request->validate([
        
                'name'     => 'required|min:2|max:255',
            ]);
            
            $updatedUser = $this->userService->updateUser($validUser,$id);
            return response($updatedUser, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function deleteUser(Request $request,$id){
        try{

            $deleted = $this->userService->deleteUser($id);
            return response($deleted, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
}
