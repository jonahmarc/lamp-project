<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset ('assets/css/styles.css')}}">
    <title>Customer Information Review Page</title>
</head>
<body>
    <div class="header">
        <a class="form-page" href="/">CUSTOMER INFORMATION ENTRY FORM</a>
        <a class="review-page" href="/review">CUSTOMER INFORMATION REVIEW PAGE</a>
    </div>
    <div class="page-container">
        <div class="review-wrapper">
            <form action="/info" method="GET" class="email-lookup">
                <!-- @csrf -->
                <div class="input-wrapper">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" required/>
                    @error('email')
                        <p style="color: red; font-size: 0.5em; margin: 0;">
                            {{$message}}
                        </p>
                    @enderror
                    <button type="submit">SEARCH</button>
                </div>
            </form>
            <div class="result">
                @foreach ($customer as $key => $info)
                    <div class="input-wrapper">
                        @if ($key == 'error')
                            <label for="" style="text-transform: capitalize; color: red; font-size: 0.5em; margin: 0;"><strong>{{ $key }}:</strong></label>
                            <label for="" style="color: red; font-size: 0.5em; margin: 0;">{{ $info }}</label>
                        @else
                            <label for="" style="text-transform: capitalize;"><strong>{{ $key }}:</strong></label>
                            <label for="">{{ $info }}</label>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="calculator">
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