<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MitraController extends Controller
{
    /**
     * Display a listing of mitraks.
     */
    public function index(): View
    {
        $mitraks = Mitra::latest()->paginate(10);
        return view('admin.mitraks.index', compact('mitraks'));
    }

    /**
     * Show the form for creating a new mitra.
     */
    public function create(): View
    {
        return view('admin.mitraks.create');
    }

    /**
     * Store a newly created mitra in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:mitraks',
            'description' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        // Generate slug
        $validated['slug'] = Mitra::generateSlug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(storage_path('app/public/mitraks'), $imageName);
            $validated['image'] = $imageName;
        }

        Mitra::create($validated);

        return redirect()
            ->route('admin.mitraks.index')
            ->with('success', 'Mitra berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified mitra.
     */
    public function edit(Mitra $mitra): View
    {
        return view('admin.mitraks.edit', compact('mitra'));
    }

    /**
     * Update the specified mitra in storage.
     */
    public function update(Request $request, Mitra $mitra): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:mitraks,name,' . $mitra->id,
            'description' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        // Update slug jika name berubah
        $validated['slug'] = Mitra::generateSlug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($mitra->image) {
                $oldImagePath = storage_path('app/public/mitraks/' . $mitra->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(storage_path('app/public/mitraks'), $imageName);
            $validated['image'] = $imageName;
        }

        $mitra->update($validated);

        return redirect()
            ->route('admin.mitraks.index')
            ->with('success', 'Mitra berhasil diperbarui');
    }

    /**
     * Remove the specified mitra from storage.
     */
    public function destroy(Mitra $mitra): RedirectResponse
    {
        // Delete image
        if ($mitra->image) {
            $imagePath = storage_path('app/public/mitraks/' . $mitra->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $mitra->delete();

        return redirect()
            ->route('admin.mitraks.index')
            ->with('success', 'Mitra berhasil dihapus');
    }
}
