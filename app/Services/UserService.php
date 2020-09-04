<?php 

namespace App\Services;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function createUser($user){
        try{
            $user['password'] = Hash::make($user['password']);
            $newUser = User::create($user);
            return $newUser;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getUserById($id){
        try{
            $user = User::where(['id' => $id])->first();
            return $user;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getUserByEmail($email){
        try{
            $user = User::where(['email' => $email])->first();
            return $user;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getAllUsers($params){
        try{
            $user = new User();
            if(isset($params['title'])){
               $user = $user->where('title','like', '%'.$params['title'].'%');
            }
            return $user->paginate(12);
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function updateUser($user,$id){
        try{
            $updatedUser = User::find($id);
            $updatedUser['name'] = $user['name'];
            $updatedUser->save();
            
            return $updatedUser;

        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function deleteUser($id){
        try{
            $deleted = User::where(['id' => $id])->delete();
            return $deleted;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }
}