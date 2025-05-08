<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\XmlFeed;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImportXmlFeeds extends Command
{
    protected $signature = 'import:xml-feeds';
    protected $description = 'Import products from XML feeds';

    public function handle()
    {
        $feeds = XmlFeed::where('is_active', true)->get();
        
        $this->info("Found {$feeds->count()} active XML feeds to process.");
        
        foreach ($feeds as $feed) {
            $this->info("Processing feed: {$feed->url}");
            
            try {
                $response = Http::timeout(60)->get($feed->url);
                
                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body());
                    
                    $successCount = 0;
                    $errorCount = 0;
                    
                    foreach ($xml->item as $item) {
                        try {
                            // Find or create category
                            $categoryName = (string)$item->category;
                            $category = Category::firstOrCreate(
                                ['name' => $categoryName],
                                ['slug' => Str::slug($categoryName)]
                            );
                            
                            // Find existing product by EAN or create new
                            $ean = (string)$item->ean;
                            $product = null;
                            
                            if (!empty($ean)) {
                                $product = Product::where('ean', $ean)
                                    ->where('shop_id', $feed->shop_id)
                                    ->first();
                            }
                            
                            if (!$product) {
                                $product = new Product();
                                $product->shop_id = $feed->shop_id;
                                $product->ean = $ean;
                            }
                            
                            // Update product data
                            $product->name = (string)$item->name;
                            $product->link = (string)$item->link;
                            $product->price = (float)$item->price;
                            $product->price_sale = !empty($item->price_sale) ? (float)$item->price_sale : null;
                            $product->image = (string)$item->image;
                            $product->manufacturer = (string)$item->manufacturer;
                            $product->model = (string)$item->model;
                            $product->category_id = $category->id;
                            $product->category_full = (string)$item->category_full;
                            $product->category_link = (string)$item->category_link;
                            $product->in_stock = (int)$item->in_stock;
                            $product->used = (bool)((int)$item->used);
                            
                            // Process delivery info
                            if (!empty($item->delivery_cost_riga)) {
                                $product->delivery_cost = (float)$item->delivery_cost_riga;
                            }
                            
                            if (!empty($item->delivery_days_riga)) {
                                $product->delivery_days = (int)$item->delivery_days_riga;
                            }
                            
                            $product->save();
                            $successCount++;
                            
                        } catch (\Exception $e) {
                            $errorCount++;
                            Log::error("Error processing product: " . $e->getMessage());
                        }
                    }
                    
                    // Update feed stats
                    $feed->last_processed = now();
                    $feed->products_count = $successCount + $errorCount;
                    $feed->success_count = $successCount;
                    $feed->error_count = $errorCount;
                    $feed->error_message = null;
                    $feed->save();
                    
                    $this->info("Processed {$successCount} products successfully with {$errorCount} errors.");
                    
                } else {
                    $feed->error_message = "HTTP error: " . $response->status();
                    $feed->save();
                    $this->error("HTTP error: " . $response->status());
                }
                
            } catch (\Exception $e) {
                $feed->error_message = $e->getMessage();
                $feed->save();
                $this->error("Error: " . $e->getMessage());
            }
        }
        
        return 0;
    }
}