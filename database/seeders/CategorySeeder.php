<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed a three level category tree (Self Referencing).
     */
    public function run(): void
    {
        $this->seedTree([
            'Electronics' => [
                'Phones' => ['Android' => [], 'iOS' => []],
                'Laptops' => ['Gaming' => [], 'Ultrabook' => []],
            ],
            'Books' => [
                'Fiction' => [],
                'Non-Fiction' => [],
            ],
        ]);
    }

    /**
     * Create every category of the tree below the given parent.
     */
    private function seedTree(array $tree, ?int $parentId = null): void
    {
        foreach ($tree as $name => $children) {
            $category = Category::create(['parent_id' => $parentId, 'name' => $name]);

            $this->seedTree($children, $category->id);
        }
    }
}
