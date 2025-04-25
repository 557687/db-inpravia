<style>
body{
 font-family: Arial, sans-serif;
            /*background-image: url('db/assets/security.jpg');*/
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .password-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .password-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 10px;
            background: #fff;
        }

        .input-group i {
            margin-right: 10px;
            color: #666;
        }

        .input-group input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .password-form {
                width: 90%;
            }
        }
    </style>
    
</head>
<body>

    <form action="update_password.php" method="POST" class="password-form">
        <h2>Change Password</h2>
        
        <div class="input-group">
            <i class="bi bi-key"></i>
            <input type="password" name="current_password" placeholder="Current Password" required>
        </div>
        
        <div class="input-group">
            <i class="bi bi-lock"></i>
            <input type="password" name="new_password" placeholder="New Password" required>
        </div>

        <div class="input-group">
            <i class="bi bi-lock-fill"></i>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        </div>

        <button type="submit" class="btn"><i class="bi bi-arrow-repeat"></i> Change Password</button>
    </form>