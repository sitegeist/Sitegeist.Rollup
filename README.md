# Sitegeist.Rollup

Fusion Prototypes to instantiate PHP Objects. 

### Authors & Sponsors

* Martin Ficzel - ficzel@sitegeist.de
* Bernhard Schmitt - schmitt@sitegeist.de

*The development and the public-releases of this package is generously sponsored
by our employer http://www.sitegeist.de.*

## Usage 

The following php object 

```
<?php
declare(strict_types=1);

namespace Vendor\Example;

use Neos\Flow\Annotations as Flow;

#[Flow\Proxy(false)]
class Thing
{
    public function __construct(
        public string $foo,
        public int $bar
    ) {}
}
```

Can be instantiated in Fusion via. If no `factoryMethod` is defined
the arguments are passed to the constructor of the class. 

```
thing = Sitegeist.Rollup:Object {
    className = 'Vendor\\Example\\Thing'    
    arguments {
        foo = 'hello'
        bar = 124
    }  
}
```

To instantiate value objects or backed enums the `factoryMethod` can 
be specified aswell.

```
other = Sitegeist.Rollup:Object {
    className = 'Vendor\\Example\\Thing'
    factoryMethod = 'from'
    arguments.0 = "XS"
}

stuff = Sitegeist.Rollup:Object {
    className = 'Vendor\\Example\\SizeEnum'
    factoryMethod = 'fromArray'
    arguments.0 = Neos.Fusion:DataStructure {
        foo = 'hello'
        bar = 124
    }
}
```

## Contribution

We will gladly accept contributions. Please send us pull requests.
