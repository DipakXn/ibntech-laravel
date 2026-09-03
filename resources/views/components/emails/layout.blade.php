@props([
    'badge' => 'Admin Notification',
    'title',
    'subtitle' => null,
    'preheader' => null,
    'footer' => null,
])

@php
    $appName = config('app.name', 'IBN Technologies');
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>{{ $title ?? $appName }}</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td { font-family: Arial, Helvetica, sans-serif !important; }
    </style>
    <![endif]-->
    <style type="text/css">
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            background-color: #eef1f6;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            color: #2e2e80;
            text-decoration: underline;
        }

        .email-wrapper {
            width: 100%;
            background-color: #eef1f6;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
        }

        .email-header {
            background: linear-gradient(135deg, #2e2e80 0%, #3d5a9c 55%, #2f7a4a 100%);
            background-color: #2e2e80;
        }

        .email-badge {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 6px 12px;
            border-radius: 999px;
            line-height: 1;
        }

        .detail-table {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .detail-label {
            width: 34%;
            background-color: #f3f4f6;
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .detail-value {
            width: 66%;
            background-color: #ffffff;
            color: #1f2937;
            font-size: 14px;
            line-height: 1.5;
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
            word-break: break-word;
        }

        .detail-row:last-child .detail-label,
        .detail-row:last-child .detail-value {
            border-bottom: 0;
        }

        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 18px 20px;
        }

        .message-label {
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin: 0 0 8px 0;
        }

        .message-body {
            color: #1f2937;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .meta-text {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.7;
        }

        .email-footer {
            background-color: #f3f4f6;
            border-radius: 10px;
        }

        @media only screen and (max-width: 620px) {
            .email-container {
                width: 100% !important;
            }

            .email-pad {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .email-header-pad {
                padding: 28px 20px !important;
            }

            .detail-label,
            .detail-value {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box;
            }

            .detail-label {
                padding-bottom: 4px !important;
                border-bottom: 0 !important;
            }

            .detail-value {
                padding-top: 0 !important;
            }

            .stack-pad {
                padding: 20px 16px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#eef1f6; font-family: Arial, Helvetica, sans-serif;">
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
        {{ $preheader ?? ($title ?? 'New notification from '.$appName) }}
    </div>

    <table role="presentation" class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eef1f6;">
        <tr>
            <td align="center" style="padding: 28px 12px;">
                <table role="presentation" class="email-container" width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 8px 24px rgba(46, 46, 128, 0.08);">
                    <tr>
                        <td class="email-header email-header-pad" style="background-color:#2e2e80; background:linear-gradient(135deg, #2e2e80 0%, #3d5a9c 55%, #2f7a4a 100%); padding:36px 32px; text-align:center;">
                            <div style="margin-bottom:16px;">
                                <span class="email-badge" style="display:inline-block; background-color:rgba(255,255,255,0.18); color:#ffffff; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; padding:6px 12px; border-radius:999px; line-height:1;">
                                    {{ $badge ?? 'Admin Notification' }}
                                </span>
                            </div>
                            <h1 style="margin:0 0 10px 0; color:#ffffff; font-size:26px; line-height:1.25; font-weight:700;">
                                {{ $title }}
                            </h1>
                            @isset($subtitle)
                                <p style="margin:0; color:rgba(255,255,255,0.9); font-size:14px; line-height:1.5;">
                                    {{ $subtitle }}
                                </p>
                            @endisset
                        </td>
                    </tr>

                    <tr>
                        <td class="email-pad stack-pad" style="padding:28px 32px 8px 32px; color:#374151; font-size:15px; line-height:1.6;">
                            {{ $intro ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="email-pad stack-pad" style="padding:12px 32px 8px 32px;">
                            {{ $slot }}
                        </td>
                    </tr>

                    @isset($meta)
                        <tr>
                            <td class="email-pad stack-pad" style="padding:20px 32px 8px 32px;">
                                <div style="border-top:1px solid #e5e7eb; padding-top:16px;" class="meta-text">
                                    {{ $meta }}
                                </div>
                            </td>
                        </tr>
                    @endisset

                    <tr>
                        <td class="email-pad stack-pad" style="padding:20px 32px 28px 32px;">
                            <table role="presentation" class="email-footer" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; background-color:#f3f4f6; border-radius:10px;">
                                <tr>
                                    <td style="padding:16px 18px; text-align:center; color:#6b7280; font-size:12px; line-height:1.6;">
                                        {{ $footer ?? ('This is an automated notification from '.$appName.'. Do not reply directly to this email.') }}
                                        <br />
                                        &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
