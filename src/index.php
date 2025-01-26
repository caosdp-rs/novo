<?php
require __DIR__ . '/../vendor/autoload.php'; // Inclua o autoload do Composer

use Intervention\Image\ImageManagerStatic as Image;

// Configure o driver
Image::configure(['driver' => 'gd']); // Use 'gd' ou 'imagick' conforme sua instalação

// Carregue e manipule a imagem
$image = Image::make('example.jpg');
$image->resize(300, 200);
$image->save('output.jpg');

echo 'Imagem processada com sucesso!';