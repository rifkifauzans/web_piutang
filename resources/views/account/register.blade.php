<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Register</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&display=swap'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="regis_box">
            <div class="regis-header">
                <span>Register</span>
            </div>
            <!-- Form Registrasi -->
            <form action="#" method="POST">
                @csrf
                <div class="input_box mb-3">
                    <input type="email" id="email" name="email" class="form-control input-field @error('email')is-invalid @enderror" required value="#" autocomplete="email">
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-envelope icon"></i>
                    @error('email')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please fill in a valid email address
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="password" id="password" name="password" class="form-control input-field @error('password')is-invalid @enderror" required autocomplete="current-password">
                    <label for="password" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                    @error('password')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Password must be at least 8 characters long
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="text" id="customer_name" name="customer_name" class="form-control input-field @error('customer_name')is-invalid @enderror" required value="#">
                    <label for="customer_name" class="label">Customer Name</label>
                    <i class="bx bx-user icon"></i>
                    @error('customer_name')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please enter the customer's name.
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="number" id="phone_number" name="phone_number" class="form-control input-field @error('phone_number')is-invalid @enderror" required value="#">
                    <label for="phone_number" class="label">Phone Number</label>
                    <i class="bx bx-phone icon"></i>
                    @error('phone_number')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please enter a valid telephone number.
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="text" id="address" name="address" class="form-control input-field @error('address')is-invalid @enderror" required value="{{ old('address') }}">
                    <label for="address" class="label">Address</label>
                    <i class="bx bx-home icon"></i>
                    @error('address')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please enter a valid address.
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="submit" class="input-submit btn btn-primary text-dark" value="Registrasi">
                </div>
            </form>
            <!-- Tautan untuk login -->
            <div class="register">
                <span>Already have an account? <a href="#">Login</a></span>
            </div>
        </div>
    </div>
</body>
</html>
