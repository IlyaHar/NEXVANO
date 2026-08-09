<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        return view('partner.index', [
            'partners' => Partner::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('partner.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['logo'] = basename($request->file('logo')->store('partners', 'public'));
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Partner::create($data);

        return redirect()->route('partners.index')->with('success', 'Партнера додано');
    }

    public function edit(Partner $partner): View
    {
        return view('partner.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $data = $this->validated($request, false);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            $this->deleteLogo($partner);
            $data['logo'] = basename($request->file('logo')->store('partners', 'public'));
        }

        $partner->update($data);

        return redirect()->route('partners.index')->with('success', 'Партнера оновлено');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $this->deleteLogo($partner);
        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Партнера видалено');
    }

    private function validated(Request $request, bool $logoRequired = true): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => [$logoRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'website_url' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function deleteLogo(Partner $partner): void
    {
        if ($partner->logo) {
            Storage::disk('public')->delete('partners/'.$partner->logo);
        }
    }
}
