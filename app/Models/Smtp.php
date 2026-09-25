<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class Smtp extends Model
{
    use HasFactory;

    protected $fillable = ['mailer', 'host', 'port', 'user_name', 'password', 'encryption'];

    public static function updateSmtps($request, Smtp $smtp)
    {
        // ১) DB এ সেভ
        $smtp->update($request->only(['mailer','host','port','user_name','password','encryption']));

        // ২) .env ফাইল আপডেট
        static::updateEnvFile($request);

        // ৩) রানটাইম কনফিগও ওভাররাইড
        static::applyRuntimeConfig($request);
    }

    private static function updateEnvFile($request)
    {
        $envPath = base_path('.env');
        if (! File::exists($envPath)) {
            return;
        }

        $env = File::get($envPath);

        $map = [
            'MAIL_MAILER'        => $request->mailer,
            'MAIL_HOST'          => $request->host,
            'MAIL_PORT'          => $request->port,
            'MAIL_USERNAME'      => $request->user_name,
            'MAIL_PASSWORD'      => $request->password,
            'MAIL_ENCRYPTION'    => $request->encryption,
            'MAIL_FROM_ADDRESS'  => $request->user_name,
            // যদি DB-তে app_name থাকে, নিল না হলে env এর APP_NAME
            'MAIL_FROM_NAME'     => "\"".(config('app.name'))."\"",
        ];

        foreach ($map as $key => $val) {
            $env = preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$val}",
                $env
            );
        }

        File::put($envPath, $env);

        // ক্লিয়ার করে ফেল ক্যাশড কনফিগ
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
    }

    private static function applyRuntimeConfig($request)
    {
        // এই মুহূর্তে চলমান প্রসেসেও কনফিগ ওভাররাইড
        config([
            'mail.default'                 => $request->mailer,
            'mail.mailers.smtp.host'       => $request->host,
            'mail.mailers.smtp.port'       => $request->port,
            'mail.mailers.smtp.encryption' => $request->encryption,
            'mail.mailers.smtp.username'   => $request->user_name,
            'mail.mailers.smtp.password'   => $request->password,
            'mail.from.address'            => $request->user_name,
            'mail.from.name'               => config('app.name'),
        ]);
    }
}
