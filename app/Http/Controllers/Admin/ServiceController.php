<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('vendor')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $vendors = Vendor::orderBy('name')->get();
        return view('admin.services.form', ['service' => new Service(), 'vendors' => $vendors]);
    }

    public function store(Request $request)
    {
        Service::create($this->validateData($request));
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        $vendors = Vendor::orderBy('name')->get();
        return view('admin.services.form', compact('service', 'vendors'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validateData($request));
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|in:per_acara,per_jam,per_hari',
            'vendor_id' => 'nullable|exists:vendors,id',
            'status' => 'required|in:available,inactive',
        ]);
    }
}
