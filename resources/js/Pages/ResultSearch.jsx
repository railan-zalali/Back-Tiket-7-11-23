import React from "react";
import { connect } from "react-redux";
import { addToCart } from "@/actions";

import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import Nav from "@/Components/Tiket/Nav";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const ResultSearch = ({ auth, addToCart, result, dateAndDays, result }) => {
    console.log(addToCart);
    // const id = auth.user.id;
    // const tempat = searchResults[0].nama_tempat;
    // const harga = searchResults[0].harga;

    const submit = (e) => {
        e.preventDefault();

        const formData = {
            id: auth.user.id,
            nama_tempat: e.target.nama_tempat.value,
            tempatId: searchResults[0].id,
            tanggal: e.target.tanggal.value,
            harga: e.target.harga.value,
            ticketType: e.target.ticketType.value,
        };

        addToCart(formData); // Pastikan bahwa ini sesuai dengan fungsi yang diimpor (addToCart, bukan addToCart2)

        toast.success("Data berhasil dikirim", {
            position: "bottom-right",
            autoClose: 3000,
        });

        // Lanjutkan dengan kode pengiriman data ke server jika diperlukan
    };

    return (
        <>
            <Nav />

            <section className="pt-24 pb-32 bg-slate-100">
                <div className="container mx-auto">
                    <div className="w-full px-4">
                        <div className="max-w-xl mx-auto text-center mb-8">
                            <h4 className="font-semibold text-lg text-primary mb-2">
                                Cari Tiket
                            </h4>
                            <h2 className="font-bold text-dark text-3xl mb-4 sm:text-4xl">
                                Cari Destinasi Yang Kamu Inginkan
                            </h2>
                        </div>
                    </div>
                    <div className="flex flex-wrap justify-center">
                        <div className="w-full max-w-md">
                            <div className="bg-white rounded-xl shadow-lg overflow-hidden py-6">
                                <div className="flex flex-col w-full justify-center lg:flex-row px-6">
                                    {result.map(data, i)}
                                    <form onSubmit={submit} key={i}>
                                        <div className="py-2">
                                            <label
                                                htmlFor="tempat"
                                                className="label"
                                            >
                                                Tempat yang kamu pilih
                                            </label>
                                            <input
                                                type="text"
                                                className="input input-bordered w-full"
                                                name="nama_tempat"
                                                value={data.nama_tempat}
                                                disabled
                                            />
                                        </div>
                                        <div className="py-2">
                                            <label
                                                htmlFor="tanggal"
                                                className="label"
                                            >
                                                Tanggal
                                            </label>
                                            <select
                                                name="tanggal"
                                                id="tanggal"
                                                className="select select-bordered w-full"
                                            >
                                                {dateAndDays.map(
                                                    (selectDate, index) => (
                                                        <option
                                                            key={index}
                                                            value={
                                                                selectDate.date
                                                            }
                                                        >
                                                            {selectDate.day},
                                                            {selectDate.date}
                                                        </option>
                                                    )
                                                )}
                                            </select>
                                        </div>
                                        <div className="py-2">
                                            <label
                                                htmlFor="ticketType"
                                                className="label"
                                            >
                                                Tipe Tiket
                                            </label>
                                            <select
                                                name="ticketType"
                                                id="ticketType"
                                                className="select select-bordered w-full"
                                            >
                                                <option value="VIP">VIP</option>
                                                <option value="REGULER">
                                                    REGULER
                                                </option>
                                            </select>
                                        </div>
                                        <div className="py-2">
                                            <label
                                                htmlFor="harga"
                                                className="label"
                                            >
                                                Harga
                                            </label>
                                            <input
                                                type="text"
                                                className="input input-bordered w-full"
                                                name="harga"
                                                value={harga}
                                                disabled
                                            />
                                        </div>
                                        <div className="py-4 px-6">
                                            <button className="btn btn-primary btn-block font-bold">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div className="py-2 px-6">
                                    <ResponsiveNavLink
                                        method="get"
                                        className="btn btn-ghost btn-block text-sm"
                                        href={route("tiket")}
                                        as="button"
                                    >
                                        Back Tiket
                                    </ResponsiveNavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ToastContainer />
            </section>
        </>
    );
};

export default connect(null, { addToCart })(ResultSearch);
