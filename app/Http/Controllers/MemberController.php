<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::orderBy('nama_pelanggan')->paginate(10);
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'username' => 'required|string|unique:members|max:50',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' butuh kolom password_confirmation
            'alamat' => 'required|string',
            'email' => 'nullable|email|unique:members|max:100',
            'whatsapp' => 'nullable|string|unique:members|max:20',
            'poin_member' => 'nullable|integer|min:0',
        ]);
        Member::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'username' => $request->username,
            'password' => Hash::make($request->password), // WAJIB DI-HASH!
            'alamat' => $request->alamat,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'poin_member' => $request->poin_member ?? 0,
        ]);
        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'username' => 'required|string|unique:members,username,' . $member->id . '|max:50', // Ignore ID saat unique check
            'alamat' => 'required|string',
            'email' => 'nullable|email|unique:members,email,' . $member->id . '|max:100',
            'whatsapp' => 'nullable|string|unique:members,whatsapp,' . $member->id . '|max:20',
            'poin_member' => 'nullable|integer|min:0',
            'password' => 'nullable|string|min:6|confirmed', // Biarkan kosong jika tidak ingin ganti password
        ]);

    // 2. Persiapkan Data
        $data = $request->except(['_token', '_method', 'password', 'password_confirmation']);

    // Handle Password (Hanya update jika ada input password baru)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

    // 3. Update
        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Data Member berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus!');
    }
    public function  addPoints(Member $member)
    {
        return view('members.add_points', compact('member'));
    }
    public function storePoints(Request $request, Member $member)
    {
        $request->validate([
            'nominal_belanja' => 'required|integer|min:10000',
        ]);
        $nominalBelanja = $request->nominal_belanja;
        $hargaPerPoin = 10000;
        $newPoints = floor($nominalBelanja / $hargaPerPoin);
        if ($newPoints > 0) {
        // 3. Tambahkan poin baru ke poin member yang sudah ada
            $member->poin_member = $member->poin_member + $newPoints;
            $member->save();

            return redirect()->route('members.index')->with('success', 
                "Poin berhasil ditambahkan. Nominal Belanja: Rp " . number_format($nominalBelanja) . 
                ". Poin didapat: {$newPoints}. Total Poin {$member->nama_pelanggan}: {$member->poin_member} (Kategori: {$member->kategori_member})"
            );
        }
        return redirect()->route('members.index')->with('warning', 
        "Nominal belanja tidak cukup untuk mendapatkan poin."
    );
    }
    public function claimPoints(Member $member)
    {
        return view('members.claim_points', compact('member'));
    }
    public function redeemPoints(Request $request, Member $member)
    {
        $request->validate([
            'poin_to_redeem' => 'required|integer|min:100', // Minimal penukaran 100 poin
        ]);
        $poinToRedeem = $request->poin_to_redeem;
        $currentPoints = $member->poin_member;
        if ($poinToRedeem > $currentPoints) {
            return redirect()->back()->withErrors([
                'poin_to_redeem' => "Poin member tidak mencukupi. Poin saat ini: {$currentPoints}, yang ingin ditukar: {$poinToRedeem}."
            ])->withInput();
        }
        $member->poin_member = $member->poin_member - $poinToRedeem;
        $member->save();
        $rewardValue = ($poinToRedeem / 100) * 10000;
        return redirect()->route('members.index')->with('success', 
            "Poin berhasil diklaim! Poin ditukar: {$poinToRedeem}. Nilai reward: Rp " . number_format($rewardValue) . ". Total Poin saat ini: {$member->poin_member} (Kategori: {$member->kategori_member})"
        );
    }
}
