<?php declare(strict_types = 1);

namespace Repro;

final class Day { public function toDateString(): string { return 'x'; } }
final class Holder { public ?Day $day = null; }
final class Crate {}

function test(Crate $crate): void
{
	$a = $crate->holder->day?->toDateString(); // reported on 2.3.0
	$h = $crate->holder;
	$b = $h->day?->toDateString();             // not reported
}
