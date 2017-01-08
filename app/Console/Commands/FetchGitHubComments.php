<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchGitHubComments extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'fetch:github:comments
                          {--x|execute : if false, execute this command with dry run mode.}
                          {--number : Pull Request Number}
  ';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fetch GitHub PullRequest comments and save DB';

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

    $reviews = \App\GithubReview::where('status', \App\Review::OPEN)->get();
    foreach ($reviews as $review) {
      $this->line('#' . $review->number . ' ' . $review->title . ' by ' . $review->author_id);
      $this->line('url: ' . \App\GithubReview::BASE_REPOSITORY_URL . '/' . $review->owner . '/' . $review->repo);
    }
  }

}

