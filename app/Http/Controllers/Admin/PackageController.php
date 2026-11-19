<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageItem;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('items.itemable')->latest()->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $products = Product::where('status', 'available')->get();
        $services = Service::where('status', 'available')->get();
        return view('admin.packages.form', [
            'package' => new Package(),
            'products' => $products,
            'services' => $services,
            'selectedItems' => [],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package = Package::create($validated);
        $this->syncItems($package, $request->input('items', []));

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        $products = Product::where('status', 'available')->get();
        $services = Service::where('status', 'available')->get();

        $selectedItems = $package->items->map(function ($item) {
            $prefix = $item->itemable_type === Product::class ? 'product' : 'service';
            return "{$prefix}-{$item->itemable_id}";
        })->toArray();

        return view('admin.packages.form', compact('package', 'products', 'services', 'selectedItems'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);
        $this->syncItems($package, $request->input('items', []));

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
        $package->delete();
        return back()->with('success', 'Paket berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,inactive',
            'image' => 'nullable|image|max:2048',
            'items' => 'required|array|min:1',
        ]);
    }

    private function syncItems(Package $package, array $items): void
    {
        $package->items()->delete();

        foreach ($items as $item) {
            [$type, $id] = explode('-', $item);
            $itemableClass = $type === 'product' ? Product::class : Service::class;

            PackageItem::create([
                'package_id' => $package->id,
                'itemable_type' => $itemableClass,
                'itemable_id' => $id,
                'quantity' => 1,
            ]);
        }
    }
}
