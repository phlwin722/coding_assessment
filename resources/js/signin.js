import axiosClient from "./axiosClient";

document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("signin-form");

    if (form) {
        form.addEventListener("submit", async (e) => {
            try {
                e.preventDefault();
                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;

                document.getElementById("email-error").classList.add("hidden");
                document
                    .getElementById("password-error")
                    .classList.add("hidden");
                document
                    .getElementById("validation-error")
                    .classList.add("hidden");
                document.getElementById("validation-message").innerHTML = "";

                const response = await axiosClient.post("/auth/signin", {
                    email: email,
                    password: password,
                });

                if (response.data.message) {
                    localStorage.setItem("access_token", response.data.token);
                    localStorage.setItem(
                        "user",
                        JSON.stringify(response.data.user)
                    );
                    window.location.href = '/movie'
                    return;
                }
            } catch (error) {
                if (error.response?.status === 422) {
                    const errors = error.response.data.errors;

                    if (errors.email) {
                        const el = document.getElementById("email-error");
                        el.innerHTML = errors.email[0];
                        el.classList.remove("hidden");
                    }

                    if (errors.password) {
                        const el = document.getElementById("password-error");
                        el.innerHTML = errors.password[0];
                        el.classList.remove("hidden");
                    }
                } else if (error.response?.status === 423) {
                    const errors = error.response.data.errors;

                    document
                        .getElementById("validation-error")
                        .classList.remove("hidden");
                    document.getElementById("validation-message").innerHTML =
                        errors;
                }
            }
        });

        const closeIcon = document.querySelector("#validation-error svg");
        if (closeIcon) {
            closeIcon.addEventListener("click", () => {
                document
                    .getElementById("validation-error")
                    .classList.add("hidden");
            });
        }
    }
});
