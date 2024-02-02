<?php
include_once("connection.php");
$con = connect();

if(isset($_GET['email'])){
    $email = $_GET['email'];

    $sql = "SELECT * FROM customer WHERE email='$email'";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
    $count = $students->num_rows;

    if ($count == 1){
        $record = $row;
    }
    else{
        $error = "No customer information found!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Information Review Page</title>
</head>
<body class="grid h-screen w-screen max-w-full m-0 grid-rows-8 bg-cyan-100">
    <div class="row-span-1 flex w-full justify-end items-center bg-cyan-900 shadow-xl text-cyan-100">
        <a class="form-page hover:underline" href="index.php">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page mr-20 ml-4 hover:underline" href="review.php">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="form-wrapper row-span-7 flex flex-wrap pt-10">
        <div class="flex-initial w-1/2 grid grid-rows-8">
            <form  action="<?php echo $_GET['email']?>" method="GET" class="row-span-2 flex flex-wrap px-10 justify-center content-center">
                <div class="grid content-center">
                    <p class="text-cyan-900 font-bold align-middle">Email</p>
                </div>
                <input class="bg-white appearance-none border-2 border-cyan-700 rounded w-1/3 h-1/4 py-2 px-4 mx-2 text-cyan-900 leading-tight focus:outline-none focus:border-cyan-400" name="email" id="inline-email" type="email" value="" required>
                <button type="submit" class="shadow bg-cyan-900 w-1/8 h-1/4 hover:bg-cyan-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    SEARCH
                </button>
                <?php if ($error): ?>
                    <div class="grid justify-center w-full">
                        <p class="text-red-600 font-bold w-full"><?php echo $error; ?></p>
                    </div>
                <?php endif ?>
            </form>
            <div class="row-span-6 flex justify-center">
                <div class="w-4/12">
                    <?php
                        foreach ($record as $key => $info){
                            $hide = ["id", "created_at", "updated_at", "filename"];
                            if (! in_array($key, $hide)){
                                echo
                                '<div class="flex flex-wrap justify-between content-start">
                                    <div class="grid content-start mr-2">
                                        <p class="capitalize italic text-cyan-900 font-bold align-middle">' . $key . '</p>
                                    </div>
                                    <div class="grid content-start">
                                        <p class="text-cyan-900 align-middle">' . $info . '</p>
                                    </div>
                                </div>'
                                ;
                            }
                            else if ($key == "filename") {
                                echo
                                '<div class="flex flex-wrap justify-between content-start">
                                    <div class="grid content-start mr-2">
                                        <p class="capitalize italic text-cyan-900 font-bold align-middle">' . 'Profile Picture' . '</p>
                                    </div>
                                    <div class="grid content-start">
                                        <img class="h-24" id="profile" src="images/' . $info . '" alt="profile picture"">
                                    </div>
                                </div>'
                                ;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="flex flex-initial w-1/2 justify-center">
            <iframe class="w-1/2 h-full" src="calculator.php" frameborder="0"></iframe>
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