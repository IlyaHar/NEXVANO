<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class NexvanoSiteTest extends TestCase {
 use RefreshDatabase;
 public function test_home_catalog_and_product_pages_render(): void { $this->seed(); $this->get('/')->assertOk()->assertSee('Точне живлення')->assertSee('Разом вирощуємо більше')->assertSee('Limagrain')->assertSee('RAGT Semences'); $this->get('/catalog')->assertOk()->assertSee('Nexvano Micro Complex'); $this->get('/catalog/micro-complex')->assertOk()->assertSee('Повний комплекс')->assertSee('Склад'); }
 public function test_spanish_locale_is_available(): void { $this->seed(); $this->withSession(['locale'=>'es'])->get('/')->assertOk()->assertSee('Nutrición precisa')->assertSee('Fabricado en España'); }
 public function test_admin_pages_render_for_authenticated_user(): void { $this->seed(); $user=User::first(); $this->actingAs($user)->get('/dashboard')->assertOk()->assertSee('Новий товар'); $this->actingAs($user)->get('/admin/products')->assertOk()->assertSee('Micro Complex'); $this->actingAs($user)->get('/admin/categories')->assertOk()->assertSee('Олійні культури'); }
}
