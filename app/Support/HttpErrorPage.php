<?php

namespace App\Support;

final class HttpErrorPage
{
    /**
     * @return array<int, array{
     *     code: string,
     *     eyebrow: string,
     *     icon: string,
     *     title: string,
     *     message: string,
     *     meta_title: string,
     *     meta_description: string,
     *     image_alt: string,
     *     admin_title: string,
     *     admin_message: string
     * }>
     */
    public static function definitions(): array
    {
        return [
            400 => self::make(
                code: '400',
                eyebrow: 'Bad Request',
                icon: 'fa-triangle-exclamation',
                title: 'Bad Request',
                message: 'The request could not be processed because it was incomplete or invalid. Check the address or the details you submitted, then try again. You can also head back to the homepage and continue browsing IBN Technologies.',
                metaDescription: 'The request could not be processed because it was incomplete or invalid.',
                imageAlt: 'Illustration for a bad request',
                adminTitle: 'Bad Request',
                adminMessage: 'The admin request could not be processed because it was incomplete or invalid.',
            ),
            401 => self::make(
                code: '401',
                eyebrow: 'Unauthorized',
                icon: 'fa-user-lock',
                title: 'Unauthorized',
                message: 'You need to be signed in to view this page. Return to the homepage, or sign in if you were trying to reach a protected area.',
                metaDescription: 'You need to be signed in to view this page.',
                imageAlt: 'Illustration for an unauthorized page',
                adminTitle: 'Unauthorized',
                adminMessage: 'You need to sign in before you can view this admin page.',
            ),
            403 => self::make(
                code: '403',
                eyebrow: 'Forbidden',
                icon: 'fa-ban',
                title: 'Access Forbidden',
                message: 'You do not have permission to view this page. If you believe this is a mistake, please contact IBN Technologies. Otherwise, head back to the homepage to continue browsing.',
                metaDescription: 'You do not have permission to view this page.',
                imageAlt: 'Illustration for a forbidden page',
                adminTitle: 'Forbidden',
                adminMessage: 'You do not have permission to view this admin page.',
            ),
            404 => self::make(
                code: '404',
                eyebrow: 'Navigation Error',
                icon: 'fa-compass-drafting',
                title: 'Oops! Page Not Found',
                message: "The page you're trying to reach may have been moved, renamed, or no longer exists. Use the button below to head back to the homepage and continue browsing IBN Technologies.",
                metaDescription: 'The page you requested could not be found.',
                imageAlt: 'Illustration for page not found',
                adminTitle: 'Page Not Found',
                adminMessage: 'The requested admin page could not be found or is no longer available.',
            ),
            405 => self::make(
                code: '405',
                eyebrow: 'Method Not Allowed',
                icon: 'fa-right-left',
                title: 'Method Not Allowed',
                message: 'This page does not accept the type of request that was sent. Return to the homepage and try the action again from there.',
                metaDescription: 'This page does not accept the type of request that was sent.',
                imageAlt: 'Illustration for a method not allowed error',
                adminTitle: 'Method Not Allowed',
                adminMessage: 'This admin page does not accept the request method that was used.',
            ),
            419 => self::make(
                code: '419',
                eyebrow: 'Page Expired',
                icon: 'fa-hourglass-end',
                title: 'Page Expired',
                message: 'This page has expired because your session timed out. Refresh the page and try again, or return to the homepage to continue browsing IBN Technologies.',
                metaDescription: 'This page has expired because your session timed out.',
                imageAlt: 'Illustration for an expired page',
                adminTitle: 'Page Expired',
                adminMessage: 'Your admin session has expired. Refresh the page and try again.',
            ),
            429 => self::make(
                code: '429',
                eyebrow: 'Too Many Requests',
                icon: 'fa-gauge-high',
                title: 'Too Many Requests',
                message: 'Too many requests were sent in a short period of time. Please wait a moment and try again, or return to the homepage.',
                metaDescription: 'Too many requests were sent in a short period of time.',
                imageAlt: 'Illustration for a too many requests error',
                adminTitle: 'Too Many Requests',
                adminMessage: 'Too many admin requests were sent in a short time. Please wait a moment and try again.',
            ),
            500 => self::make(
                code: '500',
                eyebrow: 'Server Error',
                icon: 'fa-server',
                title: 'Server Error',
                message: 'Something unexpected went wrong on our side. Please try again in a few minutes, or return to the homepage while we look into it.',
                metaDescription: 'Something unexpected went wrong on our side.',
                imageAlt: 'Illustration for a server error',
                adminTitle: 'Server Error',
                adminMessage: 'The admin panel ran into an unexpected error. Please try again in a few minutes.',
            ),
            503 => self::make(
                code: '503',
                eyebrow: 'Service Unavailable',
                icon: 'fa-screwdriver-wrench',
                title: 'Service Unavailable',
                message: 'IBN Technologies is temporarily unavailable. Please try again shortly, or return to the homepage once the service is back.',
                metaDescription: 'IBN Technologies is temporarily unavailable.',
                imageAlt: 'Illustration for a service unavailable error',
                adminTitle: 'Service Unavailable',
                adminMessage: 'The admin panel is temporarily unavailable. Please try again shortly.',
            ),
        ];
    }

