<?php

declare (strict_types=1);
namespace EasyCI20220511\PhpParser\Node\Expr\AssignOp;

use EasyCI20220511\PhpParser\Node\Expr\AssignOp;
class Plus extends \EasyCI20220511\PhpParser\Node\Expr\AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Plus';
    }
}
