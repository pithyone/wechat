# 异步批量接口

```php
$batch = $app->get('batch');
```

## 邀请成员

```php
$batch->invite([
    'user' => ['UserID1', 'UserID2', 'UserID3']
]);
```

## 增量更新成员

```php
$batch->syncUser(['media_id' => 'xxxxxx']);
```

## 全量覆盖成员

```php
$batch->replaceUser(['media_id' => 'xxxxxx']);
```

## 全量覆盖部门

```php
$batch->replaceParty(['media_id' => 'xxxxxx']);
```

## 获取异步任务结果

```php
$batch->getResult('JOBID');
```
