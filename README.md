Keikogi Status
==============

Get system info and list of loaded services.

Requirements
------------
PHP 5.3+

Installation
------------
Add this to a composer.json file:
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/keikogi/status"
    }
],
"require": {
    "keikogi/status": ">=1.0.0"
}
```

Usage
-----
```
require_once __DIR__ . '/vendor/autoload.php';

use Keikogi\Status\Status;

echo Status::get();
```
