import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Html5QrcodeScanner } from "html5-qrcode";
import { useEffect, useState } from "react";
import axios from "axios";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Index = ({ auth }) => {
    const [scanResult, setScanResult] = useState(null);

    useEffect(() => {
        const scanner = new Html5QrcodeScanner("reader", {
            qrbox: {
                width: 250,
                height: 250,
            },
            fps: 5,
        });

        scanner.render((decodedText, decodedResult) => success(decodedText), {
            qrCodeErrorCallback: (error) => handleError(error),
        });

        function success(decodedText) {
            setScanResult(decodedText);

            // Memisahkan data menjadi array berdasarkan koma
            const dataArray = decodedText.split(",");

            // Kirim data ke backend Laravel
            sendDataToBackend(dataArray);
        }

        function handleError(err) {
            console.log(err);
        }

        // Cleanup function for useEffect
        return () => {
            scanner.stop();
        };
    }, []);

    // Kirim data ke backend Laravel menggunakan Axios
    const sendDataToBackend = (dataArray) => {
        axios
            .post("/pay", {
                barcodeData: dataArray,
            })
            .then((response) => {
                console.log("Success:", response.data);
                toast.success("Data barcode berhasil disimpan!");
            })
            .catch((error) => {
                console.error("Error:", error);
                toast.error("Gagal menyimpan data barcode.");
            });
    };

    console.log(scanResult);

    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Pembayaran
                    </h2>
                }
            >
                <div>
                    <div className="container mx-auto p-4">
                        <div className="py-4">
                            <div className="w-full mx-auto min-h-screen sm:px-6 lg:px-8">
                                <div className="bg-slate-500 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div className="p-6 bg-white border-b border-gray-200">
                                        <div className="flex items-center justify-center">
                                            {scanResult ? (
                                                <div className="w-full max-w-sm">
                                                    Success:{" "}
                                                    <a href={scanResult}>
                                                        {scanResult}
                                                    </a>
                                                </div>
                                            ) : (
                                                <div
                                                    id="reader"
                                                    className="w-full max-w-sm"
                                                ></div>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ToastContainer />
            </AuthenticatedLayout>
        </>
    );
};

export default Index;
