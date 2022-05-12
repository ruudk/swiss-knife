<?php

declare (strict_types=1);
namespace EasyCI20220512\PhpParser\Node\Expr\BinaryOp;

use EasyCI20220512\PhpParser\Node\Expr\BinaryOp;
class LogicalAnd extends \EasyCI20220512\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return 'and';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_LogicalAnd';
    }
}
