<?php

/*
 * This file is part of composer/semver.
 *
 * (c) Composer <https://github.com/composer>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace EasyCI20220606\Composer\Semver;

use EasyCI20220606\Composer\Semver\Constraint\Constraint;
use EasyCI20220606\Composer\Semver\Constraint\ConstraintInterface;
/**
 * Helper class to evaluate constraint by compiling and reusing the code to evaluate
 */
class CompilingMatcher
{
    /**
     * @var array
     * @phpstan-var array<string, callable>
     */
    private static $compiledCheckerCache = array();
    /**
     * @var array
     * @phpstan-var array<string, bool>
     */
    private static $resultCache = array();
    /** @var bool */
    private static $enabled;
    /**
     * @phpstan-var array<Constraint::OP_*, Constraint::STR_OP_*>
     */
    private static $transOpInt = array(\EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_EQ => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_EQ, \EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_LT => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_LT, \EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_LE => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_LE, \EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_GT => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_GT, \EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_GE => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_GE, \EasyCI20220606\Composer\Semver\Constraint\Constraint::OP_NE => \EasyCI20220606\Composer\Semver\Constraint\Constraint::STR_OP_NE);
    /**
     * Clears the memoization cache once you are done
     *
     * @return void
     */
    public static function clear()
    {
        self::$resultCache = array();
        self::$compiledCheckerCache = array();
    }
    /**
     * Evaluates the expression: $constraint match $operator $version
     *
     * @param ConstraintInterface $constraint
     * @param int                 $operator
     * @phpstan-param Constraint::OP_*  $operator
     * @param string              $version
     *
     * @return mixed
     */
    public static function match(\EasyCI20220606\Composer\Semver\Constraint\ConstraintInterface $constraint, $operator, $version)
    {
        $resultCacheKey = $operator . $constraint . ';' . $version;
        if (isset(self::$resultCache[$resultCacheKey])) {
            return self::$resultCache[$resultCacheKey];
        }
        if (self::$enabled === null) {
            self::$enabled = !\in_array('eval', \explode(',', (string) \ini_get('disable_functions')), \true);
        }
        if (!self::$enabled) {
            return self::$resultCache[$resultCacheKey] = $constraint->matches(new \EasyCI20220606\Composer\Semver\Constraint\Constraint(self::$transOpInt[$operator], $version));
        }
        $cacheKey = $operator . $constraint;
        if (!isset(self::$compiledCheckerCache[$cacheKey])) {
            $code = $constraint->compile($operator);
            self::$compiledCheckerCache[$cacheKey] = $function = eval('return function($v, $b){return ' . $code . ';};');
        } else {
            $function = self::$compiledCheckerCache[$cacheKey];
        }
        return self::$resultCache[$resultCacheKey] = $function($version, \strpos($version, 'dev-') === 0);
    }
}
