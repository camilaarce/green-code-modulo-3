<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Prueba de API</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2em;
        }

        pre {
            background-color: #f4f4f4;
            padding: 1em;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <pre>
        {!! json_encode($authors, JSON_PRETTY_PRINT) !!}
    </pre>
</body>

</html>