<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $sunflower = Category::firstOrCreate(['name' => 'Соняшник']);
        $corn = Category::firstOrCreate(['name' => 'Кукурудза']);

        $products = [
            [
                'category' => $sunflower,
                'title' => 'SU Vampa A-F+',
                'description' => '<p><strong>Високопродуктивний гібрид під Гранстар.</strong></p><ul><li>Стійкість до гербіциду трибенурон-метил.</li><li>Потенціал урожайності 48–51 ц/га.</li><li>Олійність 49–51%.</li><li>Стійкість до посухи та швидкий стартовий ріст.</li></ul>',
                'price' => 3850,
                'new_price' => 3490,
                'quantity' => 24,
                'thumbnail' => 'K8cMpPxuU0LShOJ9T8iJdqTNOig087Fk2A8MBmCw.jpg',
            ],
            [
                'category' => $sunflower,
                'title' => 'SU Rest',
                'description' => '<p><strong>Стабільний середньоранній гібрид.</strong></p><ul><li>Висока енергія початкового росту.</li><li>Хороша стійкість до вовчка соняшникового.</li><li>Рекомендований для Степу та Лісостепу.</li></ul>',
                'price' => 3650,
                'new_price' => null,
                'quantity' => 18,
                'thumbnail' => '7tISJsqSIyqW5EyAj1oMoSb8XRDOmM0wvC8Xyaet.jpg',
            ],
            [
                'category' => $sunflower,
                'title' => 'SU Orion',
                'description' => '<p><strong>Пластичний гібрид для різних умов вирощування.</strong></p><ul><li>Висока посухостійкість.</li><li>Рівномірне дозрівання.</li><li>Вирівняність посіву та міцне стебло.</li></ul>',
                'price' => 3720,
                'new_price' => 3350,
                'quantity' => 31,
                'thumbnail' => 'YY90iQOP0f0ALvOAcvOmrrLNIB8q3T7xFGl4j5iY.jpg',
            ],
            [
                'category' => $corn,
                'title' => 'SU Forte 280',
                'description' => '<p><strong>Середньоранній гібрид кукурудзи з високою вологовіддачею.</strong></p><ul><li>ФАО 280.</li><li>Швидкий старт та добра холодостійкість.</li><li>Міцне стебло та стійкість до вилягання.</li></ul>',
                'price' => 4250,
                'new_price' => 3990,
                'quantity' => 15,
                'thumbnail' => 'UZZ0EL37W0V2VMNQEOE7pXBQ4OepgWp2P4qTeLgs.jpg',
            ],
            [
                'category' => $corn,
                'title' => 'SU Vector 320',
                'description' => '<p><strong>Урожайний гібрид з високою адаптивністю.</strong></p><ul><li>ФАО 320.</li><li>Добре реагує на інтенсивну технологію.</li><li>Стійкий до температурних стресів.</li></ul>',
                'price' => 4480,
                'new_price' => null,
                'quantity' => 22,
                'thumbnail' => 'BmuqarLEka6RHUJ27Z3TEz02IqFMxjgBff17WieV.jpg',
            ],
            [
                'category' => $corn,
                'title' => 'SU Prime 250',
                'description' => '<p><strong>Ранньостиглий гібрид для широкої географії.</strong></p><ul><li>ФАО 250.</li><li>Стабільний у зонах недостатнього зволоження.</li><li>Швидкий старт навесні.</li></ul>',
                'price' => 4100,
                'new_price' => 3790,
                'quantity' => 27,
                'thumbnail' => 'GGFDJhdr4OB7d4WTNc9sdyxGfEPoYFsWqbf1HpGW.jpg',
            ],
        ];

        foreach ($products as $data) {
            $category = $data['category'];
            unset($data['category']);

            $product = Product::updateOrCreate(['title' => $data['title']], $data);
            $product->categories()->syncWithoutDetaching([$category->id]);
        }
    }
}
