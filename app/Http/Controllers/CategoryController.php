<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function createCategory(Request $request){
        try{

            $validCategory = $request->validate([
                'category' => 'required|max:255',
                'color' => 'required|max:255',
            ]);
            $newCategory = $this->categoryService->createCategory($validCategory);
            return response($newCategory, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function getCategory(Request $request){
        return 'ola';
    }
    public function getAllCategories(Request $request){
        return 'ol';
    }
    public function updateCategory(Request $request,$id){
        try{

            $validCategory = $request->validate([
                'category' => 'required|max:255',
                'color' => 'required|max:255',
            ]);
            
            $updatedCategory = $this->categoryService->updateCategory($validCategory,$id);
            return response($updatedCategory, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }

    public function deleteCategory(Request $request,$id){
        try{

            $deleted = $this->categoryService->deleteCategory($id);
            return response($deleted, '200');

        } catch (\Exception $exception) {
            return response($exception,500);
        }
    }
}
