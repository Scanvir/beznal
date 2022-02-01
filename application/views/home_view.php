</head>
<body class="h-vh-100">
    <h1>Вітаю!</h1>
    <h2><font color="red">Сайт знаходиться в разробці!</font></h2>

    <p>
        В данний момент реалізовано:
        <ul>
            <li>Вхід (Ваша пошта: <?php print_r($data[0]['email']); ?>, ваше і`мя: <?php print_r($data[0]['personName']); ?>)</li>
            <li><a href="/logout">Вихід</a></li>
            <li><a href="/resetpassword">Відновлення пароля</a></li>
        </ul>
        Не реализовано:
        <ul>
            <li>Реєстрація з підтвердженням пошти</li>
            <li>Редагування профіля</li>
        </ul>
    </p>
