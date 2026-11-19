<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.form', ['vendor' => new Vendor()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        Vendor::create($validated);
        return redirect()->route('admin.vendor.index')->with('success', 'Vendor berhasil ditambahkan.');
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.form', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validated = $this->validateData($request);
        $vendor->update($validated);
        return redirect()->route('admin.vendor.index')->with('success', 'Vendor berhasil diperbarui.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return back()->with('success', 'Vendor berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'contact_person' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'service_type' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);
    }
}
