<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset ('assets/css/styles.css')}}">
    <title>Customer Information Entry Form</title>
</head>
<body>
    <div class="header">
        <a class="form-page" href="/">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page" href="/review">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="form-wrapper">
        <form action="/save" method="POST" class="customer-info">
            @csrf
            <div class="input-wrapper profile">
                <label for="filepath">Profile picture:</label>
                <input type="file" id="image" name="filepath" accept="image/*" required>
                @error('filepath')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <img id="image-holder" src="" alt="preview image" style="max-height: 50px; display:none;">
            <div class="input-wrapper">
                <label for="firstname">Firstname: </label>
                <input type="text" name="firstname" id="firstname" required/>
                @error('firstname')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="input-wrapper">
                <label for="lastname">Lastname: </label>
                <input type="text" name="lastname" id="lastname" required />
                @error('lastname')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="input-wrapper">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email"/>
                @error('email')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror

            </div>
            <div class="input-wrapper">
                <label for="city">City: </label>
                <input type="text" name="city" id="city" required />
                @error('city')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="input-wrapper">
                <label for="country">Country: </label>
                <select name="country" id="country" required>
                    <option disabled selected value> -- select an option -- </option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="Japan">Japan</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                </select>
                @error('country')
                    <p style="color: red; font-size: 0.5em; margin: 0;">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="action">
                <button onclick="resetFields()">CANCEL</button>
                <button type="submit">SAVE</button>
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
                document.getElementById("firstname").value = "";
                document.getElementById("lastname").value = "";
                document.getElementById("email").value = "";
                document.getElementById("city").value = "";
                document.getElementById("country").value = "";
            }

        </script>
    </div>
</body>
</html>