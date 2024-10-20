<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Compra</title>
</head>
<body>
    <h1>Confirmação de Compra</h1>

    <p>Olá {{ $data['name'] }},</p>

    <p>Obrigado pela sua compra! Aqui estão os detalhes:</p>

    <ul>
        <li><strong>Produto:</strong> {{ $data['product_name'] }}</li>
        <li><strong>Quantidade:</strong> {{ $data['quantity'] }}</li>
        <li><strong>Total:</strong> R$ {{ number_format($data['total_price'], 2, ',', '.') }}</li>
    </ul>

    <p>Agradecemos por escolher nossa loja!</p>

    <a href="{{ url('/') }}" style="background-color: #3490dc; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Voltar à loja
    </a>

    <p>Atenciosamente,<br>
    {{ config('app.name') }}</p>
</body>
</html>