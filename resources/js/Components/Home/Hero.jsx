import React from "react";
import Gambar from "../../../img/test.png";
export default function Hero(props) {
    return (
        <section className="pt-36">
            <div className="container">
                <div className="flex flex-wrap">
                    <div className="w-full self-center px-4 lg:w-1/2 ">
                        <h1 className="text-base font-semibold text-primary md:text-xl">
                            Halo semua 👋 Nama Saya
                            <span className="block font-bold text-dark text-4xl mt-1 lg:text-5xl">
                                Railan Zalali
                            </span>
                        </h1>
                        <h2 className="font-medium text-slate-500 text-lg mb-5 lg:text-2xl">
                            Web Develover &
                            <span className="text-dark"> Freelancer </span>
                        </h2>
                        <p className="font-medium text-slate-400 mb-10 leading-relaxed">
                            Belajar Web Itu pusing bukan ?
                            <span className="text-dark font-bold">Yaaa !</span>
                        </p>
                        <a
                            href="/tiket"
                            className="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full hover:shadow-lg hover:opacity-90 transition duration-300 ease-in-out"
                        >
                            Pesan Sekarang
                        </a>
                    </div>

                    <div className="w-full self-end px-4 lg:w-1/2">
                        <div className="relative mt-10 lg:mt-0 lg:right-0">
                            <img
                                src={Gambar}
                                alt="railan"
                                className="max-w-full mx-auto"
                            />
                            <span className="absolute -bottom-20 -z-10 left-1/2 -translate-x-1/2 md:scale-125">
                                <svg
                                    width={400}
                                    height={400}
                                    viewBox="0 0 200 200"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill="#14b8a6"
                                        d="M65.7,-22C72.8,0.6,57.8,29.7,34.4,46.5C11,63.3,-20.7,67.8,-42.4,53.2C-64.1,38.6,-75.8,5.1,-67.1,-19.7C-58.3,-44.6,-29.2,-60.7,0.1,-60.8C29.3,-60.8,58.5,-44.7,65.7,-22Z"
                                        transform="translate(100 100) scale(1.1)"
                                    />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
