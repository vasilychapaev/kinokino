<?php

namespace App\Console\Commands\Import;

use App\Models\ImportMoonwalkForeign;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\Null_;
use Rodenastyle\StreamParser\StreamParser;
use Tightenco\Collect\Support\Collection;

class Moonwalk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:imp1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import from Moonwalk';

    /**
     * Variable for store data
     *
     * $var array
     */
    protected $data_import = Null;

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
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '2000M');

        // display class name
        $this->info(__CLASS__);

        // for action in command
        $ask_array = [
            1 => ['name' => 'Foreign import from Moonwalk', 'url' => 'http://moonwalk.cc/api/movies_foreign.json?api_token='],
            2 => ['name' => 'Russian import from Moonwalk', 'url' => 'http://kino.test/test.json']
        ];

        $token = '6eb82f15e2d7c6cbb2fdcebd05a197a2';

        // get pretty name
        foreach ($ask_array as $key => $value) {
            $name[] = $key  . ' - ' . $value['name'];
        }

        // ask admin what to do
        $ask =$this->ask('Enter the type of import: ' . implode('| ', $name));

        // check the answer
        if (!isset($ask_array[$ask])) {
            $this->error('incorrect commnad: ' . $ask);
            exit();
        }

        // display start action
        $this->info('Working with ' . $ask_array[$ask]['name']);

        if (in_array($ask,[1])) {

            $this->foreign($ask_array[$ask]['url'] . $token);

        } elseif(in_array($ask,[2])) {

            $this->foreign($ask_array[$ask]['url']);

        }


    }

    protected function foreign($url){

        $this->info('url: ' . $url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $items = $report['movies'];

            foreach ($items as $item) {

                $get['title_ru'] = $item['title_ru'];
                $get['title_en'] = $item['title_en'];
                $get['year'] = $item['year'];
                $get['duration'] = $item['duration'];
                $get['kinopoisk_id'] = $item['kinopoisk_id'];
                $get['world_art_id'] = $item['world_art_id'];
                $get['pornolab_id'] = $item['pornolab_id'];
                $get['token'] = $item['token'];
                $get['type'] = $item['type'];
                $get['camrip'] = $item['camrip'];
                $get['source_type'] = $item['source_type'];
                $get['source_quality_type'] = $item['source_quality_type'];
                $get['instream_ads'] = $item['instream_ads'];
                $get['directors_version'] = $item['directors_version'];
                $get['iframe_url'] = $item['iframe_url'];
                $get['trailer_token'] = $item['trailer_token'];
                $get['trailer_iframe_url'] = $item['trailer_iframe_url'];
                $get['translator'] = $item['translator'];
                $get['translator_id'] = $item['translator_id'];
                $get['added_at'] = $item['added_at'];
                $get['category'] = $item['category'];
                $get['material_data'] = $item['material_data'];

                // store data
                $this->store($get);

            }

        });
    }

    protected function store($data){

        var_dump($data);

        ImportMoonwalkForeign::firstOrcreate(
            ['token' => $data['token']],
            [
                'title_ru' => $data['title_ru'],
                'title_en'=> $data['title_en'],
                'year'=> $data['year'],
                'duration'=> $data['duration'],
                'kinopoisk_id'=> $data['kinopoisk_id'],
                'world_art_id'=> $data['world_art_id'],
                'pornolab_id'=> $data['pornolab_id'],
                'token'=> $data['token'],
                'type'=> $data['type'],
                'camrip'=> $data['camrip'],
                'source_type'=> $data['source_type'],
                'source_quality_type'=> $data['source_quality_type'],
                'instream_ads'=> $data['instream_ads'],
                'directors_version'=> $data['directors_version'],
                'iframe_url'=> $data['iframe_url'],
                'trailer_token'=> $data['trailer_token'],
                'trailer_iframe_url'=> $data['trailer_iframe_url'],
                'translator'=> $data['translator'],
                'translator_id'=> $data['translator_id'],
                'added_at'=> $data['added_at'],
                'category'=> $data['category'],
                'material_data'=> $data['material_data']
            ]
        );

    }
}
