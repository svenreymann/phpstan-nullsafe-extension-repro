# PHPStan 2.3.0: nullsafe call reported as `method.nonObject` when the receiver type comes from an `ExpressionTypeResolverExtension`

```bash
git clone <this repository> && cd phpstan-nullsafe-extension-repro
composer install
vendor/bin/phpstan analyse
```

`src/Ext.php` is an `ExpressionTypeResolverExtension` that types `$crate->holder` as `Repro\Holder`.
`code.php` calls a method with `?->` on the nullable property `Holder::$day`.

| Version     | Result |
| ----------- | ------ |
| 2.2.17      | No errors |
| 2.3.0       | `11: Cannot call method toDateString() on Repro\Day\|null.` (`method.nonObject`) |
| 2.3.x-dev   | Same as 2.3.0 (tested 2026-10-07) |

To switch versions: `composer require --dev phpstan/phpstan:2.2.17 -W`.

Expected: no error. Line 13 does the same call through a local variable and is not reported.
