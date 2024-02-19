<?php
// PHP < 8.2
/*
    class BlogData
    {
        public readonly string $title;

        public readonly Status $status;

        public function __construct(string $title, Status $status)
        {
            $this->title = $title;
            $this->status = $status;
        }
    }
*/
/**
 * PHP 8.2 - new readonly classes
    readonly class BlogData
    {
        public string $title;

        public Status $status;

        public function __construct(string $title, Status $status)
        {
            $this->title = $title;
            $this->status = $status;
        }
    }

 */

//  Disjunctive Normal Form (DNF) Types
/**
 * PHP < 8.2
    class Foo {
        public function bar(mixed $entity) {
            if ((($entity instanceof A) && ($entity instanceof B)) || ($entity === null)) {
                return $entity;
            }

            throw new Exception('Invalid entity');
        }
    }
 */
/**
 * PHP 8.2
class Foo {
    public function bar((A&B)|null $entity) {
        return $entity;
    }
}
 */
/**
 * Allow null, false, and true as stand-alone types
 * PHP < 8.2
class Falsy
{
    public function almostFalse(): bool {}

    public function almostTrue(): bool {}

    public function almostNull(): string|null {}
}
 */

/**
 * PHP 8.2
class Falsy
{
    public function alwaysFalse(): false {}

    public function alwaysTrue(): true {}

    public function alwaysNull(): null {}
}

 */
/**
 * Constants in traits
 * 
 * PHP 8.2
trait Foo
{
    public const CONSTANT = 1;
}

class Bar
{
    use Foo;
}

var_dump(Bar::CONSTANT); // 1
var_dump(Foo::CONSTANT); // Error
 */

/**
 * Deprecate dynamic properties
 * 
 * PHP < 8.2
class User
{
    public $name;
}

$user = new User();
$user->last_name = 'Doe';

$user = new stdClass();
$user->last_name = 'Doe';
*/

/**
* PHP 8.2
class User
{
    public $name;
}

$user = new User();
$user->last_name = 'Doe'; // Deprecated notice

$user = new stdClass();
$user->last_name = 'Doe'; // Still allowed
*
* The creation of dynamic properties is deprecated to help avoid mistakes and typos, unless the class opts in by using the #[\AllowDynamicProperties] attribute. stdClass allows dynamic properties.
* Usage of the __get/__set magic methods is not affected by this change.
*/
/**
 * 1. return type declaration
 * 2. Null coalescing operator
 * 3. Spaceship operator returns -1, 0 or 1
 *      echo 1 <=> 1; // 0
 *      echo 1 <=> 2; // -1
 *      echo 2 <=> 1; // 1
 * 4. Anonymous class
 */
?>