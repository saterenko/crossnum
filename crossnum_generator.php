<?php


class CrossnumGenerator
{
    public function run(int $cols, int $rows, string $fileName): bool
    {
        $matrix = $this->generateSkeleton($cols, $rows);
    }

    private function generateSkeleton(int $cols, int $rows): array
    {
        $index = 0;
        /*  set first point  */
        $operations = [[
            'x' => rand(0, 2),
            'y' => rand(0, 2),
            'dir' => rand(0, 2)
        ]];
        while (true) {

        }

        return $matrix;
    }
}