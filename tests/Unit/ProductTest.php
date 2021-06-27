<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_a_product_belongs_to_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $this->assertInstanceOf(Category::class, $product->category);
    }
}
