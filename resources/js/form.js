import axiosClient from "./axiosClient";
import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", async() => {
    const token = localStorage.getItem("access_token");

    if (!token) {
        localStorage.removeItem("access_token");
        window.location.href = "signin";
        return;
    }

    const pathSegments = window.location.pathname.split("/");
    const id = pathSegments[pathSegments.length - 1];

    const isEditMove = !isNaN(parseInt(id));
    

    if (isEditMove) {
        try {
            const response = await axiosClient.post("/movie/findMovie", {
                id: id,
            });

            if (response.data.movie && response.data.movie.length > 0) {
                const movie = response.data.movie[0];

                document.getElementById("title").value = movie.title;
                document.getElementById("description").value = movie.description;
                document.getElementById("price").value = movie.price;
                document.getElementById("date").value = movie.release_date;
            }
        } catch (error) {
            console.log(error);
        }
    }

    const form = document.getElementById("movie-form");

    if (form) {
        form.addEventListener("submit", async (e) => {
            try {
                e.preventDefault();

                const title = document.getElementById("title").value;
                const description =
                    document.getElementById("description").value;
                const price = document.getElementById("price").value;
                const date = document.getElementById("date").value;

                document.getElementById("title-error").classList.add("hidden");
                document
                    .getElementById("description-error")
                    .classList.add("hidden");
                document.getElementById("price-error").classList.add("hidden");
                document.getElementById("date-error").classList.add("hidden");

                if (isEditMove) {
                    const response = await axiosClient.post("/movie/update", {
                        id: id,
                        title: title,
                        description: description,
                        price: parseFloat(price),
                        release_date: date,
                    });

                    if (response.data.message) {
                        Swal.fire({
                            icon: "success",
                            title: "Updated successfully",
                            showConfirmButton: false,
                            timer: 1500,
                            didClose: () => {
                                window.location.href = "/movie";
                            },
                        });
                        return;
                    }
                } else {
                    const response = await axiosClient.post("/movie/create", {
                        title: title,
                        description: description,
                        price: parseFloat(price),
                        release_date: date,
                    });

                    if (response.data.message) {
                        Swal.fire({
                            icon: "success",
                            title: "Registered successfully",
                            showConfirmButton: false,
                            timer: 1500,
                            didClose: () => {
                                window.location.href = "/movie";
                            },
                        });
                        return;
                    }
                }
            } catch (error) {
                if (error.response?.status == 422) {
                    const errors = error.response.data.errors;

                    if (errors.title) {
                        const el = document.getElementById("title-error");
                        el.innerHTML = errors.title[0];
                        el.classList.remove("hidden");
                    }

                    if (errors.description) {
                        const el = document.getElementById("description-error");
                        (el.innerHTML = errors.description[0]),
                            el.classList.remove("hidden");
                    }

                    if (errors.price) {
                        const el = document.getElementById("price-error");
                        el.innerHTML = errors.price[0];
                        el.classList.remove("hidden");
                    }

                    if (errors.release_date) {
                        const el = document.getElementById("date-error");
                        el.innerHTML = errors.release_date[0];
                        el.classList.remove("hidden");
                    }
                }
            }
        });
    }
});
