<?php declare(strict_types = 1);

namespace ReproExt;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Identifier;
use PHPStan\Analyser\Scope;
use PHPStan\Type\ExpressionTypeResolverExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

/**
 * Types $crate->holder as Repro\Holder.
 */
final class Ext implements ExpressionTypeResolverExtension
{
	public function getType(Expr $expr, Scope $scope): ?Type
	{
		if ($expr instanceof PropertyFetch
			&& $expr->name instanceof Identifier
			&& $expr->name->name === 'holder'
			&& (new ObjectType('Repro\Crate'))->isSuperTypeOf($scope->getType($expr->var))->yes()) {
			return new ObjectType('Repro\Holder');
		}

		return null;
	}
}
