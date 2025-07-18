<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ReferralCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referrals = ReferralCode::latest()->paginate(10);
        return view('admin.referrals.index', compact('referrals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:referral_codes,code',
            'discount_amount' => 'required|integer|min:1',
            'is_active' => 'sometimes|boolean',
            'expires_at' => 'nullable|date',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Konversi expires_at jika ada input
        if ($request->filled('expires_at')) {
            $validated['expires_at'] = Carbon::parse($request->input('expires_at'));
        }

        ReferralCode::create($validated);

        return redirect()->route('admin.referrals.index')->with('success', 'Referral code created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferralCode $referralCode)
    {
        return view('admin.referrals.edit', compact('referralCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferralCode $referralCode)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique('referral_codes')->ignore($referralCode->id)],
            'discount_amount' => 'required|integer|min:1',
            'is_active' => 'sometimes|boolean',
            'expires_at' => 'nullable|date',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->filled('expires_at')) {
            $validated['expires_at'] = Carbon::parse($request->input('expires_at'));
        } else {
            $validated['expires_at'] = null;
        }

        $referralCode->update($validated);

        return redirect()->route('admin.referrals.index')->with('success', 'Referral code updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferralCode $referralCode)
    {
        $referralCode->forceDelete();

        return redirect()->route('admin.referrals.index', ['page' => 1])
            ->with('success', 'Referral code deleted successfully!');
    }

    /**
     * Show the specified resource (redirect to edit).
     */
    public function show(ReferralCode $referralCode)
    {
        return redirect()->route('admin.referrals.edit', $referralCode);
    }
}
