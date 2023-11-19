import { useForm } from "@inertiajs/react";

export default function Create({ tempats, auth, header }) {
    // console.log(props);
    console.log(tempats);

    const { data, setData, post, errors } = useForm({
        nama_tempat: "",
        deskripsi: "",
        alamat: "",
        kapasitas: "",
        harga: "",
        foto_tempat: null,
        kontak: "",
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

        post(route("tempats.store"), formData);
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-3xl font-bold mb-4">Tambah Tempat</h1>

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
                <div className="mb-4">
                    <label
                        htmlFor="deskripsi"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Deskripsi
                    </label>
                    <textarea
                        id="deskripsi"
                        type="text"
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
                <div className="mb-4">
                    <label
                        htmlFor="alamat"
                        className="block text-sm font-medium text-gray-600"
                    >
                        alamat
                    </label>
                    <textarea
                        id="alamat"
                        type="text"
                        className={`mt-1 p-2 border ${
                            errors.alamat ? "border-red-500" : "border-gray-300"
                        } rounded w-full`}
                        value={data.alamat}
                        onChange={(e) => setData("alamat", e.target.value)}
                    />
                    {errors.alamat && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.alamat}
                        </p>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="kapasitas"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Kapasitas
                    </label>
                    <input
                        id="kapasitas"
                        type="number"
                        className={`mt-1 p-2 border ${
                            errors.kapasitas
                                ? "border-red-500"
                                : "border-gray-300"
                        } rounded w-full`}
                        value={data.kapasitas}
                        onChange={(e) => setData("kapasitas", e.target.value)}
                    />
                    {errors.kapasitas && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.kapasitas}
                        </p>
                    )}
                </div>
                <div className="mb-4">
                    <label
                        htmlFor="harga"
                        className="block text-sm font-medium text-gray-600"
                    >
                        harga
                    </label>
                    <input
                        id="harga"
                        type="number"
                        className={`mt-1 p-2 border ${
                            errors.harga ? "border-red-500" : "border-gray-300"
                        } rounded w-full`}
                        value={data.harga}
                        onChange={(e) => setData("harga", e.target.value)}
                    />
                    {errors.harga && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.harga}
                        </p>
                    )}
                </div>

                <div className="mb-4">
                    <label
                        htmlFor="foto_tempat"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Foto Tempat
                    </label>
                    <input
                        id="foto_tempat"
                        type="file"
                        accept="image/*"
                        className={`mt-1 p-2 border ${
                            errors.foto_tempat
                                ? "border-red-500"
                                : "border-gray-300"
                        } rounded w-full`}
                        onChange={(e) =>
                            setData("foto_tempat", e.target.files[0])
                        }
                    />
                    {errors.foto_tempat && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.foto_tempat}
                        </p>
                    )}
                </div>

                <div className="mb-4">
                    <label
                        htmlFor="kontak"
                        className="block text-sm font-medium text-gray-600"
                    >
                        Kontak
                    </label>
                    <input
                        id="kontak"
                        type="number"
                        className={`mt-1 p-2 border ${
                            errors.kontak ? "border-red-500" : "border-gray-300"
                        } rounded w-full`}
                        value={data.kontak}
                        onChange={(e) => setData("kontak", e.target.value)}
                    />
                    {errors.kontak && (
                        <p className="text-red-500 text-xs mt-1">
                            {errors.kontak}
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
