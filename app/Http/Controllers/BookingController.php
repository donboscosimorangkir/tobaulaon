<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\BookingService;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::where('status', 'available')->get();
        $package = $request->filled('package') ? Package::with('items.itemable')->find($request->package) : null;
        return view('booking.create', compact('products', 'package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
            'event_date' => 'required|date',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'package_id' => 'nullable|exists:packages,id',
            'product_ids' => 'required_without:package_id|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        if (empty($validated['package_id'])) {
            foreach ($validated['product_ids'] as $productId) {
                $product = Product::findOrFail($productId);
                if (!$product->isAvailable($validated['pickup_date'], $validated['return_date'])) {
                    return back()->withErrors([
                        'product_ids' => "{$product->name} sudah dibooking di tanggal tersebut.",
                    ])->withInput();
                }
            }
        }

        $customer = Customer::firstOrCreate(
            ['phone' => $validated['phone']],
            ['name' => $validated['name'], 'address' => $validated['address'] ?? null]
        );

        $booking = Booking::create([
            'code' => 'TU-' . now()->format('Ymd') . '-' . str_pad(Booking::count() + 1, 3, '0', STR_PAD_LEFT),
            'customer_id' => $customer->id,
            'package_id' => $validated['package_id'] ?? null,
            'event_date' => $validated['event_date'],
            'pickup_date' => $validated['pickup_date'],
            'return_date' => $validated['return_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        if (!empty($validated['package_id'])) {
            $package = Package::with('items.itemable')->find($validated['package_id']);
            foreach ($package->items as $item) {
                if ($item->itemable_type === Product::class) {
                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'product_id' => $item->itemable_id,
                        'price' => 0,
                    ]);
                } else {
                    BookingService::create([
                        'booking_id' => $booking->id,
                        'service_id' => $item->itemable_id,
                        'price' => 0,
                    ]);
                }
            }
            $booking->update(['total_price' => $package->price]);
        } else {
            $total = 0;
            foreach ($validated['product_ids'] as $productId) {
                $product = Product::find($productId);
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'product_id' => $productId,
                    'price' => $product->price,
                ]);
                $total += $product->price;
            }
            $booking->update(['total_price' => $total]);
        }

        return redirect()->route('booking.success', $booking->code);
    }

    public function success(string $code)
{
    $booking = Booking::with(['items.product', 'services.service', 'package'])
        ->where('code', $code)
        ->firstOrFail();
    return view('booking.success', compact('booking'));
}

    public function checkStatusForm()
    {
        return view('booking.check');
    }

    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'phone' => 'required|string',
        ]);

        $booking = Booking::with(['items.product', 'services.service', 'payments', 'package'])
            ->where('code', $validated['code'])
            ->whereHas('customer', fn ($q) => $q->where('phone', $validated['phone']))
            ->first();

        if (!$booking) {
            return back()->withErrors([
                'code' => 'Kode booking atau nomor WA tidak cocok. Periksa kembali.',
            ])->withInput();
        }

        return view('booking.status', compact('booking'));
    }
}
