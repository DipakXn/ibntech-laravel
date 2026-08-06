@props([
    'label',
    'value' => null,
    'href' => null,
    'last' => false,
])

@php
    $display = filled($value) ? $value : 'N/A';
    $borderBottom = $last ? '0' : '1px solid #e5e7eb';
@endphp

<tr class="detail-row">
    <td class="detail-label" style="width:34%; background-color:#f3f4f6; color:#6b7280; font-size:11px; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; padding:14px 16px; border-bottom:{{ $borderBottom }}; vertical-align:top;">
        {{ $label }}
    </td>
    <td class="detail-value" style="width:66%; background-color:#ffffff; color:#1f2937; font-size:14px; line-height:1.5; padding:14px 16px; border-bottom:{{ $borderBottom }}; vertical-align:top; word-break:break-word;">
        @if ($href && filled($value))
            <a href="{{ $href }}" style="color:#2e2e80; text-decoration:underline;">{{ $display }}</a>
        @else
            {{ $display }}
        @endif
    </td>
</tr>
