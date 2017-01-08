<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  const OPEN = 0;
  const CLOSED = 1;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['status', 'hosting_type', 'repository_url', 'number', 'title', 'author_id'];

  protected $table = 'reviews';
}
