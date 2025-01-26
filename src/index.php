<?php
require __DIR__ . '/../vendor/autoload.php'; // Inclua o autoload do Composer

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// Verifica se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = __DIR__ . '/uploads/'; // Diretório onde os arquivos serão armazenados
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Cria o diretório, se não existir
    }

    $uploadedFile = $uploadDir . basename($_FILES['image']['name']);

    // Move o arquivo enviado para o diretório de uploads
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
        // Cria o gerenciador de imagens com o driver GD
        $manager = new ImageManager(new Driver());

        // Lê a imagem enviada pelo usuário
        $image = $manager->read($uploadedFile);

        // Redimensiona a imagem proporcionalmente para largura de 900px
        $image->scale(width: 900);

        // Lê o watermark
        $imageW = $manager->read('logo1.png');
        $imageW->scale(width: 200);
        $imageW->resize(100, 100)->brightness(10);

        // Insere o watermark na imagem
        $image->place($imageW, 'bottom-right', 10, 10, 25);

        // Salva a imagem modificada
        $outputFile = $uploadDir . 'foo.png';
        $image->toPng()->save($outputFile);

        // Exibe a imagem final no navegador
        header('Content-Type: image/png');
        readfile($outputFile);

        // Remove os arquivos temporários (opcional)
        unlink($uploadedFile);
        unlink($outputFile);
    } else {
        echo "Erro ao enviar o arquivo.";
    }
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
