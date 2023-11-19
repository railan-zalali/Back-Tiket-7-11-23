// resources/js/Pages/Tempat/Edit.jsx

import { useForm } from "@inertiajs/react";
import React, { useState } from "react";

// export default function Edit(props) {
export default function Edit({ tempat }) {
    // console.log("edit", props);
    console.log("edit", tempat);
    const { data, setData, put, errors } = useForm({
        nama_tempat: tempat.nama_tempat,
        deskripsi: tempat.deskripsi,
        alamat: tempat.alamat,
        kapasitas: tempat.kapasitas,
        harga: tempat.harga,
        foto_tempat: tempat.foto_tempat,
        kontak: tempat.kontak,
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        // Menggunakan FormData untuk mengirim file (foto_tempat)
        const formData = new FormData();
        formData.append("nama_tempat", data.nama_tempat);
        formData.append("deskripsi", data.deskripsi);
        formData.append("alamat", data.alamat);
        formData.append("kapasitas", data.kapasitas);
        formData.append("harga", data.harga);
        formData.append("foto_tempat", data.foto_tempat);
        formData.append("kontak", data.kontak);

        put(route("tempats.update", tempat.id), formData);
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-3xl font-bold mb-4">Edit Tempat</h1>

            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div className="mb-4">
                    <label
                        htmlFor="nama_tempat"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Nama Tempat
                    </label>
                    <input
                        id="nama_tempat"
                        type="text"
                        className={`mt-1 p-2 border ${
                            errors.nama_tempat
                                ? "border-red-500"
                                : "border-gray-300"
                        } rounded w-full`}
                        value={data.nama_tempat}
                        onChange={(e) => setData("nama_tempat", e.target.value)}
                    />
                    {errors.nama_tempat && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.nama_tempat}
                        </p>
                    )}
                </div>

                {/* Deskripsi */}
                <div className="mb-4">
                    <label
                        htmlFor="deskripsi"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Deskripsi
                    </label>
                    <textarea
                        id="deskripsi"
                        className={`mt-1 p-2 border ${
                            errors.deskripsi
                                ? "border-red-500"
                                : "border-gray-300"
                        } rounded w-full`}
                        value={data.deskripsi}
                        onChange={(e) => setData("deskripsi", e.target.value)}
                    />
                    {errors.deskripsi && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.deskripsi}
                        </p>
                    )}
                </div>

                <div className="mt-4">
                    <button
                        type="submit"
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    );
}
