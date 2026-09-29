# Upgrade Guide

## 0.1.x to 0.2.0

### Closure payloads need trusted decoding

`Serializer::unserialize()` no longer decodes closure payloads. It throws `Utopia\Async\Exception\Serialization` for them, because `opis/closure` rebuilds the objects inside such a payload by reflection, outside the control of the `allowed_classes` option.

If you pass closures between processes you control, switch those call sites to `Serializer::unserializeTrusted()`:

```php
// 0.1.x
$task = Serializer::unserialize($message);

// 0.2.0
$task = Serializer::unserializeTrusted($message);
```

Keep `Serializer::unserialize()` for everything that does not need closures, and never pass data from users, caches, queues or other shared storage to `Serializer::unserializeTrusted()`.

`Serializer::unserializeTrusted()` accepts the same `$options` and still applies `allowed_classes => false` to plain payloads.