    /**
     * @return array{
     *     code: string,
     *     eyebrow: string,
     *     icon: string,
     *     title: string,
     *     message: string,
     *     meta_title: string,
     *     meta_description: string,
     *     image_alt: string,
     *     admin_title: string,
     *     admin_message: string
     * }
     */
    public static function definition(int $status): array
    {
        return self::definitions()[$status]
            ?? throw new \InvalidArgumentException('Unknown HTTP error page ['.$status.'].');
    }

    /**
     * @return array{
     *     code: string,
     *     eyebrow: string,
     *     icon: string,
     *     title: string,
     *     message: string,
     *     meta_title: string,
     *     meta_description: string,
     *     image_alt: string,
     *     admin_title: string,
     *     admin_message: string
     * }
     */
    public static function forStatus(int $status): array
    {
        if (isset(self::definitions()[$status])) {
            return self::definitions()[$status];
        }

        $serverError = $status >= 500;

        return self::make(
            code: (string) $status,
            eyebrow: $serverError ? 'Server Error' : 'Request Error',
            icon: $serverError ? 'fa-server' : 'fa-triangle-exclamation',
            title: $serverError ? 'Server Error' : 'Request Error',
            message: $serverError
                ? 'Something unexpected went wrong on our side. Please try again in a few minutes, or return to the homepage while we look into it.'
                : 'The request could not be completed. Check the address and try again, or head back to the homepage and continue browsing IBN Technologies.',
            metaDescription: $serverError
                ? 'Something unexpected went wrong on our side.'
                : 'The request could not be completed.',
            imageAlt: $serverError ? 'Illustration for a server error' : 'Illustration for a request error',
            adminTitle: $serverError ? 'Server Error' : 'Request Error',
            adminMessage: $serverError
                ? 'The admin panel ran into an unexpected error. Please try again in a few minutes.'
                : 'The admin request could not be completed.',
        );
    }

    /**
     * @return array{
     *     code: string,
     *     eyebrow: string,
     *     icon: string,
     *     title: string,
     *     message: string,
     *     meta_title: string,
     *     meta_description: string,
     *     image_alt: string,
     *     admin_title: string,
     *     admin_message: string
     * }
     */
    private static function make(
        string $code,
        string $eyebrow,
        string $icon,
        string $title,
        string $message,
        string $metaDescription,
        string $imageAlt,
        string $adminTitle,
        string $adminMessage,
    ): array {
        return [
            'code' => $code,
            'eyebrow' => $eyebrow,
            'icon' => $icon,
            'title' => $title,
            'message' => $message,
            'meta_title' => $code.' | '.$adminTitle.' | '.config('app.name'),
            'meta_description' => $metaDescription,
            'image_alt' => $imageAlt,
            'admin_title' => $adminTitle,
            'admin_message' => $adminMessage,
        ];
    }
}
