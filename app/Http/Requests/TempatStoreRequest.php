<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempatStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'namaTempat' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'kapasitas' => 'required|integer|min:1',
                'tanggal' => 'nullable|date',
                'harga' => 'nullable|numeric|min:0',
                'deskripsi' => 'nullable|string',
                'fototempat' => 'nullable|image|mimes:jpeg,png,jpg', // Contoh untuk validasi gambar
                'kontak' => 'nullable|string',
            ];
        }
    }
    public function messages()
    {
        return [
            'namaTempat.required' => 'Nama tempat wajib diisi.',
            'Alamat.required' => 'Alamat wajib diisi.',
            'Kota.required' => 'Kota wajib diisi.',
            'Kapasitas.required' => 'Kapasitas wajib diisi.',
            'Kapasitas.integer' => 'Kapasitas harus berupa angka.',
            'Kapasitas.min' => 'Kapasitas minimal harus 1.',
            'FotoTempat.image' => 'Foto tempat harus berupa file gambar.',
            'FotoTempat.mimes' => 'Format file gambar yang diizinkan adalah jpeg, png, jpg',
            'FotoTempat.max' => 'Ukuran file gambar maksimum adalah 2 MB.',
        ];
    }
}
