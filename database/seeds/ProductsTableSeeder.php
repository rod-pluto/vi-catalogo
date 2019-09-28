<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Str;

use App\Models\ProductCategory as Category;
use App\Models\Product;
use App\Models\User as Company;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
        $companies = Company::role('company')->get();

        /**
         * Cada empresa adiciona 10 categorias de produtos e 50 produtos
         */
        foreach($companies as $company) {
            for($cont=0; $cont < 10; $cont++) {
                $name = 'Categoria #' . ($cont+1);
                $category = Category::create(['name' => $name]);

                for($prod=0; $prod < 50; $prod++) {
                    Product::create([
                        'company_id' => $company->id,
                        'category_id' => $category->id,
                        'ean' => $faker->unique()->ean8,
                        'image' => 'https://via.placeholder.com/200',
                        'name' => 'Produto #' . ($prod+1),
                        'price' => $faker->randomFloat(2, 0, 2000),
                        'description' => $faker->text,
                        'status' => $faker->boolean()
                    ]);
                }
            }
        }
    }
}
