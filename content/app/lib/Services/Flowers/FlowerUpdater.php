<?php namespace Services\Flowers;

use Contracts\Repositories\FlowerRepositoryInterface;
use Contracts\Notification\UpdaterInterface;
use Validators\FlowerValidator;

class FlowerUpdater
{

    /**
     * @param FlowerValidator $validator
     */
    protected $validator;

    /**
     * Inject the validator used for updating
     * 
     * @param FlowerValidator $validator
     */
    public function __construct(FlowerValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to update the flower with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  FlowerRepositoryInterface $flower
     * @param  UpdaterInterface         $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function update(FlowerRepositoryInterface $flower, UpdaterInterface $listener, $identity, array $attributes = [])
    {
        $instance = $flower->find($identity);

        if ($this->validator->validate($attributes)) {

            $instance->update($attributes);

            return $listener->updateSucceeded($instance);

        } else {

            return $listener->updateFailed($instance, $this->validator);
        }
    }
}
