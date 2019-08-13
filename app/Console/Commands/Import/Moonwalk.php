<?php

namespace App\Console\Commands\Import;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Country;
use App\Models\Director;
use App\Models\Film;
use App\Models\Film_actor;
use App\Models\Film_Country;
use App\Models\Film_director;
use App\Models\Film_genre;
use App\Models\Film_studio;
use App\Models\Genre;
use App\Models\ImportMoonwalkCamrip;
use App\Models\ImportMoonwalkForeign;
use App\Models\ImportMoonwalkRussian;
use App\Models\ImportMoonwalkSerial;
use App\Models\Season_episodes_count;
use App\Models\Source_Type;
use App\Models\Studio;
use App\Models\Translator;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
    protected $data_import = null;
    protected $token = '000fa9e1bee1c7da7a1b74996d923405';

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

        $start = Carbon::now();

        // display class name
        $this->info(__CLASS__);

        // for action in command
        $ask_array = [
            1 => ['name' => 'Foreign import from Moonwalk', 'url' => 'http://moonwalk.cc/api/movies_foreign.json?api_token='],
            2 => ['name' => 'Russian import from Moonwalk', 'url' => 'http://moonwalk.cc/api/movies_russian.json?api_token='],
            3 => ['name' => 'Camrips import from Moonwalk', 'url' => 'http://moonwalk.cc/api/movies_camrip.json?api_token='],
            4 => ['name' => 'Serials import from Moonwalk', 'url' => 'http://moonwalk.cc/api/serials_foreign.json?api_token='],
            5 => ['name' => 'Serials Russian import from Moonwalk', 'url' => 'http://moonwalk.cc/api/serials_russian.json?api_token='],
            6 => ['name' => 'Test File', 'url' => env('APP_URL') . '/test_ser_en.json'],
        ];

        $token = $this->token;

        // get pretty name
        foreach ($ask_array as $key => $value) {
            $name[] = $key . ' - ' . $value['name'];
        }

        // ask admin what to do
        $ask = $this->ask('Enter the type of import: ' . implode('| ', $name));

        // check the answer
        if (!isset($ask_array[$ask])) {
            $this->error('incorrect commnad: ' . $ask);
            exit();
        }

        // display start action
        $this->info('Working with ' . $ask_array[$ask]['name']);

        if (in_array($ask, [1])) {

            $this->foreign($ask_array[$ask]['url'] . $token);

        } elseif (in_array($ask, [2])) {

            $this->russian($ask_array[$ask]['url']  . $token);

        } elseif (in_array($ask, [3])) {

            $this->camrip($ask_array[$ask]['url']  . $token);

        } elseif (in_array($ask, [4])) {

            $this->serial($ask_array[$ask]['url']  . $token);

        } elseif (in_array($ask, [5])) {

            $this->serialRus($ask_array[$ask]['url'] . $token);

        } elseif (in_array($ask, [6])) {

            $this->serial($ask_array[$ask]['url']);

        } else {
            $this->error('No action');
            return False;
        }

        $finish = Carbon::now();

        $this->info('DONE '. $ask_array[$ask]['name']);
        $this->info('started at '. $start);
        $this->info('finished at '. $finish);
        $this->info('spent time: '. $start->diffForHumans($finish));
        return True;


    }

    protected function foreign($url)
    {
        $this->info('url: ' . $url);
        $url = $this->storeFile($url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $this->info('report: ' . $report['report_name']);
            $this->info('generated: ' . Carbon::createFromTimestamp($report['generated_at'])->toDateTimeString());
            $this->info('count: ' . $report['total_count']);

            $items = $report['movies'];

            $bar = $this->output->createProgressBar($report['total_count']);

            foreach ($items as $item) {

                $bar->advance();

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
                $get['material_data'] = isset($item['material_data']) ? $item['material_data'] : '';

                // store data
                $this->storeImport($get);

            }

            $bar->finish();

//            $get['title_ru'] = $book->get('title_ru');
//            $get['title_en'] = $book->get('title_en');
//            $get['year'] = $book->get('year');
//            $get['duration'] = !empty($book->get('duration')) ? json_encode($book->get('duration')->toArray(), JSON_UNESCAPED_UNICODE) : '';
//            $get['kinopoisk_id'] = $book->get('kinopoisk_id');
//            $get['world_art_id'] = $book->get('world_art_id');
//            $get['pornolab_id'] = $book->get('pornolab_id');
//            $get['token'] = $book->get('token');
//            $get['type'] = $book->get('type');
//            $get['camrip'] = $book->get('camrip');
//            $get['source_type'] = $book->get('source_type');
//            $get['source_quality_type'] = $book->get('source_quality_type');
//            $get['instream_ads'] = $book->get('instream_ads');
//            $get['directors_version'] = $book->get('directors_version');
//            $get['iframe_url'] = $book->get('iframe_url');
//            $get['trailer_token'] = $book->get('trailer_token');
//            $get['trailer_iframe_url'] = $book->get('trailer_iframe_url');
//            $get['translator'] = $book->get('translator');
//            $get['translator_id'] = $book->get('translator_id');
//            $get['added_at'] = $book->get('added_at');
//            $get['category'] = $book->get('category');
//            $get['material_data'] = !empty($book->get('material_data')) ? json_encode($book->get('material_data')->toArray(), JSON_UNESCAPED_UNICODE) : '';

        });

    }

    protected function russian($url)
    {
        $this->info('url: ' . $url);
        $url = $this->storeFile($url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $this->info('report: ' . $report['report_name']);
            $this->info('generated: ' . Carbon::createFromTimestamp($report['generated_at'])->toDateTimeString());
            $this->info('count: ' . $report['total_count']);

            $items = $report['movies'];

            $bar = $this->output->createProgressBar($report['total_count']);

            foreach ($items as $item) {

                $bar->advance();

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
                $get['material_data'] = isset($item['material_data']) ? $item['material_data'] : '';

                // store data
                $this->storeImportRu($get);

            }

            $bar->finish();

        });

    }

    protected function camrip($url)
    {
        $this->info('url: ' . $url);
        $url = $this->storeFile($url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $this->info('report: ' . $report['report_name']);
            $this->info('generated: ' . Carbon::createFromTimestamp($report['generated_at'])->toDateTimeString());
            $this->info('count: ' . $report['total_count']);

            $items = $report['movies'];

            $bar = $this->output->createProgressBar($report['total_count']);

            foreach ($items as $item) {

                $bar->advance();

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
                $get['material_data'] = isset($item['material_data']) ? $item['material_data'] : '';

                // store data
                $this->storeImportCamrip($get);

            }

            $bar->finish();

        });

    }

    protected function serial($url)
    {
        $this->info('url: ' . $url);
        $url = $this->storeFile($url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $this->info('report: ' . $report['report_name']);
            $this->info('generated: ' . Carbon::createFromTimestamp($report['generated_at'])->toDateTimeString());
            $this->info('count: ' . $report['total_count']);

            $items = $report['serials'];

            $bar = $this->output->createProgressBar($report['total_count']);

            foreach ($items as $item) {

                $bar->advance();

                $get['title_ru'] = $item['title_ru'];
                $get['title_en'] = $item['title_en'];
                $get['year'] = $item['year'];
                $get['token'] = $item['token'];
                $get['type'] = $item['type'];
                $get['kinopoisk_id'] = $item['kinopoisk_id'];
                $get['world_art_id'] = $item['world_art_id'];
                $get['translator'] = $item['translator'];
                $get['translator_id'] = $item['translator_id'];
                $get['iframe_url'] = $item['iframe_url'];
                $get['trailer_token'] = $item['trailer_token'];
                $get['trailer_iframe_url'] = $item['trailer_iframe_url'];
                $get['seasons_count'] = $item['seasons_count'];
                $get['episodes_count'] = $item['episodes_count'];
                $get['category'] = $item['category'];
                $get['block'] = $item['block'];
                $get['season_episodes_count'] = isset($item['material_data']) ? json_encode($item['season_episodes_count']) : '';
                $get['material_data'] = isset($item['material_data']) ? $item['material_data'] : '';
                $get['source_type'] = Null;
                $get['duration'] = Null;
                $get['added_at'] = Null;

                // store data
                $this->storeImportSerial($get);

            }

            $bar->finish();

        });

    }

    protected function serialRus($url)
    {
        $this->info('url: ' . $url);
        $url = $this->storeFile($url);

        StreamParser::json($url)->each(function (Collection $book) {

            $report = $book->get('report');

            $this->info('report: ' . $report['report_name']);
            $this->info('generated: ' . Carbon::createFromTimestamp($report['generated_at'])->toDateTimeString());
            $this->info('count: ' . $report['total_count']);

            $items = $report['serials'];

            $bar = $this->output->createProgressBar($report['total_count']);

            foreach ($items as $item) {

                $bar->advance();

                $get['title_ru'] = $item['title_ru'];
                $get['title_en'] = $item['title_en'];
                $get['year'] = $item['year'];
                $get['token'] = $item['token'];
                $get['type'] = $item['type'];
                $get['kinopoisk_id'] = $item['kinopoisk_id'];
                $get['world_art_id'] = $item['world_art_id'];
                $get['translator'] = $item['translator'];
                $get['translator_id'] = $item['translator_id'];
                $get['iframe_url'] = $item['iframe_url'];
                $get['trailer_token'] = $item['trailer_token'];
                $get['trailer_iframe_url'] = $item['trailer_iframe_url'];
                $get['seasons_count'] = $item['seasons_count'];
                $get['episodes_count'] = $item['episodes_count'];
                $get['category'] = $item['category'];
                $get['block'] = $item['block'];
                $get['season_episodes_count'] = isset($item['material_data']) ? json_encode($item['season_episodes_count']) : '';
                $get['material_data'] = isset($item['material_data']) ? $item['material_data'] : '';
                $get['source_type'] = Null;
                $get['duration'] = Null;
                $get['added_at'] = Null;

                // store data
                $this->storeImportSerialRus($get);

            }

            $bar->finish();

        });

    }

    protected function storeImport($data)
    {

        $this->info('store movie');

        ImportMoonwalkForeign::firstOrcreate(
            ['kinopoisk_id' => $data['kinopoisk_id']],
            [
                'title_ru' => $data['title_ru'],
                'title_en' => $data['title_en'],
                'year' => $data['year'],
                'duration' => $data['duration'],
                'kinopoisk_id' => $data['kinopoisk_id'],
                'world_art_id' => $data['world_art_id'],
                'pornolab_id' => $data['pornolab_id'],
                'token' => $data['token'],
                'type' => $data['type'],
                'camrip' => $data['camrip'],
                'source_type' => $data['source_type'],
                'source_quality_type' => $data['source_quality_type'],
                'instream_ads' => $data['instream_ads'],
                'directors_version' => $data['directors_version'],
                'iframe_url' => $data['iframe_url'],
                'trailer_token' => $data['trailer_token'],
                'trailer_iframe_url' => $data['trailer_iframe_url'],
                'translator' => $data['translator'],
                'translator_id' => $data['translator_id'],
                'added_at' => $data['added_at'],
                'category' => $data['category'],
                'material_data' => $data['material_data']
            ]
        );

        $this->storeOneFilm($data);

    }

    protected function storeImportRu($data)
    {

        $this->info('store movie');

        ImportMoonwalkRussian::firstOrcreate(
            ['kinopoisk_id' => $data['kinopoisk_id']],
            [
                'title_ru' => $data['title_ru'],
                'title_en' => $data['title_en'],
                'year' => $data['year'],
                'duration' => $data['duration'],
                'kinopoisk_id' => $data['kinopoisk_id'],
                'world_art_id' => $data['world_art_id'],
                'pornolab_id' => $data['pornolab_id'],
                'token' => $data['token'],
                'type' => $data['type'],
                'camrip' => $data['camrip'],
                'source_type' => $data['source_type'],
                'source_quality_type' => $data['source_quality_type'],
                'instream_ads' => $data['instream_ads'],
                'directors_version' => $data['directors_version'],
                'iframe_url' => $data['iframe_url'],
                'trailer_token' => $data['trailer_token'],
                'trailer_iframe_url' => $data['trailer_iframe_url'],
                'translator' => $data['translator'],
                'translator_id' => $data['translator_id'],
                'added_at' => $data['added_at'],
                'category' => $data['category'],
                'material_data' => $data['material_data']
            ]
        );

        $this->storeOneFilm($data);

    }

    protected function storeImportCamrip($data) {
        $this->info('store movie');

        ImportMoonwalkCamrip::firstOrcreate(
            ['kinopoisk_id' => $data['kinopoisk_id']],
            [
                'title_ru' => $data['title_ru'],
                'title_en' => $data['title_en'],
                'year' => $data['year'],
                'duration' => $data['duration'],
                'kinopoisk_id' => $data['kinopoisk_id'],
                'world_art_id' => $data['world_art_id'],
                'pornolab_id' => $data['pornolab_id'],
                'token' => $data['token'],
                'type' => $data['type'],
                'camrip' => $data['camrip'],
                'source_type' => $data['source_type'],
                'source_quality_type' => $data['source_quality_type'],
                'instream_ads' => $data['instream_ads'],
                'directors_version' => $data['directors_version'],
                'iframe_url' => $data['iframe_url'],
                'trailer_token' => $data['trailer_token'],
                'trailer_iframe_url' => $data['trailer_iframe_url'],
                'translator' => $data['translator'],
                'translator_id' => $data['translator_id'],
                'added_at' => $data['added_at'],
                'category' => $data['category'],
                'material_data' => $data['material_data']
            ]
        );

        $this->storeOneFilm($data);
    }

    protected function storeImportSerial($data) {
        $this->info('store movie');

        ImportMoonwalkSerial::firstOrcreate(
            ['kinopoisk_id' => $data['kinopoisk_id']],
            [
                'title_ru' => $data['title_ru'],
                'title_en' => $data['title_en'],
                'year' => $data['year'],
                'token' => $data['token'],
                'type' => $data['type'],
                'kinopoisk_id' => $data['kinopoisk_id'],
                'world_art_id' => $data['world_art_id'],
                'translator' => $data['translator'],
                'translator_id' => $data['translator_id'],
                'iframe_url' => $data['iframe_url'],
                'trailer_token' => $data['trailer_token'],
                'trailer_iframe_url' => $data['trailer_iframe_url'],
                'seasons_count' => $data['seasons_count'],
                'episodes_count' => $data['episodes_count'],
                'category' => $data['category'],
                'block' => $data['block'],
                'season_episodes_count' => $data['season_episodes_count'],
                'material_data' => $data['material_data'],
                'source_type' => $data['source_type'],
                'duration' => $data['duration'],
                'added_at' => $data['added_at'],

            ]
        );

        $this->storeOneFilm($data);
    }

    protected function storeImportSerialRus($data) {
        $this->info('store movie');

        ImportMoonwalkSerial::firstOrcreate(
            ['kinopoisk_id' => $data['kinopoisk_id']],
            [
                'title_ru' => $data['title_ru'],
                'title_en' => $data['title_en'],
                'year' => $data['year'],
                'token' => $data['token'],
                'type' => $data['type'],
                'kinopoisk_id' => $data['kinopoisk_id'],
                'world_art_id' => $data['world_art_id'],
                'translator' => $data['translator'],
                'translator_id' => $data['translator_id'],
                'iframe_url' => $data['iframe_url'],
                'trailer_token' => $data['trailer_token'],
                'trailer_iframe_url' => $data['trailer_iframe_url'],
                'seasons_count' => $data['seasons_count'],
                'episodes_count' => $data['episodes_count'],
                'category' => $data['category'],
                'block' => $data['block'],
                'season_episodes_count' => $data['season_episodes_count'],
                'material_data' => $data['material_data'],
                'source_type' => $data['source_type'],
                'duration' => $data['duration'],
                'added_at' => $data['added_at'],

            ]
        );

        $this->storeOneFilm($data);
    }

