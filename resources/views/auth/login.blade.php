<html>

<head>
    <title>
        Login
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .login-container img {
            width: 150px;
            height: 150px;
        }

        .login-form {
            max-width: 300px;
            width: 100%;
        }

        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 10px 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-button:hover {
            background: #45a049;
        }

        .forgot-password,
        .create-account {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover,
        .create-account:hover {
            color: #333;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                padding: 20px;
            }

            .login-container img {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img alt="Illustration of a laptop with a user icon on the screen" height="150"
            src="https://storage.googleapis.com/a1aa/image/oOVBG4SXJ6aBH9duylrFIWquTFktJBuoqSqsPee6vuakQX5TA.jpg"
            width="150" />
        <div class="login-form">
            <h2>
                Login
            </h2>
            <form method="POST" action="<?= route('login')?>">
                <?= csrf_field()?>
                <div class="input-group">
                    <i class="fas fa-envelope">
                    </i>
                    <input placeholder="Nama" type="text" id="namaUser" name="namaUser" />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock">
                    </i>
                    <input placeholder="Password" type="password" id="passwordUser" name="passwordUser" />
                </div>
                <button class="login-button">
                    LOGIN
                </button>
                <a class="forgot-password" href="#">
                    Forgot Username / Password?
                </a>
                <a class="create-account" href="{{ route('register')}}">
                    Create your Account →
                </a>
            </form>
        </div>
    </div>
</body>

</html>