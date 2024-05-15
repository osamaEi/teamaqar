<!DOCTYPE html>
<html lang="ar" dir=>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap">



</head>
<style>

    body {
    font-family: 'Cairo', sans-serif;
}


.border-primary {
    border-color: #0056b3 !important; /* Darker shade of blue */
    border-width: 5px; /* Increase border width as needed */
    border-radius: 1.1em;
}
</style>
<body>

<div class="container">
    <div class="row">
        <!-- Header Box -->
        <div class="col-lg-8 mx-auto mb-4"> <!-- Changed col-lg-8 and added mx-auto -->
            <div class="card border-primary">
                <div class="card-body">
                    <b><h1 class="card-title text-center">أبو نواف للعقار</h1></b>
                </div>
            </div>
            
        </div>
        
                       <!-- Form Box -->
                       <div class="col-lg-6 mb-4">
                        <div class="card"  style=" border-width: 5px; /* Increase border width as needed */
                        border-radius: 1.1em;">
                            <div class="card-body">
                                <!-- Your logo or view -->
                                <div class="text-center mb-4">
                                    <img src="{{ asset('upload/123.jpg')}}" alt="Logo" style="width: 250px;">
                                    <!-- Or any other content you want to display -->
                                </div>
                    
                                <!-- Form -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                    
                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                        <!-- Error messages -->
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                    
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                                        <!-- Error messages -->
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                    
                                    <!-- Remember Me -->
                                    <div class="form-group form-check">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label class="form-check-label" for="remember_me">Remember me</label>
                                    </div>
                    
                                    <div class="form-group">
                                 
                                        <button type="submit" class="btn btn-primary">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

        
        <!-- Right Column - Other Button -->
        <div class="col-lg-6">
            <div class="card border-warning" style=" border-width: 5px; /* Increase border width as needed */
            border-radius: 1.1em;">
                <div class="card-body">
                    <div class="button-container text-center">
                         <a class="btn btn-lg" href="{{ route('create.client')}}"> <b>طلب أرض </b></a>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
