<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('slug',Str::slug('General'))->first();
        if(!$category){
            Category::factory(1)->create([
                'name' => 'General',
                'slug' => Str::slug('General')
            ]);
        }
    }
}
