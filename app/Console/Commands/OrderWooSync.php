<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

class OrderWooSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:woo-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync orders from WooCommerce';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $woocommerce = new Client(
            'https:// .nl',
            'ck_6a44b0d45a94afd4051081c4d7230e3a6afd5700',
            'cs_c42c5e09cd3e4b0062357693318c231b0a7da1ff',
            [
                'version' => 'wc/v3',
                'wp_api' => true,
                'timeout' => 400
            ]
        ); 
    }

}