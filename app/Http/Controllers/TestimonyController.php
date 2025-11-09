<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonyController extends Controller
{
    /**
     * Store a new testimony.
     */
    public function store(Request $request)
    {
        Log::info('Testimony submission attempt', ['data' => $request->all()]);

        try {
            $validated = $request->validate([
                'product_id' => 'nullable|exists:products,id',
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'content' => 'required|string|min:10|max:1000',
            ]);

            $validated['status'] = 'pending'; // Admin needs to approve

            Testimony::create($validated);

            Log::info('Testimony created successfully');

            return back()->with('success', 'Thank you for your testimony! It will be reviewed and published soon.');

        } catch (\Exception $e) {
            Log::error('Testimony submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->withErrors(['error' => 'Failed to submit testimony. Please try again.']);
        }
    }

    /**
     * Display testimonies for admin.
     */
    public function index()
    {
        $testimonies = Testimony::with('product')
            ->latest()
            ->paginate(20);

        return view('admin.testimonies.index', compact('testimonies'));
    }

    /**
     * Approve a testimony.
     */
    public function approve(Testimony $testimony)
    {
        $testimony->update(['status' => 'approved']);
        return back()->with('success', 'Testimony approved successfully.');
    }

    /**
     * Reject a testimony.
     */
    public function reject(Testimony $testimony)
    {
        $testimony->update(['status' => 'rejected']);
        return back()->with('success', 'Testimony rejected.');
    }

    /**
     * Delete a testimony.
     */
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return back()->with('success', 'Testimony deleted successfully.');
    }
}
