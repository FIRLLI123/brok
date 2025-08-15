<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kosts = auth()->user()->kost()
            ->with(['images'])
            ->withCount('rooms')
            ->get();
            
        // Debug: Log data kost dan gambar
        foreach ($kosts as $kost) {
            \Log::info('Kost Data:', [
                'id' => $kost->id,
                'name' => $kost->name,
                'images' => $kost->images->toArray()
            ]);
        }
        
        return view('mitra.kost.index', compact('kosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitra.kost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Mulai proses penyimpanan kost', ['request' => $request->except(['_token'])]);

            $validator = \Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'city' => 'required|string|max:100',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'name.required' => 'Nama kost harus diisi',
                'address.required' => 'Alamat harus diisi',
                'city.required' => 'Kota harus diisi',
                'description.required' => 'Deskripsi harus diisi',
                'price.required' => 'Harga harus diisi',
                'price.numeric' => 'Harga harus berupa angka',
                'price.min' => 'Harga tidak boleh kurang dari 0',
                'images.required' => 'Minimal 1 gambar harus diupload',
                'images.array' => 'Format gambar tidak valid',
                'images.min' => 'Minimal 1 gambar harus diupload',
                'images.*.image' => 'File harus berupa gambar',
                'images.*.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
                'images.*.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            if ($validator->fails()) {
                \Log::error('Validasi gagal', ['errors' => $validator->errors()->all()]);
                return back()->withErrors($validator)->withInput();
            }

            \Log::info('Validasi berhasil');

            try {
                // Mulai transaksi database
                \DB::beginTransaction();
                \Log::info('Memulai transaksi database');

                // Simpan data kost
                $kost = auth()->user()->kost()->create([
                    'name' => $request->name,
                    'address' => $request->address,
                    'city' => $request->city,
                    'description' => $request->description,
                    'price' => $request->price,
                    'is_active' => true,
                    'admin_approved' => false,
                ]);

                \Log::info('Kost berhasil disimpan', ['kost_id' => $kost->id]);

                // Simpan gambar ke storage dan ke tabel kost_images
                if ($request->hasFile('images')) {
                    \Log::info('Request memiliki file gambar.');
                    
                    // Buat direktori jika belum ada
                    if (!\Storage::disk('public')->exists('kost_images')) {
                        \Storage::disk('public')->makeDirectory('kost_images');
                    }

                    foreach ($request->file('images') as $image) {
                        try {
                            \Log::info('Memproses gambar:', ['original_name' => $image->getClientOriginalName()]);
                            
                            // Baca gambar dengan Intervention Image
                            $img = Image::make($image->getRealPath());
                            \Log::info('Intervention Image berhasil membuat objek gambar.');

                            // Resize dan crop gambar ke ukuran 600x350
                            $img->fit(600, 350);
                            \Log::info('Gambar berhasil di-resize dan di-crop ke 600x350.');

                            // Kompres gambar dengan kualitas 80% dan encode ke JPG
                            $img->encode('jpg', 80);
                            \Log::info('Gambar berhasil di-encode.');

                            // Buat nama file unik dan simpan ke storage
                            $name = 'kost_images/' . md5($image->getClientOriginalName() . time()) . '.jpg';
                            \Log::info('Nama file yang akan disimpan:', ['name' => $name]);
                            
                            // Simpan data biner gambar yang sudah dikompresi
                            $storageResult = \Storage::disk('public')->put($name, (string) $img);
                            \Log::info('Hasil penyimpanan ke storage:', ['result' => $storageResult]);

                            if (!$storageResult) {
                                throw new \Exception('Gagal menyimpan gambar ke storage');
                            }

                            \Log::info('Akan menyimpan path gambar ke database.');
                            \DB::table('kost_images')->insert([
                                'kost_id' => $kost->id,
                                'image_path' => $name,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            \Log::info('Path gambar berhasil disimpan ke database.');
                            
                        } catch (\Exception $e) {
                            \Log::error('Error saat memproses gambar: ' . $e->getMessage(), [
                                'trace' => $e->getTraceAsString()
                            ]);
                            throw new \Exception('Gagal memproses gambar: ' . $e->getMessage());
                        }
                    }
                    \Log::info('Semua gambar berhasil diproses');
                } else {
                    \Log::warning('Tidak ada file gambar yang diupload');
                    throw new \Exception('Tidak ada file gambar yang diupload');
                }

                // Commit transaksi jika semua berhasil
                \DB::commit();
                \Log::info('Transaksi database berhasil di-commit');

                return redirect()->route('mitra.kost.index')
                    ->with('success', 'Kost berhasil ditambahkan!');
                    
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi error
                \DB::rollBack();
                \Log::error('Error dalam transaksi: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);
                
                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
            
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan kost: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan kost: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kost = auth()->user()->kost()
            ->with(['images', 'rooms'])
            ->findOrFail($id);
            
        return view('mitra.kost.show', compact('kost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
