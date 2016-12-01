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
      return response()->json([
        'type' => 'weekly',
        'rankings' => [
          [
            'rank' => 1,
            'name' => 'hoge',
          ],
          [
            'rank' => 1,
            'name' => 'hoge',
          ],
        ]
      ]);
    }

    /**
     * Show weekly / monthly / danger rankings.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
      return response()->json([
        'type' => $type,
        'rankings' => [
          [
            'rank' => 1,
            'name' => 'hoge',
          ],
          [
            'rank' => 1,
            'name' => 'hoge',
          ],
        ]
      ]);
    }
}
