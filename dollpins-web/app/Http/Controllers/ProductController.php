<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function showProducts()
    {
        $products = $this->productService->getAllProducts();
        return view('panels.products.search', compact('products'));
    }

    public function showProduct($id)
    {
        $product = $this->productService->getProductById($id);
        $category = $this->categoryService->getCategoryById($product->category_id);
        $data = [
            'product' => $product,
            'category' => $category
        ];

        return view('panels.products.show', compact('data'));
    }

    public function createProduct(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);
        $data['status'] = 1;
        $this->productService->createProduct($data);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function updateProduct(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);
        $this->productService->updateProduct($id, $data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function showCreateForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('panels.products.create', compact('categories'));
    }

    public function showEditForm($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->categoryService->getAllCategories();
        $data = [
            'product' => $product,
            'categories' => $categories
        ];
        return view('panels.products.edit', compact('data'));
    }

    public function deleteProduct()
    {
        $id = request('id');
        $this->productService->deleteProduct($id);
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
