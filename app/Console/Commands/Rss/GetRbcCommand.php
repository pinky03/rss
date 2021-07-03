<?php

namespace App\Console\Commands\Rss;

use Illuminate\Console\Command;
use Curl\Curl;
use App\Jobs\LoggingRssQuery;
use \SimpleXMLElement;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Log;

class GetRbcCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:rbc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load and save RSS http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    /**
     * @var string
     */
    private $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $curl = new Curl;
        $curl->setOpt(CURLOPT_ENCODING , 'utf-8');
        $curl->get($this->url);

        $this->logQuery($curl);

        if ($curl->error) {
            $this->error('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
            return $curl->errorCode;
        }
        $xml = $curl->getRawResponse();
        $this->saveArticles($xml);
        return 0;
    }

    /**
     * Save articles from rss-feed
     *
     * @param string $xml
     * @return void
     */
    private function saveArticles(string $xml)
    {
        $feed = new SimpleXMLElement($xml, LIBXML_NOCDATA);
        foreach($feed->xpath('//item') as $item) {
            $article = new Article;
            $article->title = $item->title;
            $article->link = $item->link;
            $article->description = $item->description;
            $article->pub_date = $item->pubDate;
            $article->author = $item->author;
            $article->image_link = $item->enclosure['url'];
            $article->save();
        }
    }

    /**
     * Save results in table
     * Save raw response in storage\xml
     *
     * @param Curl $curl
     * @return void
     */
    private function logQuery(Curl $curl)
    {
        $storageName = microtime(true) . '.xml';
        Storage::put('responses/'.$storageName, $curl->getRawResponse());
        $log = new Log;
        $log->method = 'GET';
        $log->url = $curl->getUrl();
        $log->http_code = $curl->getHttpStatusCode();
        $log->response_storage_name = $storageName;
        $log->save();
    }
}
