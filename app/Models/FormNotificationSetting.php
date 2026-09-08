<?php

namespace App\Models;

use Database\Factories\FormNotificationSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormNotificationSetting extends Model
{
    /** @use HasFactory<FormNotificationSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'form_name',
        'admin_to',
    ];
}
