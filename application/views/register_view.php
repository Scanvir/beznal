<?php
defined("DIRSEP") OR exit('А-та-та!');
?>
</head>
<body>
<div class="container-fluid bg-projects" id="contacts">
    <div class="container pt-10 pb-20">
        <div class="part-header">
            <div class="h2 text-light mb-0 mt-0">Реєстрація</div>
            <div class="text-muted mb-0">Доступ до вебсайту</div>
        </div>

        <form method="post">

        <div class="part-content">
            <div class="row">
                <div class="cell-md-6">

                    <label class="d-block">ЕДРПОУ компанії:</label>
                    <div class="input">
                        <input name="edrpou" type="text" placeholder="ЕДРПОУ компанії" value="<?php if (isset($data['edrpou'])) print_r($data['edrpou']); ?>">
                        <div class="prepend">
                            <span class="mif-notification"></span>
                        </div>
                    </div>

                    <label class="d-block">Повна юридична назва компанії:</label>
                    <div class="input">
                        <input name="companyName" type="text" placeholder="Повна юридична назва компанії" value="<?php if (isset($data['companyName'])) print_r($data['companyName']); ?>">
                        <div class="prepend">
                            <span class="mif-home"></span>
                        </div>
                    </div>

                    <label class="mt-2 d-block">Уповноважена особа:</label>
                    <div class="input">
                        <input name="personName" type="text" placeholder="Уповноважена особа" value="<?php if (isset($data['personName'])) print_r($data['personName']); ?>">
                        <div class="prepend">
                            <span class="mif-user"></span>
                        </div>
                    </div>

                    <label class="mt-2 d-block">Телефон:</label>
                    <div class="input">
                        <input name="phone" type="text" placeholder="Телефон" value="<?php if (isset($data['phone'])) print_r($data['phone']); ?>">
                        <div class="prepend">
                            <span class="mif-phone"></span>
                        </div>
                    </div>

                    <label class="mt-2 d-block">Електронна пошта:</label>
                    <div class="input">
                        <input name="email" type="text" placeholder="Електронна пошта" value="<?php if (isset($data['email'])) print_r($data['email']); ?>">
                        <div class="prepend">
                            <span class="mif-envelop"></span>
                        </div>
                    </div>

                    <label class="mt-2 d-block">Пароль:</label>
                    <div class="input">
                        <input name="password" type="password" placeholder="Пароль">
                        <div class="prepend">
                            <span class="mif-key"></span>
                        </div>
                    </div>

                    <label class="mt-2 d-block">Підтвердження пароля:</label>
                    <div class="input">
                        <input name="passwordConfirm" type="password" placeholder="Підтвердження пароля">
                        <div class="prepend">
                            <span class="mif-key"></span>
                        </div>
                    </div>

                    <input type="hidden" name="register" value="1">

                    <div class="form-actions mt-4">
                        <button class="button secondary outline rounded" style='float: right;'>&nbsp;&nbsp;&nbsp;Зареєструватись&nbsp;&nbsp;&nbsp;</button>
                        <a href="/" style='float: left;'>&nbsp;&nbsp;&nbsp;На головну&nbsp;&nbsp;&nbsp;</a>
                    </div>
                </div>

                <div class="cell-md-6 pl-0 pl-20-md">

                    <hr class="mt-6 mb-6">
                    <div>Після реєстрації ви отримаєте листа на електронну адресу, за допомогою якого, зможете підтвердити свою адресу та активувати ваш доступ до вебсайту</div>

                    <?php
                        if (!empty($data)) {
                    ?>
                    <hr class="mt-6 mb-6">
                    <?php
                            print_r('<div class="fg-red">'.$data['error'].'</div>');
                        }
                    ?>
                </div>


            </div>
        </div>
        </form>
    </div>
</div>