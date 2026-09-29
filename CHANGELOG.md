# Changelog

## 0.2.0

### Breaking

- `Serializer::unserialize()` refuses closure payloads (data produced by `Serializer::serialize()` for a value containing a closure) and throws `Utopia\Async\Exception\Serialization`. Decoding a closure payload through `opis/closure` rebuilds the objects inside it by reflection, which the `allowed_classes` option does not govern, so it no longer happens by default. Plain payloads keep the `allowed_classes => false` default.

### Added

- `Serializer::unserializeTrusted()` decodes closure payloads for data from a trusted channel (this process or its own workers). The Swoole process pool uses it for its own worker channel.

## 0.1.1

- `Promise::all()` records the error before signalling its channel.
- The parallel pool skips SIGKILL for workers that are already reaped on shutdown.
- PHPStan level-max fixes in the Timer and Promise adapters.

## 0.1.0

- Initial release.
