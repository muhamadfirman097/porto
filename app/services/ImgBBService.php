<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class ImgBBService
{
    protected $apiKey;
    protected $apiUrl = 'https://api.imgbb.com/1/upload';

    public function __construct()
    {
        // AMBIL DARI CONFIG (Lebih Aman)
        $this->apiKey = config('services.imgbb.key');
    }

    /**
     * Upload gambar ke ImgBB
     *
     * @param UploadedFile $file
     * @return string|null URL gambar atau null jika gagal
     */
    public function upload(UploadedFile $file)
    {
        try {
            // Kirim request ke API ImgBB
            $response = Http::attach(
                'image', 
                file_get_contents($file), 
                $file->getClientOriginalName()
            )->post($this->apiUrl, [
                'key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                return $response->json()['data']['url'];
            }
            
            return null;
        } catch (\Exception $e) {
            // Log error jika diperlukan: \Log::error($e->getMessage());
            return null;
        }
    }
}