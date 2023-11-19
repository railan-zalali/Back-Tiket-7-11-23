import React from "react";
import Nav from "@/Components/Home/Nav";
import Hero from "@/Components/Home/Hero";
import About from "@/Components/Home/About";
export default function Home({ auth }) {
    // console.log(auth);
    // console.log("home", auth);
    // console.log(auth.user);
    return (
        <>
            <Nav props={auth} />
            <Hero />
            <About />
            {/* <div className="flex justify-center items-center bg-neutral-600 text-black text-2xl">
                <Head title={props.title} />
                <h1>{props.decs}</h1>
                {props.data
                    ? props.data.map((data, i) => {
                          return (
                              <div key={i}>
                                  <p>{data.namaTempat}</p>
                                  <p>{data.tempatId}</p>
                                  <p>{data.alamat}</p>
                                  <p>{data.kota}</p>
                                  <p>{data.kapasitas}</p>
                              </div>
                          );
                      })
                    : "<p>belum ada data</p>"}
            </div> */}
        </>
    );
}
