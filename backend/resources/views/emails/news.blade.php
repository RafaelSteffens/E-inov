<!DOCTYPE html>
<html>
<head>
    <title>Notícias do UOL</title>
    <style>
        /* Estilos globais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0073e6;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .news-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
        }
        .news-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .news-item a {
            color: #0073e6;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .news-item a:hover {
            text-decoration: underline;
        }
        .news-item p {
            margin: 10px 0 0;
            color: #666666;
            font-size: 14px;
            line-height: 1.5;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }
        .footer a {
            color: #0073e6;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Container do e-mail -->
    <div class="email-container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>Olá, {{ $name }}!</h1>
            <p>Aqui estão as últimas notícias do UOL:</p>
        </div>

        <!-- Conteúdo -->
        <div class="content">
            @foreach ($news as $item)
                <div class="news-item">
                    <a href="{{ $item['link'] }}" target="_blank">{{ $item['title'] }}</a>
                    <p>{!! $item['description'] !!}</p>
                </div>
            @endforeach
        </div>

        <!-- Rodapé -->
        <div class="footer">
            <p>Não quer mais receber estes e-mails? <a href="#" target="_blank">Cancelar inscrição</a></p>
            <p>&copy; {{ date('Y') }} UOL Notícias. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>