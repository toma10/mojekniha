<?php

namespace App\Support;

class Url
{
    /**
     * @param array<mixed> $params
     */
    public static function build(string $url, array $params): string
    {
        $url = trim($url, '/?');
        $urlQuery = parse_url($url, PHP_URL_QUERY);

        if ($urlQuery === null) {
            return sprintf('%s?%s', $url, http_build_query($params));
        }

        return sprintf('%s&%s', $url, http_build_query($params));
    }
}
