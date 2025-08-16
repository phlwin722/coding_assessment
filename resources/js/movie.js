import axiosClient from "./axiosClient";
import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("access_token");
    if (!token) {
        localStorage.removeItem("access_token");
        window.location.href = "signin";
        return;
    }

    const sidebarBtn = document.getElementById('sidabar-button');
    const sidebarMobile = document.getElementById('sidebar-mobile');
    const overlay = document.getElementById('overlay');
    const sidebarClose = document.getElementById("sidebarclose-mobile")

    sidebarBtn.addEventListener('click', () => {
        sidebarMobile.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebarMobile.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    sidebarClose.addEventListener('click', function () {
        sidebarMobile.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    document.getElementById("add-form").addEventListener("click", function () {
        window.location.href = "form";
        return;
    });

    document.querySelectorAll(".logout-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault(); // prevent <a href="#"> from jumping
            localStorage.removeItem("access_token");
            localStorage.removeItem("user");
            window.location.href = "signin";
        });
    });

    const fetchData = async () => {
        try {
            const response = await axiosClient.post("/movie/index");

            const movie = response.data.movie;

            const tbody = document.querySelector("tbody");

            tbody.innerHTML = "";

            if (movie.length === 0) {
                const noDataRow = document.createElement("tr");

                noDataRow.innerHTML = `
                    <td colspan="5" class="text-center py-6 text-gray-500">No data found</td>
                `;
                tbody.appendChild(noDataRow);
                return;
            }

            // Use .map() to generate rows and join them into a single HTML string
            const rows = movie
                .map(
                    (movie) => `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium">${movie.title}</td>
                    <td class="px-6 py-4">${movie.description}</td>
                    <td class="px-6 py-4">$${parseFloat(movie.price).toFixed(
                        2
                    )}</td>
                    <td class="px-6 py-4">${movie.release_date}</td>
                    <td class="px-6 py-4 text-center">
                        <button onclick="editMovie(${
                            movie.id
                        })" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</button>
                        <button onclick="deleteMovie(${
                            movie.id
                        })" class="text-red-600 hover:text-red-900 font-semibold ml-3">Delete</button>
                    </td>
                </tr>`
                )
                .join("");

            // Inject all rows at once
            tbody.innerHTML = rows;
        } catch (error) {
            console.log(error);
        }
    };

    window.editMovie = function (id) {
        window.location.href = `/form/${id}`;
    };

    window.deleteMovie = async function (id) {
        Swal.fire({
            title: "Do you want to save the changes?",
            showCancelButton: true,
            confirmButtonText: "Delete",
        }).then(async(result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                try {
                    const response = await axiosClient.post(`/movie/delete`, {
                        id: id
                    });

                    if (response.data.message) {
                        fetchData();
                        Swal.fire({
                            icon: "success",
                            title: "Deleted successfully",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                } catch (error) {
                    console.error("Failed to delete movie:", error);
                }
            }
        });
    };

    fetchData();
});
