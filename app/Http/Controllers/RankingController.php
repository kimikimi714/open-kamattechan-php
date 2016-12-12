<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Show weekly rankings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $client = new \Github\Client();
      $repositories = $client->api('user')->repositories('kimikimi714');
      return response()->json($repositories);
    }

    /**
     * Show weekly / monthly / danger rankings.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
      return response()->json($this->getDummy());
    }

    private function getDummy() {
      return [
        'type' => 'weekly',
        'rankings' => [
          [
            'rank' => 1,
            'user' => [
              'name' => 'kimikimi714',
              'profileUrl' => 'https://github.com/kimikimi714',
              'imageUrl' => '/storage/images/kimikimi714.jpeg',
            ],
            'comment' => [
              'text' => 'Good comment!',
              'file' => 'hoge.php',
              'line' => 2,
              'reviewUrl' => 'https://github.com/kimikimi714/config/pull/2',
            ],
          ],
          [
            'rank' => 2,
            'user' => [
              'name' => 'kimikimi714',
              'profileUrl' => 'https://github.com/kimikimi714',
              'imageUrl' => '/storage/images/kimikimi714.jpeg',
            ],
            'comment' => [
              'text' => 'Good comment!',
              'file' => 'hoge.php',
              'line' => 2,
              'reviewUrl' => 'https://github.com/kimikimi714/config/pull/2',
            ],
          ],
        ]
      ];
    }
}
