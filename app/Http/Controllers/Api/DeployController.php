<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DeployController extends Controller
{
    public function deploy(Request $request)
    {
        $output = [];
        $returnVar = 0;
        // TODO: fix git permision problem
        exec('cd /var/www/html/filmoteka && git pull origin main 2>&1', $output, $returnVar);
        $outputString = implode("\n", $output);

        if ($returnVar === 0) {
            Artisan::call('migrate', ['--force' => true]);
            return response()->json([
                'status' => 'success',
                'message' => 'Deployment successful!',
                'output' => $outputString
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Deployment failed!',
                'output' => $outputString,
                'return_var' => $returnVar
            ], 500);
        }
    }
}
