<?php namespace Repositories;

use Contracts\Repositories\FlowerRepositoryInterface;
use Flower;

class DbFlowerRepository extends DbRepository implements FlowerRepositoryInterface
{
    /** @var Flower */
    protected $model;

    public function __construct(Flower $model)
    {
        $this->model = $model;
    }

}
