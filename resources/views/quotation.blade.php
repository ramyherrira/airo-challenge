<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>A Really Nice Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
            <a
                href="{{ url('/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Dashboard
            </a>
            @else
            <a
                href="{{ route('login') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                Log in
            </a>

            @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Register
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </header>
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div>
            <div class="border-b border-gray-900/10 pb-12">
                <form id="quotation-form">
                    <h2 class="text-base/7 font-semibold text-gray-900">Quotation Form</h2>

                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert" id="errors-block">
                        <p class="font-bold flex items-center">
                            X Errors
                        </p>
                        <ul id="errors-list" class="list-disc list-inside">

                        </ul>
                    </div>

                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert" id="quotation-success">
                        <p class="font-bold flex items-center">
                            ✅ Quotation
                        </p>
                        <ul class="list-disc list-inside">
                            <li>ID: <span id="quotation-id"></span></li>
                            <li>Currency: <span id="curr"></span></li>
                            <li>Total <span id="total"></span></li>
                        </ul>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-8">
                            <label for="age" class="block text-sm/6 font-medium text-gray-900">Age</label>
                            <div class="mt-2">
                                <input type="text" name="age" id="age" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Comma-separated list of ages eg: 34,18,62">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="currency" class="block text-sm/6 font-medium text-gray-900">Currency</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="currency" name="currency_id" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="EUR">€ EUR</option>
                                    <option value="USD">$ USD</option>
                                    <option value="CNY">¥ CNY</option>
                                    <option value="TND">TND</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-8 sm:col-start-1">
                            <label for="start-date" class="block text-sm/6 font-medium text-gray-900">Start date</label>
                            <div class="mt-2">
                                <input type="date" name="start_date" id="start-date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="eg: 2024-10-23">
                            </div>
                        </div>

                        <div class="sm:col-span-8">
                            <label for="end-date" class="block text-sm/6 font-medium text-gray-900">End date</label>
                            <div class="mt-2">
                                <input type="date" name="end_date" id="end-date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="eg: 2024-10-23">
                            </div>
                        </div>

                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    async function sendData(token) {
        const age = document.querySelector("#age");
        const currency = document.querySelector("#currency");
        const startDate = document.querySelector("#start-date");
        const endDate = document.querySelector("#end-date");
        const errorsDiv = document.querySelector("#errors-list");

        const quotationId = document.querySelector("#quotation-id");
        const resultedCurrency = document.querySelector("#curr");
        const total = document.querySelector("#total");
        
        try {
            errorsDiv.innerHTML = "";
            const response = await fetch("/api/quotation", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token,
                },
                body: JSON.stringify({
                    "age": age.value,
                    "currency_id": currency.value,
                    "start_date": startDate.value,
                    "end_date": endDate.value,
                }),
            });
            const json = await response.json();
            console.log(json);

            if (response.status === 201) {
                quotationId.innerHTML = json.quotation_id;
                resultedCurrency.innerHTML = json.currency_id;
                total.innerHTML = json.total;
            }

            if (response.status === 422) {
                console.log(errorsDiv);

                Object.values(json.errors).forEach((errors) => {
                    const li = document.createElement("li");
                    const text = document.createTextNode(errors[0]);
                    li.appendChild(text);

                    errorsDiv.appendChild(li);
                });
            }


        } catch (e) {
            console.error(e);
        }
    }

    async function getToken() {
        return '';
    }

    const form = document.querySelector("#quotation-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const token = getToken();

        sendData(token);
    });
</script>

</html>