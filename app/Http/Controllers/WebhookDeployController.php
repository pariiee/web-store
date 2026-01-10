<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class WebhookDeployController extends Controller
{
    public function __invoke(Request $request)
    {
        // 1. Hanya POST
        if (!$request->isMethod('post')) {
            abort(Response::HTTP_METHOD_NOT_ALLOWED);
        }

        // 2. Ambil signature GitHub
        $signature = $request->header('X-Hub-Signature-256');

        if (!$signature) {
            Log::warning('Webhook blocked: missing signature');
            abort(Response::HTTP_FORBIDDEN, 'Signature missing');
        }

        // 3. Hitung signature lokal
        $payload   = $request->getContent();
        $secret    = config('services.github.webhook_secret');

        $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);

        if (!hash_equals($hash, $signature)) {
            Log::warning('Webhook blocked: invalid signature');
            abort(Response::HTTP_FORBIDDEN, 'Invalid signature');
        }

        // 4. Validasi event
        if ($request->header('X-GitHub-Event') !== 'push') {
            return response()->json([
                'message' => 'Ignored event'
            ], 200);
        }

        // 5. Pastikan branch main
        if ($request->input('ref') !== 'refs/heads/main') {
            return response()->json([
                'message' => 'Ignored branch'
            ], 200);
        }

        // 6. Eksekusi deploy script
        $script = env('DEPLOY_SCRIPT_PATH');

        if (!file_exists($script)) {
            Log::error('Deploy script not found');
            abort(500, 'Deploy script missing');
        }

        // Non-blocking, aman
        exec("bash {$script} > /dev/null 2>&1 &");

        Log::info('Deployment triggered successfully');

        return response()->json([
            'message' => 'Deployment triggered'
        ], 200);
    }
}
