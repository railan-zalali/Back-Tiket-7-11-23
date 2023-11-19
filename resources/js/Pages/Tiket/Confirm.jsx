import Nav from "@/Components/Tiket/Nav";
import { router } from "@inertiajs/react";
import { Link } from "react-router-dom";

// const Confirm = (props) => {
const Confirm = ({ data, auth, countBookings }) => {
    console.log(data);
    console.log(countBookings);
    // console.log(props);
    function destroy(e) {
        console.log(e.currentTarget.id);
        if (confirm("Apakah anda yakin ingin menghapus data post ini?")) {
            router.delete(route("confirm.destroy", e.currentTarget.id));
        }
    }
    return (
        <>
            <Nav auth={auth.user} countBookings={countBookings} />
            <div className="container pt-24 pb-32 mx-auto p-4">
                <div className="py-4">
                    {/* <div className="max-w-7xl mx-auto sm:px-6 lg:px-8"> */}
                    <div className="w-full mx-auto sm:px-6 lg:px-8">
                        <div className="bg-slate-500 overflow-hidden shadow-lg sm:rounded-lg">
                            <div className="p-6 bg-white border-b border-gray-200">
                                <div className="flex items-center justify-center mb-6">
                                    <div className="overflow-x-auto">
                                        <table className="table table-lg table-zebra-zebra">
                                            {/* head */}
                                            <thead className="text-black shadow-sm">
                                                <tr>
                                                    <th className="py-2">
                                                        Nama Tempat
                                                    </th>
                                                    <th className="py-2">
                                                        Tipe TIket
                                                    </th>
                                                    <th className="py-2">
                                                        Tanggal
                                                    </th>
                                                    <th className="py-2">
                                                        Jumlah Tiket
                                                    </th>
                                                    <th className="py-2">
                                                        Harga
                                                    </th>
                                                    <th className="py-2">
                                                        Status
                                                    </th>
                                                    <th className="py-2">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {data.map((data, i) => {
                                                    return (
                                                        <tr key={i}>
                                                            <td>
                                                                <div className="flex items-center space-x-3">
                                                                    <div className="avatar">
                                                                        <div className="mask mask-squircle w-12 h-12">
                                                                            {data
                                                                                .tempat
                                                                                .foto_tempat && (
                                                                                <img
                                                                                    src={route(
                                                                                        "foto_tempats.show",
                                                                                        data
                                                                                            .tempat
                                                                                            .foto_tempat
                                                                                    )}
                                                                                    alt={
                                                                                        data
                                                                                            .tempat
                                                                                            .nama_tempat
                                                                                    }
                                                                                    className="w-full max-w-[75px]"
                                                                                />
                                                                            )}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div className="font-bold">
                                                                            {
                                                                                data
                                                                                    .tempat
                                                                                    .nama_tempat
                                                                            }
                                                                            {
                                                                                data.id
                                                                            }
                                                                        </div>
                                                                        <div className="text-base text-gray-700 truncate max-w-xs">
                                                                            {
                                                                                data
                                                                                    .tempat
                                                                                    .deskripsi
                                                                            }
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {
                                                                    data.tipe_tiket
                                                                }
                                                            </td>
                                                            <td>
                                                                {data.tanggal}
                                                            </td>
                                                            <td>
                                                                {
                                                                    data.jumlah_tiket
                                                                }
                                                            </td>
                                                            <td>
                                                                {data.harga}
                                                            </td>
                                                            <td>
                                                                {data.status}
                                                            </td>
                                                            <td>
                                                                <Link
                                                                    href={route(
                                                                        "tempats.edit",
                                                                        data.id
                                                                    )}
                                                                    className="btn btn-success btn-xs hover:text-white mr-2"
                                                                >
                                                                    Confirm
                                                                </Link>
                                                                <button
                                                                    onClick={
                                                                        destroy
                                                                    }
                                                                    id={data.id}
                                                                    tabIndex="-1"
                                                                    type="button"
                                                                    className="btn
                                                                btn-error btn-xs
                                                                text-black
                                                                hover:text-white"
                                                                >
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    );
                                                })}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* <div>
                {data.map((data, i) => {
                    return (
                        <div key={i}>
                            <h1>{data.tempat.nama_tempat}</h1>
                        </div>
                    );
                })}
            </div> */}
        </>
    );
};
export default Confirm;
