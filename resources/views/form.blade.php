<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Information Entry Form</title>
</head>
<body class="grid h-screen w-screen m-0 grid-rows-8 bg-cyan-100">
    <div class="row-span-1 flex w-full justify-end items-center bg-cyan-900 shadow-xl text-cyan-100">
        <a class="form-page hover:underline" href="/">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page ml-4 hover:underline" href="/review">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="form-wrapper row-span-7 grid content-start justify-center pt-10">
        <form action="/save" method="POST"  class="w-full max-w-sm">
            @csrf
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-3/3">
                    <label class="block">
                        <span class="sr-only">Choose File</span>
                        <input name="filepath" id="image" type="file" class="block w-full text-sm text-cyan-500
                            file:me-4 file:py-2 file:px-3
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-cyan-900
                            hover:file:bg-cyan-300
                            file:disabled:opacity-50 file:disabled:pointer-events-none
                            dark:file:bg-cyan-200
                            dark:hover:file:bg-cyan-50
                        ">
                    </label>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6" id="image">
                <div class="md:w-3/3">
                    <img id="image-holder" src="" alt="preview image" style="max-height: 70px; display:none;">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-last-name">
                        Last Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="lastname" id="inline-last-name" type="text" value="">
                </div>
            </div>
            @error('lastname')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-3/3">
                        <p class="m-0 text-base text-red-600">
                            {{$message}}
                        </p>
                    </div>
                </div>
            @enderror
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-first-name">
                        First Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="firstname" id="inline-first-name" type="text" value="">
                </div>
            </div>
            @error('firstname')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-3/3">
                        <p class="m-0 text-base text-red-600">
                            {{$message}}
                        </p>
                    </div>
                </div>
            @enderror
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-email">
                        Email
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="email" id="inline-email" type="email" value="">
                </div>
            </div>
            @error('email')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-3/3">
                        <p class="m-0 text-base text-red-600">
                            {{$message}}
                        </p>
                    </div>
                </div>
            @enderror
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-city">
                        City
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="city" id="inline-city" type="text" value="">
                </div>
            </div>
            @error('city')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-3/3">
                        <p class="m-0 text-base text-red-600">
                            {{$message}}
                        </p>
                    </div>
                </div>
            @enderror
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-country">
                        Country
                    </label>
                </div>
                <div class="md:w-2/3">
                    <select class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="country" id="inline-country" required>
                        <option disabled selected value> Select Country </option>
                        <option value="United States">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="Japan">Japan</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                    </select>
                </div>
            </div>
            @error('country')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-3/3">
                        <p class="m-0 text-base text-red-600">
                            {{$message}}
                        </p>
                    </div>
                </div>
            @enderror
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-1/3">
                    <button onclick="resetFields()" class="shadow bg-cyan-50 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-cyan-900 font-bold py-2 px-4 rounded" type="button">
                        CANCEL
                    </button>
                </div>
                <div class="md:w-1/3 grid justify-end">
                    <button type="submit" class="shadow bg-cyan-900 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                        SAVE
                    </button>
                </div>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {

                // Check if there is a stored image URL in local storage
                var storedImage = sessionStorage.getItem('image-save');
                if (storedImage) {
                    var output = document.getElementById('image-holder');
                    output.src = storedImage;
                    output.style.display = "block"
                }
                var storedValue = sessionStorage.getItem('image-value');
                if (storedValue) {
                    const fileInput = document.getElementById('image');

                    // Create a new File object
                    const myFile = new File([storedImage], storedValue, {
                        type: 'image/jpeg',
                        lastModified: new Date(),
                    });

                    // Now let's create a DataTransfer to get a FileList
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(myFile);
                    fileInput.files = dataTransfer.files;
                }

            });

            $(document).ready(function (e) {
                $('#image').change(function(){
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image-holder').attr('src', e.target.result);
                        const imagePath = document.getElementById('image').value
                        const imageName = imagePath.substring(12)
                        sessionStorage.setItem('image-value', imageName);
                        sessionStorage.setItem('image-save', reader.result);
                    }
                    document.getElementById("image-holder").style.display = "block";
                    reader.readAsDataURL(this.files[0]);

                });
            });

            function resetFields() {
                document.getElementById("inline-first-name").value = "";
                document.getElementById("inline-last-name").value = "";
                document.getElementById("inline-email").value = "";
                document.getElementById("inline-city").value = "";
                document.getElementById("inline-country").value = "";
            }
        </script>
    </div>
</body>
</html>