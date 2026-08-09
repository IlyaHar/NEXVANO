@extends('layouts.main')

@section('title') SeedUP — про компанію @endsection
@section('description', 'SeedUP — українська насіннєва компанія. Понад 8 років досвіду, французька генетика та власне виробництво гібридів в Україні.')
@section('canonical', route('about.about'))
@section('main-class', 'public-main')
@section('content-class', 'container-fluid p-0')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__grid">
            <div><span class="section-kicker">Про SeedUP</span><h1>Якість, що дає <em>стабільний врожай</em></h1><p>Ми створюємо насіння для реальних умов українського землеробства — з опорою на французьку генетику, досвід та повний контроль.</p></div>
            <div class="inner-hero__mark"><img src="{{ asset('storage/seedup-logo.png') }}" alt="SeedUP"></div>
        </div>
    </section>

    <section class="content-section">
        <div class="site-shell story-grid">
            <div class="story-stats"><div><strong>2016</strong><span>початок роботи в насінництві</span></div><div><strong>2023</strong><span>старт виробництва гібридів в Україні</span></div><div><strong>100%</strong><span>контроль ключових етапів</span></div></div>
            <article class="rich-copy"><span class="section-kicker">Наша історія</span><h2>Партнерство, що починається з довіри</h2><p>SeedUP — українська компанія, яка спеціалізується на вирощуванні та постачанні високоякісного посівного матеріалу. Наша мета — не просто продати насіння, а допомогти аграрію отримати передбачуваний результат.</p><p>Використовуємо французькі батьківські форми, а виробництво ведемо в Україні. Так ми поєднуємо сильну генетику з адаптацією до місцевого клімату та ґрунтів.</p></article>
        </div>
    </section>

    <section class="content-section content-section--soft"><div class="site-shell"><div class="section-heading section-heading--center"><span class="section-kicker">Наші цінності</span><h2>Три принципи у кожній партії</h2></div><div class="value-grid"><article><i class="fa-solid fa-flask"></i><h3>Інновації</h3><p>Поєднуємо селекцію, точну агрономію та дані польових спостережень.</p></article><article><i class="fa-solid fa-medal"></i><h3>Якість</h3><p>Перевіряємо генетичну чистоту, схожість, вологість та енергію росту.</p></article><article><i class="fa-solid fa-handshake"></i><h3>Надійність</h3><p>Даємо чесну консультацію і залишаємося поруч після покупки.</p></article></div></div></section>
    @include('blocks.contact-cta')
@endsection
