<?php

declare (strict_types=1);
namespace EasyCI20220522\PHPStan\PhpDocParser\Ast\ConstExpr;

use EasyCI20220522\PHPStan\PhpDocParser\Ast\NodeAttributes;
class ConstExprTrueNode implements \EasyCI20220522\PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprNode
{
    use NodeAttributes;
    public function __toString() : string
    {
        return 'true';
    }
}
