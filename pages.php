<?php
echo implode(' - ', generatePages($_GET['page'], $_GET['pages'] ?? 10));

function generatePages(
    $currentPage,
    $pagesCount,
    $startCount = 1,
    $middleCount = 2,
    $endCount = 1,
    $strSplit = '...'
){
    return array_reduce(array_merge(
        range(1, $startCount),
        range($currentPage - $middleCount, $currentPage + $middleCount),
        range($pagesCount - $endCount + 1, $pagesCount)),
        function($carry, $item) use ($pagesCount, $strSplit) {
                if ($item < 1 || $item > $pagesCount || array_search($item, $carry) !== false) return $carry;
                if (is_numeric(end($carry)) && $item - end($carry) > 1) {
                    //$carry[] = $strSplit;
                    $carry[] = ($item - end($carry) > 2) ? $strSplit : $item - 1;
                }
                $carry[] = $item;

                return $carry;
        }, []);
}