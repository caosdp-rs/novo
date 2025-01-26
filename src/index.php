<?php
require __DIR__ . '/../vendor/autoload.php'; // Inclua o autoload do Composer

// use Intervention\Image\ImageManagerStatic as Image;

// // Configure o driver
// Image::configure(['driver' => 'gd']); // Use 'gd' ou 'imagick' conforme sua instalação

// // Carregue e manipule a imagem
// $image = Image::make('example.jpg');
// $image->resize(300, 200);
// $image->save('output.jpg');

// echo 'Imagem processada com sucesso!';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// create image manager with desired driver
$manager = new ImageManager(new Driver());

// read image from file system
$image = $manager->read('example.jpg');

// resize image proportionally to 300px width
$image->scale(width: 900);

$imageW = $manager->read('logo1.png');
$imageW->scale(width: 200);
$imageW->resize(100, 100)
    ->brightness(10);

// insert watermark
$image->place(
    $imageW,
    'bottom-right', 
    10, 
    10,
    25
);
// save modified image in new format 
$image->toPng()->save('foo.png');
header('Content-Type: image/jpeg');
readfile('foo.png');

// Exiba a imagem processada no navegador
