<?php

namespace App\Models;

use App\Mail\SmtpTransportConfig;
use Database\Factories\SmtpSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    /** @use HasFactory<SmtpSettingFactory> */
    use HasFactory;

    public const ENCRYPTION_NONE = 'none';

    public const ENCRYPTION_TLS = 'tls';

    public const ENCRYPTION_SSL = 'ssl';

    public const AUTH_AUTO = 'auto';

    public const AUTH_NONE = 'none';

    public const AUTH_LOGIN = 'login';

    public const AUTH_PLAIN = 'plain';

    public const AUTH_CRAM_MD5 = 'cram-md5';

    public const AUTH_XOAUTH2 = 'xoauth2';

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'is_enabled',
        'host',
        'port',
        'encryption',
        'auth_mode',
        'username',
        'password',
        'from_email',
        'from_name',
        'lead_notification_to',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'port' => 'integer',
            'password' => 'encrypted',
        ];
    }

    public function hasPassword(): bool
    {
        return filled($this->password);
    }

    public function toTransportConfig(): SmtpTransportConfig
    {
        return new SmtpTransportConfig(
            host: (string) $this->host,
            port: (int) $this->port,
            encryption: (string) $this->encryption,
            authMode: (string) $this->auth_mode,
            username: $this->username,
            password: $this->password,
        );
    }

    /**
     * @return array<string, string>
     */
    public static function encryptionOptions(): array
    {
        return [
            self::ENCRYPTION_NONE => 'None',
            self::ENCRYPTION_TLS => 'TLS / STARTTLS',
            self::ENCRYPTION_SSL => 'SSL',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function authModeOptions(): array
    {
        return [
            self::AUTH_AUTO => 'Auto / Server Default',
            self::AUTH_NONE => 'None',
            self::AUTH_LOGIN => 'LOGIN',
            self::AUTH_PLAIN => 'PLAIN',
            self::AUTH_CRAM_MD5 => 'CRAM-MD5',
            self::AUTH_XOAUTH2 => 'XOAUTH2',
        ];
    }
}
