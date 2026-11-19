<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('customer')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('customer', function ($qc) use ($request) {
                    $qc->where('name', 'like', "%{$request->search}%")
                       ->orWhere('phone', 'like', "%{$request->search}%");
                })->orWhere('code', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
{
    $booking->load(['customer', 'items.product', 'services.service', 'payments', 'package']);
    return view('admin.bookings.show', compact('booking'));
}

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,picked_up,returned,cancelled',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Status booking diperbarui.');
    }

    public function storePayment(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:dp,lunas',
            'status' => 'required|in:pending,verified',
        ]);

        $validated['booking_id'] = $booking->id;
        $validated['paid_at'] = $validated['status'] === 'verified' ? now() : null;

        Payment::create($validated);

        return back()->with('success', 'Pembayaran dicatat.');
    }
}
