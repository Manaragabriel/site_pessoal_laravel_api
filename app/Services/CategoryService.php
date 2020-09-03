<?php 

namespace App\Services;
use App\Category;

class CategoryService{

    public function createCategory($category){
        try{
            $newCategory = Category::create($category);
            return $newCategory;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function getCategory($id){
        try{
            $newCategory = Category::create($category);
            return $newCategory;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function updateCategory($category,$id){
        try{
            $updatedCategory = Category::find($id);
            $updatedCategory['category'] = $category['category'];
            $updatedCategory['color'] = $category['color'];
            $updatedCategory->save();
            
            return $updatedCategory;

        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }

    public function deleteCategory($id){
        try{
            $deleted = Category::where(['id' => $id])->delete();
            return $deleted;
        } catch (\Exception $exception){
            throw new \Exception($exception);
        }
    }
}