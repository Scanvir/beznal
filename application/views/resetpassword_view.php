<?php
    print_r($data);
?>
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
    </style>
</head>
<body class="h-vh-100">
<form class="login-form" method="post">
    <h2 class="text-light" style='text-align: center'>Для відновлення пароля вкажіть адресу електронної пошти</h2>
    <div class="form-group">
        <input type="text" data-role="input" data-prepend="<span class='mif-envelop' style='color: #74489d; '>" placeholder="Адреса пошти:" name="email">
    </div>
    <?php
        if ($data)
            if ($data['isValid'] == 1){
    ?>
    <div class="form-group">
        <div class="bg-green fg-white rounded">на вказану електронну пошту надіслано листа з інструкцією по відновленню пароля</div>
    </div>
    <?php
            } else {
    ?>
    <div class="form-group">
        <div class="bg-red fg-white rounded">електронна пошта вказана невірно</div>
    </div>
    <?php
            }
    ?>
    <div class="form-group">
        <button class="button secondary outline rounded" style='float: right;'>Відновити...</button>
    </div>

</form>

<script src="/js/jquery-3.4.1.js"></script>
<script src="/js/metro.js"></script>