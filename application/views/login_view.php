    <style>
        .login-form {
            width: 500px;
            top: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: -200px;
        }
        body {
            height: 100%;
        }
        }
    </style>
</head>
<body class="h-vh-100">
<form class="login-form" method="post">
<h2 class="text-light" style='text-align: center'>Вхід</h2>
<div class="form-group">
    <input type="text" data-role="input" data-prepend="<span class='mif-envelop' style='color: #74489d; '>" placeholder="Адреса пошти:" name="email">
</div>
<div class="form-group">
    <input type="password" data-role="input" data-prepend="<span class='mif-key' style='color: #74489d; '>" placeholder="Пароль:" name="password">
</div>
<div class="form-group">
    <button class="button secondary outline rounded" style='float: right;'>&nbsp;&nbsp;&nbsp;Увійти&nbsp;&nbsp;&nbsp;</button>
    <a href="/resetpassword" style='float: left;'>&nbsp;&nbsp;&nbsp;Нагадати пароль&nbsp;&nbsp;&nbsp;</a>
</div>
</form>

<div class="form-group">
    <div class="bg-red fg-white rounded" style='width: 400px; margin-left: auto!important; margin-right: 100px; '></div>
</div>
