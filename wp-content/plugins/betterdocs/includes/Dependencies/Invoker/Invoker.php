<?php declare(strict_types=1);

namespace WPDeveloper\BetterDocs\Dependencies\Invoker;

use WPDeveloper\BetterDocs\Dependencies\Invoker\Exception\NotCallableException;
use WPDeveloper\BetterDocs\Dependencies\Invoker\Exception\NotEnoughParametersException;
use WPDeveloper\BetterDocs\Dependencies\Invoker\ParameterResolver\AssociativeArrayResolver;
use WPDeveloper\BetterDocs\Dependencies\Invoker\ParameterResolver\DefaultValueResolver;
use WPDeveloper\BetterDocs\Dependencies\Invoker\ParameterResolver\NumericArrayResolver;
use WPDeveloper\BetterDocs\Dependencies\Invoker\ParameterResolver\ParameterResolver;
use WPDeveloper\BetterDocs\Dependencies\Invoker\ParameterResolver\ResolverChain;
use WPDeveloper\BetterDocs\Dependencies\Invoker\Reflection\CallableReflection;
use WPDeveloper\BetterDocs\Dependencies\Psr\Container\ContainerInterface;
use ReflectionParameter;

/**
 * Invoke a callable.
 */
class Invoker implements InvokerInterface
{
    /** @var CallableResolver|null */
    private $callableResolver;

    /** @var ParameterResolver */
    private $parameterResolver;

    /** @var ContainerInterface|null */
    private $container;

    public function __construct(?ParameterResolver $parameterResolver = null, ?ContainerInterface $container = null)
    {
        $this->parameterResolver = $parameterResolver ?: $this->createParameterResolver();
        $this->container = $container;

        if ($container) {
            $this->callableResolver = new CallableResolver($container);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function call($callable, array $parameters = [])
    {
        if ($this->callableResolver) {
            $callable = $this->callableResolver->resolve($callable);
        }

        if (! is_callable($callable)) {
            throw new NotCallableException(sprintf(
                '%s is not a callable',
                is_object($callable) ? 'Instance of ' . get_class($callable) : var_export($callable, true)
            ));
        }

        $callableReflection = CallableReflection::create($callable);

        $args = $this->parameterResolver->getParameters($callableReflection, $parameters, []);

        // Sort by array key because call_user_func_array ignores numeric keys
        ksort($args);

        // Check all parameters are resolved
        $diff = array_diff_key($callableReflection->getParameters(), $args);
        $parameter = reset($diff);
        if ($parameter && \assert($parameter instanceof ReflectionParameter) && ! $parameter->isVariadic()) {
            throw new NotEnoughParametersException(sprintf(
                'Unable to invoke the callable because no value was given for parameter %d ($%s)',
                $parameter->getPosition() + 1,
                $parameter->name
            ));
        }

        return call_user_func_array($callable, $args);
    }

    /**
     * Create the default parameter resolver.
     */
    private function createParameterResolver(): ParameterResolver
    {
        return new ResolverChain([
            new NumericArrayResolver,
            new AssociativeArrayResolver,
            new DefaultValueResolver,
        ]);
    }

    /**
     * @return ParameterResolver By default it's a ResolverChain
     */
    public function getParameterResolver(): ParameterResolver
    {
        return $this->parameterResolver;
    }

    public function getContainer(): ?ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return CallableResolver|null Returns null if no container was given in the constructor.
     */
    public function getCallableResolver(): ?CallableResolver
    {
        return $this->callableResolver;
    }
}
