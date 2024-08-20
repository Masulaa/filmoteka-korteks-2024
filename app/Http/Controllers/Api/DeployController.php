<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DeployController extends Controller
{
    public function deploy(Request $request)
    {
        $allowedIps = ['131.103.20.160/27', '165.254.145.0/26', '104.192.143.0/24', '104.192.143.192/28', '104.192.143.208/28', '192.30.252.0/22'];
        $remoteIp = $request->ip();
        $allowed = false;

        foreach ($allowedIps as $range) {
            if ($this->ipInRange($remoteIp, $range)) {
                $allowed = true;
                break;
            }
        }

        if (!$allowed) {
            return response('Access forbidden.', 403);
        }

        exec('cd /var/www/html/filmoteka && git pull origin main 2>&1', $output, $returnVar);

        if ($returnVar === 0) {
            Artisan::call('migrate', ['--force' => true]);

            return response('Deployment successful!', 200);
        } else {
            return response('Deployment failed!', 500);
        }
    }

    private function ipInRange($ip, $range)
    {
        list($subnet, $bits) = explode('/', $range);
        $ip = ip2long($ip);
        $subnet = ip2long($subnet);
        $mask = -1 << (32 - $bits);
        return ($ip & $mask) === ($subnet & $mask);
    }
}

