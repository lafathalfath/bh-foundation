@extends('layout.public')
@section('content')

    <main class="container mx-auto px-5 md:px-9">
        <section class="py-8 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-center mb-6">Contact Us</h2>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <!-- Bagian Kiri -->
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-md shadow">
                        <p class="text-gray-600 mb-4 text-sm">
                            Will you be in Los Angeles or any other branches any time soon? Stop by the office! We'd love to
                            meet.
                        </p>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">ADDRESS</h4>
                            <p class="text-gray-700 text-sm">1702 Olympic Boulevard<br>Santa Monica, CA 90404</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">PHONE NUMBER</h4>
                            <p class="text-gray-700 text-sm">(480) 555-0103<br>(219) 555-0114</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">EMAIL ADDRESS</h4>
                            <p class="text-gray-700 text-sm">
                                help.eduguard@gmail.com<br>
                                career.eduguard@gmail.com
                            </p>
                        </div>
                    </div>

                    <!-- Bagian Kanan -->
                    <div class="w-full md:w-1/2 bg-white p-6 rounded-md shadow">
                        <h3 class="text-lg font-semibold mb-3">Get In Touch</h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            Feel free contact with us, we love to make new partners & friends
                        </p>
                        <form>
                            <div class="flex gap-2 mb-3">
                                <input type="text" placeholder="First name..."
                                    class="w-1/2 p-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <input type="text" placeholder="Last name..."
                                    class="w-1/2 p-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                            <div class="mb-3">
                                <input type="email" placeholder="Email Address"
                                    class="w-full p-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                            <div class="mb-3">
                                <input type="text" placeholder="Message Subject"
                                    class="w-full p-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                            <div class="mb-4">
                                <textarea placeholder="Message Subject" rows="3"
                                    class="w-full p-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md flex items-center gap-2 text-sm">
                                Send Message
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15854.846364188767!2d106.75110468715819!3d-6.558045100000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5dce5b6ebd3%3A0x7ba6ffb5d199befe!2sSekolah%20Tinggi%20Pariwisata%20Bogor!5e0!3m2!1sen!2sid!4v1739505068278!5m2!1sen!2sid" 
            width="1450" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>
@endsection