<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_with_the_same_generated_slug_can_be_added_repeatedly(): void
    {
        $user = User::factory()->create();

        foreach (range(1, 3) as $number) {
            $this->actingAs($user)
                ->post(route('products.store'), $this->productData())
                ->assertRedirect(route('products.index'));
        }

        $this->assertSame(
            ['nexvano-zinc', 'nexvano-zinc-2', 'nexvano-zinc-3'],
            Product::query()->orderBy('id')->pluck('slug')->all()
        );
    }

    public function test_uploaded_product_image_is_rendered_in_catalog_and_product_page(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('products.store'), $this->productData([
            'image' => UploadedFile::fake()->createWithContent(
                'zinc.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=')
            ),
        ]));

        $product = Product::firstOrFail();
        Storage::disk('public')->assertExists($product->image);

        $this->get(route('catalog'))
            ->assertOk()
            ->assertSee($product->image_url, false)
            ->assertSee('class="product-image"', false);

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertSee($product->image_url, false)
            ->assertSee('class="structured-text product-description"', false)
            ->assertSee('<p>Перший абзац.</p>', false)
            ->assertSee('<p>Другий абзац.</p>', false);

        $this->get($product->image_url)
            ->assertOk()
            ->assertHeader('cache-control', 'immutable, max-age=31536000, public');
    }

    public function test_single_line_product_copy_is_split_into_readable_blocks(): void
    {
        $this->assertSame([
            'Перше речення.',
            'Друге речення.',
            '🌻 Соняшник: 1–2 л/га',
        ], Product::textBlocks('Перше речення. Друге речення. 🌻 Соняшник: 1–2 л/га'));

        $this->assertSame([
            'Зернові культури',
            'Позакореневе підживлення: 0,7–1,5 л/га',
            'Обробка насіння: 1,0 л/т',
        ], Product::textBlocks('Зернові культури Позакореневе підживлення: 0,7–1,5 л/га Обробка насіння: 1,0 л/т'));
    }

    private function productData(array $overrides = []): array
    {
        return array_merge([
            'title_uk' => 'Nexvano Zinc',
            'title_es' => 'Nexvano Zinc',
            'description_uk' => "Перший абзац.\n\nДругий абзац.",
            'description_es' => "Primer párrafo.\n\nSegundo párrafo.",
            'composition_uk' => "Цинк — 45 г/л\nАзот — 35 г/л",
            'composition_es' => "Zinc — 45 g/l\nNitrógeno — 35 g/l",
            'application_uk' => "Зернові: 0,7–1,5 л/га\nОлійні: 1–2 л/га",
            'application_es' => "Cereales: 0,7–1,5 l/ha\nOleaginosas: 1–2 l/ha",
            'volume' => '5 L',
            'is_active' => '1',
        ], $overrides);
    }
}
