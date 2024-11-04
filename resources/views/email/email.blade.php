<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .token {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }
        .footer {
            font-size: 0.875rem;
            color: #6c757d;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body style="background-color: #f4f4f4; padding: 20px;">

    <div class="email-container bg-white rounded shadow-sm">
        <div class="email-header">
            <h2>Recuperação de Senha</h2>
        </div>
        <div class="p-4">
            <p>Olá,</p>
            <p>Recebemos uma solicitação para recuperação de senha associada a esta conta. Use o token abaixo para redefinir sua senha:</p>
            <p class="token">{{ $data['message'] }}</p>
            <p>Este token é válido por um período limitado. Caso não tenha solicitado a recuperação, por favor, ignore este e-mail.</p>
        </div>
        <div class="footer bg-light">
            <p>&copy; {{ date('Y') }} - Nome da Igreja. Todos os direitos reservados.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
