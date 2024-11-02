<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;


class ProductService
{
    protected ProductRepository $productRepository;
    protected CategoryService $categoryService;

    public function __construct(ProductRepository $productRepository, CategoryService $categoryService)
    {
        $this->productRepository = $productRepository;
        $this->categoryService = $categoryService;
    }

    public function getAllProducts()
    {
        $products = $this->productRepository->all();
        foreach ($products as $product) {
            $category = $this->categoryService->getCategoryById($product->category_id);
            $product->category = $category;
        }
        return $products;
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct($data)
    {
        $data['id'] = Str::uuid();
        $data['status'] = 1;
        return $this->productRepository->create($data);
    }

    public function updateProduct($data, $id)
    {
        return $this->productRepository->update($data, $id);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

}
