<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class PDFService {

    public $html;
    public $browsershot;
    public $showBackground;
    public $waitUntilNetworkIdle;
    public $paperSize;

    public function __construct() {
        $this->browsershot = new Browsershot();

    }

    public function view($name, $data = []) {
        $this->html = view($name, $data)->render();
        return $this;
    }

  
    public function __call($method, $arguments) {
        if (method_exists($this->browsershot, $method)) {
            // Forward the method call to the Browsershot instance
            $result = $this->browsershot->$method(...$arguments);
            // Return $this for method chaining
            return $result instanceof Browsershot ? $this : $result;
        }

        throw new \BadMethodCallException("Method {$method} does not exist on Browsershot.");
    }

    public function inline() {
        return $this->browsershot->html($this->html)
            ->setNodeBinary('/usr/share/nvm/versions/node/v20.18.0/bin/node')
            ->setNpmBinary('/usr/share/nvm/versions/node/v20.18.0/bin/npm')
            ->waitUntilNetworkIdle()
            ->showBackground()
            ->addChromiumArguments(['disable-gpu', 'disable-dev-shm-usage', 'disable-setuid-sandbox', 'no-first-run', 'no-sandbox', 'no-zygote', 'deterministic-fetch', 'disable-features=IsolateOrigins', 'disable-site-isolation-trials'])
            ->margins(3, 15, 5, 15) 
            ->base64pdf();
    }

    public function save($path) {
        return $this->browsershot->html($this->html)
        ->setNodeBinary('/usr/share/nvm/versions/node/v20.18.0/bin/node')
        ->setNpmBinary('/usr/share/nvm/versions/node/v20.18.0/bin/npm')
        ->waitUntilNetworkIdle()
        ->showBackground()
        ->addChromiumArguments(['disable-gpu', 'disable-dev-shm-usage', 'disable-setuid-sandbox', 'no-first-run', 'no-sandbox', 'no-zygote', 'deterministic-fetch', 'disable-features=IsolateOrigins', 'disable-site-isolation-trials'])
        ->margins(3, 15, 5, 15) 
        ->save($path);
    }
}