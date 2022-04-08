<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        nav ul {
            display: flex;
            flex-direction: row;
        }

        li {
            list-style: none;
        }
        li a {
            text-decoration: none;
            margin-right: 10px;
            word-spacing: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Login</a></li>
            </ul>
        </nav>
    </header>

    {{content}}

    <footer>
        <p>Copywrite <span>&copy</span> <script>document.write(new Date().getFullYear())</script></p>
    </footer>
</body>
</html>