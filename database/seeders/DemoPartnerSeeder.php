<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class DemoPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'Limagrain', 'logo' => 'limagrain-demo.svg', 'website_url' => 'https://www.limagrain.com/', 'description' => 'Селекція та насінництво', 'sort_order' => 10],
            ['name' => 'Lidea', 'logo' => 'lidea-demo.svg', 'website_url' => 'https://lidea-seeds.com/', 'description' => 'Насіння польових культур', 'sort_order' => 20],
            ['name' => 'MAS Seeds', 'logo' => 'mas-seeds-demo.svg', 'website_url' => 'https://masseeds.com/', 'description' => 'Гібриди та агрономічні рішення', 'sort_order' => 30],
            ['name' => 'RAGT Semences', 'logo' => 'ragt-demo.svg', 'website_url' => 'https://ragt-seeds.com/', 'description' => 'Селекція та генетика рослин', 'sort_order' => 40],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(['name' => $partner['name']], $partner + ['is_active' => true]);
        }
    }
}
