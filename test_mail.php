<?php
require 'vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$dsn = 'smtp://admin%40portfolio.grdy2507.odns.fr:RedarDG601122105*@portfolio.grdy2507.odns.fr:465?encryption=ssl';
$transport = Transport::fromDsn($dsn);
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('admin@portfolio.grdy2507.odns.fr')
    ->to('admin@portfolio.grdy2507.odns.fr')
    ->subject('Test SMTP via CLI')
    ->text('Ceci est un test direct.');

try {
    $mailer->send($email);
    echo "Mail envoyé\n";
} catch (\Throwable $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
