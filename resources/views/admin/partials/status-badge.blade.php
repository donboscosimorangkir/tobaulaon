@php
    $map = [
        'pending'   => 'bg-amber-50 text-amber-800 border-amber-200',
        'confirmed' => 'bg-sky-50 text-sky-800 border-sky-200',
        'picked_up' => 'bg-purple-50 text-purple-800 border-purple-200',
        'returned'  => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'cancelled' => 'bg-rose-50 text-rose-800 border-rose-200',
    ];
    $dots = [
        'pending'   => 'bg-amber-500',
        'confirmed' => 'bg-sky-500',
        'picked_up' => 'bg-purple-500',
        'returned'  => 'bg-emerald-500',
        'cancelled' => 'bg-rose-500',
    ];
    $labels = [
        'pending'   => 'Menunggu', 
        'confirmed' => 'Dikonfirmasi', 
        'picked_up' => 'Barang Diambil',
        'returned'  => 'Selesai & Kembali', 
        'cancelled' => 'Dibatalkan',
    ];
@endphp
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $map[$status] ?? 'bg-gray-50 text-gray-700 border-gray-200' }}">
    <span class="w-1.5 h-1.5 rounded-full {{ $dots[$status] ?? 'bg-gray-400' }}"></span>
    <span>{{ $labels[$status] ?? ucfirst($status) }}</span>
</span>
