<?php

declare (strict_types=1);
namespace EasyCI20220523\PhpParser\Node\Expr\BinaryOp;

use EasyCI20220523\PhpParser\Node\Expr\BinaryOp;
class Greater extends \EasyCI20220523\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '>';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Greater';
    }
}
