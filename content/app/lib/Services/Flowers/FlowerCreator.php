<?php namespace Services\Flowers;

use Contracts\Repositories\FlowerRepositoryInterface;
use Contracts\Notification\CreatorInterface;
use Validators\FlowerValidator;

class FlowerCreator
{

    /**
     * @param FlowerValidator $validator
     */
    protected $validator;


    /**
     * Inject the validator that will be used for
     * creation
     * 
     * @param FlowerValidator $validator
     */
    public function __construct(FlowerValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to create a new flower with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  FlowerRepositoryInterface $flower     
     * @param  CreatorInterface         $listener  
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener                        
     */
    public function create(FlowerRepositoryInterface $repository, CreatorInterface $listener, array $attributes = [])
    {
        if ($this->validator->validate($attributes)) {

            if ($instance = $repository->create($attributes)) {
                return $listener->creationSucceeded($instance);
            } else {
                return $listener->creationFailed();
            }

        } else {
            return $listener->creationFailedValidation($this->validator);
        }
    }
}
