<?php namespace Tests\Services\Flowers;

/**
 * This class contains unit tests
 *
 */

use Mockery as m;
use Services\Flowers\FlowerUpdater;

class FlowerUpdaterTest extends \TestCase
{
    /** @var array */
    protected $attrs;

    /** @var \Mockery\MockInterface */
    protected $validator;

    /** @var \Mockery\MockInterface */
    protected $repository;

    /** @var \Mockery\MockInterface */
    protected $listener;

    /** @var string */
    protected $modelClass = '\Flower';

    public function setUp()
    {
        parent::setUp();

        $this->attrs = [];
        $this->validator = m::mock('Validators\FlowerValidator');
        $this->repository = m::mock('Contracts\Repositories\FlowerRepositoryInterface');
        $this->listener = m::mock('Contracts\Notification\UpdaterInterface');
    }



    /**
     * If the stars align, success!
     */
    public function testUpdateSuccess()
    {
        $flower = m::mock($this->modelClass);
        $flower->shouldReceive('fill')->with($this->attrs)->once();

        $this->repository
            ->shouldReceive('findOrFail')
            ->with(1)
            ->once()
            ->andReturn($flower);

        $this->validator
            ->shouldReceive('validate')
            ->with($this->attrs)
            ->once()
            ->andReturn(true);

        $this->repository
            ->shouldReceive('update')
            ->with($flower)
            ->once()
            ->andReturn($flower);

        $this->listener
            ->shouldReceive('updateSucceeded')
            ->with($flower)
            ->once();

        $updater = new FlowerUpdater($this->validator);
        $updater->update($this->repository, $this->listener, 1, $this->attrs);
    }



    /**
     * If validation fails, update fails
     */
    public function testUpdateFailedValidation()
    {
        $flower = m::mock($this->modelClass);

        $this->repository
            ->shouldReceive('findOrFail')
            ->with(1)
            ->once()
            ->andReturn($flower);

        $this->validator
            ->shouldReceive('validate')
            ->with($this->attrs)
            ->once()
            ->andReturn(false);

        $this->listener
            ->shouldReceive('updateFailed')
            ->with($flower, $this->validator)
            ->once();

        $updater = new FlowerUpdater($this->validator);
        $updater->update($this->repository, $this->listener, 1, $this->attrs);
    }
}
