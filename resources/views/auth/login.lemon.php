<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="flex items-center justify-center w-screen h-screen bg-primary text-secondary">
    <div class="p-5 shadow-xl bg-primary">
        {% if ($error): %}
            {{ $error }}
        {% endif %}
        <form method="post" class="flex flex-col">
            <input type="text" name="name" class="p-2 mb-2 border-2 shadow-xl outline-none bg-primary border-yellow">
            <input type="password" name="password" class="p-2 border-2 shadow-xl outline-none bg-primary border-yellow">
            <button>send</button>
        </form>
    </div>
</body>
<script src="js/app.js"></script>
</html>
