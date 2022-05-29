<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(){
        $productCategories = ProductCategory::all();
        
        return view('admin.product-category.index',['productCategories' => $productCategories]);
    }

    public function create(){
        return view('admin.product-category.create');
    }

    public function store(Request $request){
        ProductCategory::create($request->all());
        return redirect()->route('admin.product-category.index');
    }

    public  function edit($id){
        $productCategories = ProductCategory::find($id);
        
        return view('admin.product-category.edit', compact('productCategories'));
    }

    public function update(Request $request, $id){
        ProductCategory::find($id)->update(['category_name' => $request->category_name]);     
        return redirect()->route('admin.product-category.index');   
    }

    public function destroy($id)
    {
        $productCategories = ProductCategory::find($id);
        $productCategories->delete();
        return redirect()->route('admin.product-category.index');
    }

    public function trash()
    {
        $productCategories = ProductCategory::onlyTrashed()->get();
        return view('admin.trashcat.list', compact('productCategories'));
    }
    
    
    public function restore($id = null)
    {
        $productCategories = ProductCategory::onlyTrashed()->where('id', $id) ->restore();
        
        return redirect('admin/product-category/trash');
    }

    public function restore_all()
    {
        $productCategories = ProductCategory::onlyTrashed()->restore();
        
        return redirect('admin/product-category/trash');
    }

    public function delete($id = null){
        $productCategories = ProductCategory::onlyTrashed()->where('id', $id)->forceDelete();
        //ProductCategory::find($id)->delete();
        return redirect('admin/product-category/trash');
    }
    public function delete_all()
    {
        $productCategories = ProductCategory::onlyTrashed()->forceDelete();

        return redirect('admin/product-category/trash');
    }

}
