<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Inicial - Gestão de Vendas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

  <!-- Cabeçalho -->
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <span class="w-12 h-12">
        <i class="fas fa-store text-3xl"></i>
        </span>
        <h1 class="text-2xl font-bold hidden sm:block">Sistema de Vendas</h1>
      </div>
      <nav class="space-x-6">
        <a href="#sobre" class="text-gray-700 hover:text-blue-500">Sobre</a>
        <a href="#funcionalidades" class="text-gray-700 hover:text-blue-500">Funcionalidades</a>
        <a href="#documentacao" class="text-gray-700 hover:text-blue-500">Documentação</a>
        <a href="/login" class="text-blue-500 border border-blue-500 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white">Login</a>
      </nav>
    </div>
  </header>

  <!-- Bloco de Boas-Vindas -->
  <section class="bg-blue-500 text-white py-20 text-center">
    <div class="container mx-auto px-4">
      <h2 class="text-4xl font-bold mb-4">Bem-vindo ao Sistema de Vendas</h2>
      <p class="text-lg mb-6">Otimize sua gestão comercial e melhore o atendimento ao cliente com tecnologia de ponta.</p>
      <div class="space-x-4">
        <a href="/login" class="bg-white text-blue-500 font-bold px-6 py-3 rounded-lg shadow hover:bg-gray-100">Começar Agora</a>
        <a href="#sobre" class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-500">Saiba Mais</a>
      </div>
    </div>
  </section>

  <!-- Funcionalidades Principais -->
  <section id="funcionalidades" class="py-16 flex-grow">
    <div class="container mx-auto px-4">
      <h3 class="text-3xl font-bold text-center mb-12">Funcionalidades Principais</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Funcionalidade 1 -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
          <i class="fas fa-chart-line fa-3x mx-auto mb-4"></i>
          <h4 class="text-xl font-semibold mb-2">Gestão de Vendas</h4>
          <p class="text-gray-700">Realize vendas de forma rápida e eficiente, com produtos cadastrados no sistema.</p>
        </div>
        
        <!-- Funcionalidade 2 -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
          <i class="fas fa-box-open fa-3x mx-auto mb-4"></i>
          <h4 class="text-xl font-semibold mb-2">Cadastro de Produtos</h4>
          <p class="text-gray-700">Cadastre e gerencie produtos com todas as informações necessárias, como preços e estoque.</p>
        </div>
        
        <!-- Funcionalidade 3 -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
          <i class="fas fa-tags fa-3x mx-auto mb-4"></i>
          <h4 class="text-xl font-semibold mb-2">Cupons de Desconto</h4>
          <p class="text-gray-700">Aplique cupons de desconto nas vendas e ofereça vantagens aos seus clientes.</p>
        </div>
        
        <!-- Funcionalidade 4 -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
          <i class="fas fa-envelope fa-3x mx-auto mb-4"></i>
          <h4 class="text-xl font-semibold mb-2">Notificações por Email</h4>
          <p class="text-gray-700">Envie emails com os detalhes da venda e atualizações do pedido para seus clientes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Rodapé -->
  <footer class="bg-gray-800 text-gray-200 py-6">
    <div class="container mx-auto px-4 text-center">
      <div class="mb-4">
        <a href="#" class="text-gray-400 hover:text-white">Termos de Uso</a>
        <span class="mx-2">|</span>
        <a href="#" class="text-gray-400 hover:text-white">Política de Privacidade</a>
        <span class="mx-2">|</span>
        <a href="#contato" class="text-gray-400 hover:text-white">Contato</a>
      </div>
      <p>&copy; 2024 Sistema de Vendas. Todos os direitos reservados.</p>
    </div>
  </footer>

</body>
</html>
