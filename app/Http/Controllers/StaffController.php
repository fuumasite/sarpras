<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RestockRequest;
use App\Models\Report;
use Picqer\Barcode\BarcodeGeneratorPNG; // Import Barcode Generator
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF

class StaffController extends Controller
{
    // 1. Dashboard (List)
    public function index(Request $request): View
    {
        $products = Product::with('category')->latest()->get();

        // User's recent reports
        $myReports = Report::where('user_id', Auth::id())->with('product')->latest()->take(10)->get();

        return view('dashboard', compact('products', 'myReports'));
    }

    // 2. Show Create Form
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('staff.products.create', compact('categories'));
    }

    // 3. Store Logic
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // LOG ACTIVITY
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Product (User)',
            'details' => 'User added: ' . $product->name
        ]);

        return redirect()->route('dashboard')->with('success', 'Product added successfully!');
    }

    // 4. Show Edit Form
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('staff.products.edit', compact('product', 'categories'));
    }

    // 5. Update Logic
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // LOG ACTIVITY
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated Product (User)',
            'details' => 'User updated: ' . $product->name
        ]);

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    // 6. Stock Adjustment Logic
    public function adjustStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out', // 'in' = Add, 'out' = Deduct
            'quantity'   => 'required|integer|min:1',
            'remarks'    => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->quantity;
        $type = $request->type;
        $remarks = $request->remarks ?? 'Manual Adjustment';

        if ($type === 'in') {
            // STOCK IN
            $product->increment('quantity', $qty);
            $action = "Stock In (+{$qty})";
        } else {
            // STOCK OUT (Check if enough stock)
            if ($product->quantity < $qty) {
                return back()->withErrors(['quantity' => 'Not enough stock to deduct!']);
            }
            $product->decrement('quantity', $qty);
            $action = "Stock Out (-{$qty})";
        }

        // Log Activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => $action,
            'details' => "{$action} for {$product->name}. Reason: {$remarks}"
        ]);

        return back()->with('success', "Stock adjusted successfully: {$product->name}");
    }

    // // 7. Request Restock Logic
    // public function submitRestockRequest(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'quantity'   => 'nullable|integer|min:1',
    //         'notes'      => 'nullable|string|max:255',
    //     ]);

    //     $product = Product::findOrFail($request->product_id);

    //     // Create Request
    //     RestockRequest::create([
    //         'product_id' => $product->id,
    //         'user_id'    => Auth::id(),
    //         'quantity'   => $request->quantity ?? 0, // 0 means "Unspecified"
    //         'notes'      => $request->notes,
    //         'status'     => 'pending'
    //     ]);

    //     // Log Activity
    //     ActivityLog::create([
    //         'user_id' => Auth::id(),
    //         'action'  => 'Requested Restock',
    //         'details' => "Requested restock for: {$product->name}"
    //     ]);

    //     return back()->with('success', 'Restock request sent to Admin successfully!');
    // }

    // 8. Print Barcode Label
    public function printLabel($id)
    {
        $product = Product::findOrFail($id);

        // Kung walang barcode (sa mga lumang products), lagyan natin
        if (!$product->barcode) {
            $product->update(['barcode' => str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT)]);
        }

        // 1. Generate Barcode Image (Base64)
        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);
        $barcodeBase64 = base64_encode($barcodeData);

        // 2. Load PDF View
        $pdf = Pdf::loadView('staff.products.label_pdf', compact('product', 'barcodeBase64'))
                  ->setPaper('legal', 'portrait'); // SET PAPER TO LEGAL

        // 3. Stream PDF
        return $pdf->stream('label-' . $product->barcode . '.pdf');
    }
}