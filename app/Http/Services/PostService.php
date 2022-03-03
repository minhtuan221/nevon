<?php

namespace  App\Services;

use App\Repositories\Post\PostRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PostService
{
      protected $postRepository;
      public function __construct(PostRepository $postRepository)
      {
            $this->postRepository = $postRepository;
      }

      public function getAll()
      {

            return  $this->postRepository->getPostHost();
      }
}
