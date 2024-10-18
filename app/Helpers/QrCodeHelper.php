<?php

namespace App\Helpers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeHelper
{
    public static function generateQrCode($data)
    {
        // Create a new QR Code instance
        $qrCode = QrCode::create($data)
            ->setSize(300)
            ->setMargin(10);

        // Write the QR code to a data URI
        $writer = new PngWriter();
        return $writer->write($qrCode)->getDataUri();
    }
}
