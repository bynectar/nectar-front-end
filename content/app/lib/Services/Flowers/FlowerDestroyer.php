<?php namespace Services\Flowers;

use Contracts\Repositories\FlowerRepositoryInterface;
use Contracts\Notification\DestroyerInterface;
use Validators\FlowerValidator;

class FlowerDestroyer
{

    /**
     * Attempt to destroy the flower and
     * notify the $listener of the success or failure.  The
     * $attributes are passed in as a convenience in case they
     * are needed
     * 
     * @param  FlowerRepositoryInterface $flower
     * @param  DestroyerInterface       $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function destroy(FlowerRepositoryInterface $flower, DestroyerInterface $listener, $identity, array $attributes = [])
    {
        $instance = $flower->find($identity);

        if ($flower->delete($instance)) {

            return $listener->destroySucceeded($instance);

        } else {

            return $listener->destroyFailed($instance);
        }
    }
}
