@extends('layout.public')
@section('content')

    <main class="container mx-auto px-5 md:px-9">
        <section class="py-8 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-center mb-6">@lang('messages.contact_us')</h2>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <!-- Bagian Kiri -->
                    <div class="w-full md:w-1/3 bg-white p-6 rounded-md shadow">
                        <p class="text-gray-600 mb-4 text-sm">
                            {{ translate($contact->description, session('locale', 'en')) }}
                        </p>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">@lang('messages.address')</h4>
                            <p class="text-gray-700 text-sm">{{ $contact->address }}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">@lang('messages.phone_number')</h4>
                            <p class="text-gray-700 text-sm">{{ $contact->phone }}</p>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-semibold text-yellow-500 text-sm">@lang('messages.email_address')</h4>
                            <p class="text-gray-700 text-sm">
                                {{ $contact->email }}
                            </p>
                        </div>
                    </div>

                    <!-- Bagian Kanan -->
                    <div class="w-full md:w-1/2 bg-white p-6 rounded-md shadow">
                        <h3 class="text-lg font-semibold mb-3">@lang('messages.get_in_touch')</h3>
                        <p class="text-gray-600 mb-4 text-sm">
                            {{ translate('Feel free to contact with us, we love to make new partners & friends', session('locale', 'en')) }}
                        </p>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="flex gap-2 mb-3">
                                <input type="text" name="first_name" placeholder="{{ translate('First name...', session('locale', 'en')) }}"
                                    class="w-1/2 p-2 bg-white outline outline-1 outline-gray-400 rounded">
                                <input type="text" name="last_name" placeholder="{{ translate('Last name...', session('locale', 'en')) }}"
                                    class="w-1/2 p-2 bg-white outline outline-1 outline-gray-400 rounded">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="{{ translate('Email Address', session('locale', 'en')) }}"
                                    class="w-full p-2 bg-white outline outline-1 outline-gray-400 rounded">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" placeholder="{{ translate('Phone Number', session('locale', 'en')) }}"
                                    class="w-full p-2 bg-white outline outline-1 outline-gray-400 rounded">
                            </div>
                            <div class="mb-4">
                                <textarea name="message" placeholder="{{ translate('Message Subject', session('locale', 'en')) }}" rows="3"
                                    class="w-full p-2 bg-white outline outline-1 outline-gray-400 rounded"></textarea>
                            </div>
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md flex items-center gap-2 text-sm">
                                    @lang('messages.send_message')
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15854.846364188767!2d106.75110468715819!3d-6.558045100000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5dce5b6ebd3%3A0x7ba6ffb5d199befe!2sSekolah%20Tinggi%20Pariwisata%20Bogor!5e0!3m2!1sen!2sid!4v1739505068278!5m2!1sen!2sid"
                class="w-full h-80" allowfullscreen="true" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>
@endsection