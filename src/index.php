<?php
require __DIR__ . '/../vendor/autoload.php'; // Inclua o autoload do Composer

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// Verifica se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Cria o gerenciador de imagens com o driver GD
    $manager = new ImageManager(new Driver());

    // Lê a imagem diretamente do fluxo de entrada temporário
    $image = $manager->read($_FILES['image']['tmp_name']);

    // Redimensiona a imagem proporcionalmente para largura de 900px
    $image->scale(width: 900);

    // Lê o watermark
    $imageW = $manager->read('logo1.png');
    $imageW->scale(width: 200);
    $imageW->resize(100, 100)->brightness(10);

    // Insere o watermark na imagem
    $image->place($imageW, 'bottom-right', 10, 10, 25);

    // Exibe a imagem final diretamente no navegador
    header('Content-Type: image/png');
    echo $image->toPng(); // Converte a imagem para PNG e envia como resposta
} else {
    // Formulário HTML para envio de imagem
    echo '
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Envie sua imagem:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Enviar</button>
    </form>
    ';
}
?>
