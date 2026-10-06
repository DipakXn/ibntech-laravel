<?php

namespace App\Filament\Resources\AnalyticsExcludedIps\Schemas;

use App\Models\AnalyticsExcludedIp;
use App\Rules\ValidIpNetwork;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AnalyticsExcludedIpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Excluded address')
                    ->description('Visits from an enabled address or range are not recorded. The address is not stored with page views.')
                    ->schema([
                        TextInput::make('ip_address')
                            ->label('IP address or CIDR')
                            ->required()
                            ->maxLength(64)
                            ->rule(fn (?AnalyticsExcludedIp $record): ValidIpNetwork => new ValidIpNetwork($record?->getKey()))
                            ->helperText('IPv4, IPv6, or a CIDR range such as 203.0.113.0/24 or 2001:db8::/32.'),
                        TextInput::make('description')
                            ->label('Description')
                            ->maxLength(255)
                            ->helperText('For example, current office or localhost.'),
                        Toggle::make('is_enabled')
                            ->label('Enabled')
                            ->default(true),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }
}
