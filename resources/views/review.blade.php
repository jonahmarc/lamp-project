<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="{{asset ('assets/css/styles.css')}}"> -->
    <title>Customer Information Review Page</title>
</head>
<body class="grid h-screen w-screen m-0 grid-rows-8 bg-cyan-100">
    <div class="row-span-1 flex w-full justify-end items-center bg-cyan-900 shadow-xl text-cyan-100">
        <a class="form-page hover:underline" href="/">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page ml-4 hover:underline" href="/review">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="form-wrapper row-span-7 flex flex-wrap pt-10">
        <div class="flex-initial w-1/2 grid grid-rows-8">
            <form  action="/info" method="GET"class="row-span-2 flex flex-wrap px-10 justify-center content-center">
                <div class="grid content-center">
                    <p class="text-cyan-900 font-bold align-middle">Email</p>
                </div>
                <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-1/3 h-1/4 py-2 px-4 mx-2 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="email" id="inline-email" type="email" value="">
                <button type="submit" class="shadow bg-cyan-900 w-1/8 h-1/4 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    SEARCH
                </button>
                @error('email')
                    <div class="grid content-center w-full">
                        <p class="text-red-600 font-bold align-middle">{{ $message }}</p>
                    </div>
                @enderror
            </form>
            <div class="row-span-6 flex justify-center">
                <div class="w-4/12">
                    @foreach ($customer as $key => $info)
                        @if ($key == 'error')
                            <div class="flex flex-wrap justify-between content-start">
                                <div class="grid content-center mr-2">
                                    <p class="uppercase italic text-red-600 font-bold align-middle">{{ $key }}</p>
                                </div>
                                <div class="grid content-center">
                                    <p class="text-red-600 font-bold align-middle">{{ $info }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-wrap justify-between content-start">
                                <div class="grid content-start mr-2">
                                    <p class="capitalize italic text-cyan-900 font-bold align-middle">{{ $key }}</p>
                                </div>
                                <div class="grid content-start">
                                    <p class="text-cyan-900 align-middle">{{ $info }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-initial w-1/2 justify-center">
            <iframe src="calculator.blade.php" frameborder="0"></iframe>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            sessionStorage.removeItem('image-value');
            sessionStorage.removeItem('image-save');
        });


    </script>
</body>
</html>