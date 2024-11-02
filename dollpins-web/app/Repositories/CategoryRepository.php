<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->all();
    }

    public function findById($id)
    {
        return $this->category->find($id);
    }

}
