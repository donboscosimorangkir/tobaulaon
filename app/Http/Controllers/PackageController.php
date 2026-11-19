<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('items.itemable')->where('status', 'available')->get();
        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        $package->load('items.itemable');
        return view('packages.show', compact('package'));
    }
}
