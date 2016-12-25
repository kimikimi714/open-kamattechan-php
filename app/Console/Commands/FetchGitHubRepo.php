<?php

namespace App\Console\Commands;

use Github\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchGitHubRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  protected $signature = 'fetch:github
                        {owner: Repository owner name}
                        {repo: Repository name}
                        {--x|execute=false: if false, execute this command with dry run mode.}
                        {--number : Pull Request Number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch GitHub Repo data and save DB';

    /**
     * Set true if dry run mode.
     * @var bool
     */
    private $dryRun = true;

    /**
     * GitHub API client.
     *
     * @var Client
     */
    private $client;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new \Github\Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      if ($this->option('execute')) {
        $this->dryRun = false;
      } else {
        $this->info('Dry run mode.');
      }
      $owner = $this->argument('owner');
      $repo = $this->argument('repo');
      $openPullRequests = $this->client->api('pr')->all($owner, $repo, ['state' => 'open']);
      foreach ($openPullRequests as $pr) {
        $this->line('number: ' . $pr['number']);
        $this->line('title: ' . $pr['title']);
        $this->line('owner: ' . $pr['head']['user']['login']);
        $this->line('url: ' . "https://github.com/${owner}/${repo}");
        if (!$this->dryRun) {
          DB::transaction(function () use ($owner, $repo, $pr) {
            $user = \App\User::firstOrCreate([
              'name' => $pr['head']['user']['login'],
              'email' => 'dummy@example.com',
              'url' => $pr['head']['user']['html_url'],
            ]);
            $review = \App\Review::updateOrCreate([
              'status' => $pr['state'] === 'open' ? 0 : 1,
              'hosting_type' => 'github',
              'repository_url' => "https://github.com/${owner}/${repo}",
              'number' => (int)$pr['number'],
              'title' => $pr['title'],
              'author_id' => $user->id,
            ]);
          });
        }
      }
    }
}
