@php
    $tooltipId = 'messaging-consent-tooltip-'.uniqid();
    $tooltipText = 'By checking this box you agree to receive recurring messages from IBN TECHNOLOGIES LTD, Reply STOP to Opt out. Reply HELP for help. Message frequency varies. Message and data rates may apply. Carriers are not liable for delayed or undelivered messages. No mobile information will be shared with third parties/affiliates for marketing/promotional purposes. All OPT-IN requests include text messaging originator opt-in data and consent; this information will not be shared with third parties.';
@endphp

<span class="consent-tooltip" data-consent-tooltip>
    <button
        type="button"
        class="consent-tooltip__trigger"
        aria-label="Messaging consent details"
        aria-expanded="false"
        aria-controls="{{ $tooltipId }}"
        aria-describedby="{{ $tooltipId }}"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            aria-hidden="true"
            focusable="false"
        >
            <path
                fill="currentColor"
                d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 9 L 13 9 L 13 7 L 11 7 z M 11 11 L 11 17 L 13 17 L 13 11 L 11 11 z"
            ></path>
        </svg>
    </button>
    <span
        id="{{ $tooltipId }}"
        class="consent-tooltip__content"
        role="tooltip"
        aria-hidden="true"
    >
        {{ $tooltipText }}
    </span>
</span>
