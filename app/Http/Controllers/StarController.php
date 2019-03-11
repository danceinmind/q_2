<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\Goutte;
use App\Star;

class StarController extends Controller
{
    protected $newStar;

    public function star() {
        $crawler = $this->originalLink();
        $crawler->filter('.STAR12_BOX ul li')->each(function ($node) {
            $this->newStar = new Star;
            $this->newStar->starName = $node->text();
            $eachStarCrawler = $this->eachStarLink($node->text());
            $eachStarCrawler->filter('#iAcDay option[selected="selected"]')->each(function ($date) {
                $this->newStar->date = $date->text();
            });
            $eachStarCrawler->filter('.TODAY_CONTENT p')->each(function ($content) {
                if($this->newStar->overview == NULL) $this->newStar->overview = $content->text();
                elseif($this->newStar->overview_description == NULL) $this->newStar->overview_description = $content->text();
                elseif($this->newStar->love == NULL) $this->newStar->love = $content->text();
                elseif($this->newStar->love_description == NULL) $this->newStar->love_description = $content->text();
                elseif($this->newStar->career == NULL) $this->newStar->career = $content->text();
                elseif($this->newStar->career_description == NULL) $this->newStar->career_description = $content->text();
                elseif($this->newStar->financial == NULL) $this->newStar->financial = $content->text();
                elseif($this->newStar->financial_description == NULL) $this->newStar->financial_description = $content->text();
            });
            $this->newStar->save();
        });
    }

    public function originalLink() {
        $client = new \Goutte\Client();
        return $client->request('GET', env('CRAWLER_LINK'));
    }

    public function eachStarLink(string $star) {
        $client = new \Goutte\Client();
        return $client->request('GET', $this->originalLink()->selectLink($star)->link()->getUri());
    }
}
