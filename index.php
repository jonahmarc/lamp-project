<?php
include_once("connection.php");
$con = connect();

if (isset($_POST["submit"])){
    $email = $_POST['email'];
    $atPos = mb_strpos($email, '@');
    $domain = mb_substr($email, $atPos + 1);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "<strong>" . $email . "</strong> is NOT a valid email address!";
    }
    elseif (!checkdnsrr($domain . '.', 'MX')){
        $error = "Domain <strong>" . $domain . "</strong> is not valid!";
    }
    else {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $sql = "SELECT * FROM customer WHERE email='$email'";
        $students = $con->query($sql) or die ($con->error);
        $row = $students->fetch_assoc();
        $count = $students->num_rows;

        $filename = basename($_FILES['profile']['name']);
        $tempname = $_FILES['profile']['tmp_name'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR."images";
        $target_path = $destination_path . "/" . $filename;

        if ($count == 0){
            $result = move_uploaded_file($tempname, $target_path);

            if (! $result) {
                $profile_error = "Profile picture not uploaded successfully!";
            }
            else {
                $sql = "INSERT INTO customer (`firstname`, `lastname`, `email`, `city`, `country`, `filename`) VALUES ('$firstname', '$lastname', '$email', '$city', '$country', '$filename')";
                $con->query($sql) or die ($con->error);

                echo header("Location: index.php");
            }
        }
        else{
            $prev_filename = $row['email'];
            $result = unlink($destination_path . "/" . $prev_filename);

            if (! $result) {
                $profile_error = "Unable to delete previous profile picture!";
            }
            else {
                $result = move_uploaded_file($tempname, $target_path);

                if (! $result) {
                    $profile_error = "Profile picture not uploaded successfully!";
                }
                else {
                    $sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', city='$city', country='$country', filename='$filename' WHERE email='$email'";
                    $con->query($sql) or die ($con->error);

                    echo header("Location: index.php");
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Information Entry Form</title>
</head>
<body class="grid h-screen w-screen max-w-full m-0 grid-rows-8 bg-cyan-100">
    <div class="row-span-1 flex w-full justify-end items-center bg-cyan-900 shadow-xl text-cyan-100">
        <a class="form-page hover:underline" href="index.php">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page mr-20 ml-4 hover:underline" href="review.php">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="form-wrapper row-span-7 grid content-start justify-center pt-10">
        <form action="" method="POST" enctype="multipart/form-data" class="w-full max-w-sm">
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-last-name">
                        Profile Picture
                    </label>
                </div>
                <div class="md:w-2/3">
                    <label class="block">
                        <input name="profile" id="profile" type="file" accept=".jpg, .jpeg, .png" class="block w-full text-sm text-cyan-500
                            file:me-4 file:py-2 file:px-3
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-cyan-900
                            hover:file:bg-cyan-300
                            file:disabled:opacity-50 file:disabled:pointer-events-none
                            dark:file:bg-cyan-200
                            dark:hover:file:bg-cyan-50"
                            required
                        >
                    </label>
                </div>
            </div>
            <?php if ($profile_error){
                    echo
                    '<div class="md:flex md:items-center mb-6">
                        <div class="md:w-3/3">
                            <p class="m-0 text-base text-red-600">' . $profile_error . '</p>
                        </div>
                    </div>'
                    ;
                }
            ?>
            <div class="md:flex md:items-center mb-6" id="image">
                <div class="md:w-1/3">
                </div>
                <div class="md:w-2/3">
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
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="lastname" id="inline-last-name" type="text" value="" required>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-first-name">
                        First Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="firstname" id="inline-first-name" type="text" value="" required>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-email">
                        Email
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="email" id="inline-email" type="email" value="" required>
                </div>
            </div>
            <?php if ($error){
                    echo
                    '<div class="md:flex md:items-center mb-6">
                        <div class="md:w-3/3">
                            <p class="m-0 text-base text-red-600">' . $error . '</p>
                        </div>
                    </div>'
                    ;
                }
            ?>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-cyan-900 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-city">
                        City
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-cyan-400" name="city" id="inline-city" type="text" value="" required>
                </div>
            </div>
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
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-1/3">
                    <button onclick="resetFields()" class="shadow bg-cyan-50 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-cyan-900 font-bold py-2 px-4 rounded" type="button">
                        CANCEL
                    </button>
                </div>
                <div class="md:w-1/3 grid justify-end">
                    <button type="submit" name="submit" class="shadow bg-cyan-900 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
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
                    // const fileInput = document.getElementById('image');
                    const fileInput = document.getElementById('profile');

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
                $('#profile').change(function(){
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image-holder').attr('src', e.target.result);
                        const imagePath = document.getElementById('profile').value;
                        const imageName = imagePath.substring(12);
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