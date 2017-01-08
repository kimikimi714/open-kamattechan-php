<?php

namespace App;

class GithubReview extends Review
{
  const HOSTING_TYPE = 'github';
  const BASE_REPOSITORY_URL = 'https://github.com';

  protected $appends = ['owner', 'repo'];

  public function getOwnerAttribute() {
    $path = parse_url($this->repository_url, PHP_URL_PATH);
    $parts = explode('/', $path);
    return $parts[1];
  }

  public function getRepoAttribute() {
    $path = parse_url($this->repository_url, PHP_URL_PATH);
    $parts = explode('/', $path);
    return $parts[2];
  }
}

