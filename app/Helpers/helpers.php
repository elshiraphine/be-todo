<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

if (!function_exists('apiResponse')) {

    /**
     * @param int $code
     * @param string $status
     * @param mixed|null $data
     * @param array $links
     * @param array $meta
     * @return JsonResponse
     */
    function apiResponse(int $code, string $status, mixed $data = null, array $links = [], array $meta = []): JsonResponse
    {
        $currentUrl = Request::url();

        $meta['date_accessed'] = now()->toIso8601String();
        $meta['version'] = '1.0.0';

        return response()->json([
            'code' => $code,
            'status' => $status,
            'data' => $data,
            'links' => array_merge($links, ['self' => $currentUrl]),
            'meta' => $meta
        ]);
    }
}
