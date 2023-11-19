import Nav from "@/Components/Tiket/Nav";
import React, { useState } from "react";
import gambar from "../../img/test.png";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { Link, router } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";

// export default function Cart(props) {
export default function Cart({ auth, data }) {
    const [loading, setLoading] = useState(false);

    console.log("cart", auth);
    console.log("cart", data);

    async function destroy(id) {
        try {
            const response = await axios.delete(`/cart/${id}`);
            toast.success("Item deleted successfully");
        } catch (error) {
            console.error("Error deleting item:", error);
            toast.error("Error deleting item");
        }
    }
    return (
        <>
            <Nav props={auth} />
            <section className="pt-24 pb-32 bg-slate-100">
                <div className="container mx-auto">
                    <div className="w-full px-4">
                        <div className="max-w-xl mx-auto text-center mb-8">
                            <h2 className="font-bold text-dark text-3xl mb-4 sm:text-4xl">
                                Pesanan Kamu
                            </h2>
                        </div>
                    </div>
                    <div className="flex flex-wrap justify-center">
                        <div className="w-full max-w-[520px]">
                            {data ? (
                                data.map((data, i) => {
                                    return (
                                        <div
                                            className="card card-side bg-base-100 shadow-xl mt-4"
                                            key={i}
                                        >
                                            <div className="flex font-sans">
                                                <div className="flex-none w-40 relative">
                                                    {data.tempat
                                                        .foto_tempat && (
                                                        <img
                                                            src={route(
                                                                "foto_tempats.show",
                                                                data.tempat
                                                                    .foto_tempat
                                                            )}
                                                            alt={
                                                                data.nama_tempat
                                                            }
                                                            className="absolute inset-0 w-full h-full object-cover"
                                                        />
                                                    )}
                                                </div>
                                                <form className="flex-auto p-6">
                                                    <div className="flex flex-wrap">
                                                        <h1 className="flex-auto text-lg font-semibold text-slate-900">
                                                            {
                                                                data.tempat
                                                                    .nama_tempat
                                                            }
                                                        </h1>
                                                        <div className="text-lg font-semibold text-slate-500 ms-8">
                                                            Rp. {data.harga}
                                                        </div>
                                                    </div>
                                                    <div className="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                                                        <div className="space-x-2 flex text-sm">
                                                            <label>
                                                                <div className="w-20 h-9 rounded-lg flex items-center justify-center bg-primary text-white">
                                                                    {
                                                                        data.tipe_tiket
                                                                    }
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div className="flex space-x-4 mb-6 text-sm font-medium">
                                                        <div className="flex-auto flex space-x-4">
                                                            <button
                                                                className="h-10 px-6 font-semibold rounded-md bg-black text-white"
                                                                type="submit"
                                                            >
                                                                Buy now
                                                            </button>
                                                            <button
                                                                onClick={() =>
                                                                    destroy(
                                                                        data.id
                                                                    )
                                                                }
                                                                tabIndex="-1"
                                                                type="button"
                                                                className="h-10 px-6 font-semibold rounded-md border border-slate-300 text-slate-900"
                                                            >
                                                                Delete
                                                            </button>
                                                            <SecondaryButton
                                                                method="DELETE"
                                                                className="btn btn-ghost btn-block text-sm"
                                                                href={route(
                                                                    "cart.destroy",
                                                                    data.id
                                                                )}
                                                                as="button"
                                                            >
                                                                Delete
                                                            </SecondaryButton>
                                                            {/* <ResponsiveNavLink
                                                                method="DELETE"
                                                                className="btn btn-ghost btn-block text-sm"
                                                                href={route(
                                                                    "cart.destroy",
                                                                    data.id
                                                                )}
                                                                as="button"
                                                            >
                                                                Back Tiket
                                                            </ResponsiveNavLink> */}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    );
                                })
                            ) : (
                                <div>belum ada data</div>
                            )}
                        </div>
                    </div>
                </div>
                <ToastContainer />
            </section>
        </>
    );
}
