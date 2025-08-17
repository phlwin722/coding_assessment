import './bootstrap';
import axiosClient from './axiosClient';
import Swal from 'sweetalert2'

document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('signup-form')

    if (form) {
        form.addEventListener('submit', async (e) => {
            try {
                e.preventDefault();

                const firstName = document.getElementById('first-name').value
                const lastName = document.getElementById('last-name').value
                const email = document.getElementById('email').value
                const password = document.getElementById('password').value

                document.getElementById('firstname-error').classList.add('hidden')
                document.getElementById('lastname-error').classList.add('hidden')
                document.getElementById('email-error').classList.add('hidden')
                document.getElementById('password-error').classList.add('hidden')

                const response = await axiosClient.post('/auth/signup', {
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    password: password,
                });

                if (response.data.message) {
                    Swal.fire({
                        icon: "success",
                        title: "Registered successfully",
                        showConfirmButton: false,
                        timer: 1500,
                        didClose: () => {
                            window.location.href='/signin'
                        }
                      });
                }

            } catch (error) {
                if (error.response?.status === 422) {
                    const errors = error.response.data.errors

                    if (errors.first_name) {
                        const el = document.getElementById('firstname-error')
                        el.innerHTML = errors.first_name[0];
                        el.classList.remove("hidden")
                    }

                    if (errors.last_name) {
                        const el = document.getElementById('lastname-error')
                        el.innerHTML = errors.last_name[0];
                        el.classList.remove('hidden')
                    }

                    if (errors.email) {
                        const el = document.getElementById('email-error');
                        el.innerHTML = errors.email[0]
                        el.classList.remove('hidden')
                    }

                    if (errors.password) {
                        const el = document.getElementById('password-error');
                        el.innerHTML = errors.password[0]
                        el.classList.remove('hidden')
                    }
                }
            }
        });
    }
});