//    protected function storeFilms()
//    {
//
//        ImportMoonwalkForeign::chunk('500', function ($imports) {
//            $count = count($imports);
//            $bar = $this->output->createProgressBar($count);
//            foreach ($imports as $import) {
//                $bar->advance();
//                $data = $import->toArray();
//                $this->storeOneFilm($data);
//            }
//            $bar->finish();
//        });
//
//    }

    protected function storeOneFilm($array)
    {

        // category
        $category_id = Category::updateOrcreate(['name' => trim($array['category'])],
            ['slug' => str_slug($array['category'], '_', 'en')])->id;
        // type
        $type_id = Type::updateOrcreate(['name' => trim($array['type'])],
            ['slug' => str_slug($array['type'], '_', 'en')])->id;
        // source_type
        $source_type_id = Null;
        if (!empty($array['source_type'])) {
            $source_type_id = Source_Type::updateOrcreate(['name' => trim($array['source_type'])],
                ['slug' => str_slug($array['source_type'], '_', 'en')])->id;
        }
        // translator
        $translator_id = Translator::updateOrcreate(['name' => trim($array['translator'])],
            ['slug' => str_slug($array['translator'], '_', 'en')])->id;
        // duration_human
        $duration_human = empty($array['duration']) ? '' : json_decode($array['duration'])->human;

        $poster = $tagline = $description = $kinopoisk_rating = $kinopoisk_votes = $age = null;
        if (!empty($array['material_data'])) {
            $material_data = json_decode($array['material_data']);
            // $poster
            $poster = $material_data->poster;
            // tagline
            $tagline = strlen($material_data->tagline) < 4 ? '' : $material_data->tagline;
            // description
            $description = $material_data->description;
            // kinopoisk_rating
            $kinopoisk_rating = $material_data->kinopoisk_rating;
            // kinopoisk_votes
            $kinopoisk_votes = $material_data->kinopoisk_votes;
            // age
            $age = $material_data->age;
        }

        // add film
        $film = Film::firstOrCreate(
            ['kinopoisk_id' => $array['kinopoisk_id']],
            [
                'title_ru' => $array['title_ru'],
                'title_en' => $array['title_en'],
                'year' => $array['year'],
                'token' => $array['token'],
                'kinopoisk_id' => $array['kinopoisk_id'],
                'world_art_id' => $array['world_art_id'],
                'category' => $category_id,
                'type' => $type_id,
                'source_type' => $source_type_id,
                'iframe_url' => $array['iframe_url'],
                'token' => $array['token'],
                'trailer_iframe_url' => $array['trailer_iframe_url'],
                'trailer_token' => $array['trailer_token'],
                'duration_human' => $duration_human,
                'translator' => $translator_id,
                'poster' => $poster,
                'tagline' => $tagline,
                'description' => $description,
                'age' => $age,
                'kinopoisk_rating' => $kinopoisk_rating,
                'kinopoisk_votes' => $kinopoisk_votes,
                'added_at' => $array['added_at']
            ]);

        // create url for movie
        $year = !empty($array['year']) ? '_'.$array['year'] : '';
        $slug = str_slug($array['title_ru'], '_', 'en').$year.'_'.$film->id;
        $movie = Film::find($film->id);
        $movie->slug = $slug;
        $movie->save();

        if (!empty($material_data)) {
            // countries
            if (isset($material_data->countries)) {
                foreach ($material_data->countries as $country) {
                    $country_id = Country::updateOrCreate(['name' => trim($country)],
                        ['slug' => str_slug(trim($country), '_', 'en')])->id;
                    Film_Country::updateOrCreate(['film_id' => $film->id, 'country_id' => $country_id]);
                }
            }

            // actors
            if (isset($material_data->actors)) {
                foreach ($material_data->actors as $actor) {
                    $actor_id = Actor::updateOrCreate(['name' => trim($actor)],
                        ['slug' => str_slug(trim($actor), '_', 'en')])->id;
                    Film_actor::updateOrCreate(['film_id' => $film->id, 'actor_id' => $actor_id]);
                }
            }

            // directors
            if (isset($material_data->directors)) {
                foreach ($material_data->directors as $director) {
                    $director_id = Director::updateOrCreate(['name' => trim($director)],
                        ['slug' => str_slug(trim($director), '_', 'en')])->id;
                    Film_director::updateOrCreate(['film_id' => $film->id, 'director_id' => $director_id]);
                }
            }

            // genres
            if (isset($material_data->genres)) {
                foreach ($material_data->genres as $genre) {
                    $genre_id = Genre::updateOrCreate(['name' => trim($genre)],
                        ['slug' => str_slug(trim($genre), '_', 'en')])->id;
                    Film_genre::updateOrCreate(['film_id' => $film->id, 'genre_id' => $genre_id]);
                }
            }

            // studio
            if (isset($material_data->studios)) {
                foreach ($material_data->studios as $studio) {
                    $studio_id = Studio::updateOrCreate(['name' => trim($studio)],
                        ['slug' => str_slug(trim($studio), '_', 'en')])->id;
                    Film_studio::updateOrCreate(['film_id' => $film->id, 'studio_id' => $studio_id]);
                }
            }

        }

        if ( isset($array['season_episodes_count']) && !empty($array['season_episodes_count']) ) {

            foreach (json_decode($array['season_episodes_count']) as $item) {

                Season_episodes_count::updateOrCreate(['film_id' => $film->id, 'season_number' => $item->season_number],
                    ['episodes_count' => $item->episodes_count, 'episodes' => json_encode($item->episodes)]);
            }
        }

    }

    protected function storeFile($url){
        $new_file = basename($url, "?api_token=".$this->token);

        $file_data_begin = "[";
        $file_data_end = "]";
        file_put_contents(public_path($new_file), $file_data_begin . file_get_contents($url) . $file_data_end);

        return url($new_file);
    }
}
