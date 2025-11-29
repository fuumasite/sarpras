<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Store a new report (user)
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'type' => 'required|string|in:damage,borrow,other',
            'quantity' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $report = Report::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'type' => $request->type,
            'quantity' => $request->quantity ?? 0,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Submitted Report',
            'details' => "Submitted report ({$report->type}) for product_id: {$report->product_id}"
        ]);

        return back()->with('success', 'Laporan berhasil dikirim.');
    }

    // Admin: list reports
    public function index()
    {
        $reports = Report::with(['user', 'product'])->latest()->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    // Admin: approve report
    public function approve($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'pending') {
            return back()->with('info', 'Laporan sudah diproses.');
        }

        // Example: for damage or borrow, decrement stock by quantity when approving
        if (in_array($report->type, ['damage','borrow']) && $report->product_id && $report->quantity > 0) {
            $product = Product::find($report->product_id);
            if ($product && $product->quantity >= $report->quantity) {
                $product->decrement('quantity', $report->quantity);
            }
        }

        $report->update(['status' => 'approved']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Approved Report',
            'details' => "Approved report {$report->id} ({$report->type})"
        ]);

        return back()->with('success', 'Laporan disetujui.');
    }

    // Admin: reject report
    public function reject($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'pending') {
            return back()->with('info', 'Laporan sudah diproses.');
        }

        $report->update(['status' => 'rejected']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Rejected Report',
            'details' => "Rejected report {$report->id} ({$report->type})"
        ]);

        return back()->with('success', 'Laporan ditolak.');
    }

    // Export inventory PDF (keperluan admin) — digabungkan disini
    public function exportInventory()
    {
        // 1. Kunin lahat ng products kasama ang Category
        $products = Product::with('category')->orderBy('name')->get();

        // 2. Calculate Total Inventory Value (Price * Quantity ng bawat item)
        $totalValue = $products->sum(function ($product) {
            return $product->price * $product->quantity;
        });

        // 3. Kunin ang Date ngayon
        $date = now()->format('F d, Y');

        // 4. I-load ang view at ipasa ang data
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.inventory_pdf', compact('products', 'totalValue', 'date'));

        // 5. I-download ang PDF (inventory-report.pdf)
        return $pdf->download('inventory-report-'.now()->format('Y-m-d').'.pdf');
    }

}