<?php
echo implode(' - ', generatePages($_GET['page'], $_GET['pages'] ?? 10));

function generatePages(
    $currentPage,
    $pagesCount,
    $startCount = 1,
    $middleCount = 2,
    $endCount = 1,
    $strSplit = '...',
    $removeSinglePageSplitter = true
){
    return array_reduce(array_merge(
        range(1, $startCount),
        range(max($currentPage - $middleCount, $startCount + 1), min($currentPage + $middleCount, $pagesCount - $endCount)),
        range($pagesCount - $endCount + 1, $pagesCount)),
        function($carry, $item) use ($pagesCount, $strSplit, $removeSinglePageSplitter) {
                if (is_numeric(end($carry)) && $item - end($carry) > 1) {
                    $carry[] = ($removeSinglePageSplitter && $item - end($carry) == 2) ? $item - 1 : $strSplit;
                }
                $carry[] = $item;

                return $carry;
        }, []);
}
