## 自定义日志

如果你需要集成其他框架的日志操作，可以自己建立一个类并继承 [`Monolog\Handler\AbstractProcessingHandler`](https://github.com/Seldaek/monolog/blob/master/src/Monolog/Handler/AbstractProcessingHandler.php) 来完成日志写入

### 示例

```php
<?php

use Monolog\Handler\AbstractProcessingHandler;

class MyLogger extends AbstractProcessingHandler
{

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        // TODO: Implement write() method.
    }
}
```

### 用法

```php
$myLogger = new MyLogger();

$config = [
    //...

    'logger' => $myLogger,
];

$work = new Work($config);
```
