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
  protected $signature = 'fetch:github:repositories
                      {owner : Repository owner name}
                      {repo : Repository name}
                      {--x|execute : if false, execute this command with dry run mode.}
                      {--number : Pull Request Number}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fetch GitHub Repo data and save DB';

  /**
   * Set true if dry run mode.
   *
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

  public function handle()
  {
    if ($this->option('execute')) {
      $this->dryRun = false;
    } else {
      $this->info('Dry run mode.');
    }
    $owner = $this->argument('owner');
    $repo = $this->argument('repo');
    $this->line('url: ' . \App\GithubReview::BASE_REPOSITORY_URL . "/${owner}/${repo}");
    $openPullRequests = $this->client->api('pr')->all($owner, $repo, ['state' => 'open']);
    foreach ($openPullRequests as $pr) {
      $this->line('#' . $pr['number'] . ' ' . $pr['title'] . ' by ' . $pr['head']['user']['login']);
      if (!$this->dryRun) {
        DB::transaction(function () use ($owner, $repo, $pr) {
          $user = \App\User::firstOrCreate([
            'name' => $pr['head']['user']['login'],
            'email' => 'dummy@example.com',
            'url' => $pr['head']['user']['html_url'],
          ]);
          $review = \App\GithubReview::updateOrCreate([
            'status' => $pr['state'] === 'open' ? \App\Review::OPEN : \App\Review::CLOSED,
            'hosting_type' => \App\GithubReview::HOSTING_TYPE,
            'repository_url' => \App\GithubReview::BASE_REPOSITORY_URL . "/${owner}/${repo}",
            'number' => (int)$pr['number'],
            'title' => $pr['title'],
            'author_id' => $user->id,
          ]);
        });
      }
    }
  }

}
