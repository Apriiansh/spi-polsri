<?php
namespace Config;
use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    // public string $fromEmail = 'noreply@spi.polsri.ac.id';
    public string $fromEmail = 'apriiansh27@gmail.com';
    public string $fromName = 'SPI POLSRI';
    public string $recipients = '';
    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $mailPath = '/usr/sbin/sendmail';
    
    // Konfigurasi untuk Brevo (sebelumnya Sendinblue)
    public string $SMTPHost = 'smtp-relay.brevo.com';
    public string $SMTPUser = '';
    public string $SMTPPass = '';
    public int $SMTPPort = 587;
    public int $SMTPTimeout = 30;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';
    
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    public function __construct()
    {
        parent::__construct();
        
        // Mengambil kredensial Brevo dari file .env
        $this->SMTPUser = getenv('brevo.login') ?: env('brevo.login');
        $this->SMTPPass = getenv('brevo.apiKey') ?: env('brevo.apiKey');
    }
}