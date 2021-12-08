<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day7;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Common\IntCode\IO\FiberIo;
use App\Common\IntCode\IO\QueueIo;
use App\Common\IntCode\Program;
use App\Common\Permutations;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    use IntCodeInput;

    protected function solvePartOne(): Solution
    {
        $permutations = Permutations::permuteUnique(range(0, 4));
        $results = [];
        foreach ($permutations as $permutation) {
            $io1 = QueueIo::from([$permutation[0], 0]);

            $a = new Computer($this->getProgram());
            $a->setInputProvider($io1);
            $a->setOutputProvider(QueueIo::from([$permutation[1]]));
            $a->run();

            $b = new Computer($this->getProgram());
            $a->pipeOutputInto($b);
            $b->setOutputProvider(QueueIo::from([$permutation[2]]));
            $b->run();

            $c = new Computer($this->getProgram());
            $b->pipeOutputInto($c);
            $c->setOutputProvider(QueueIo::from([$permutation[3]]));
            $c->run();

            $d = new Computer($this->getProgram());
            $c->pipeOutputInto($d);
            $d->setOutputProvider(QueueIo::from([$permutation[4]]));
            $d->run();

            $outputIo = QueueIo::from([]);
            $e = new Computer($this->getProgram());
            $d->pipeOutputInto($e);
            $e->setOutputProvider($outputIo);
            $e->run();

            $results[] = $outputIo->read();
        }
        return new PrimitiveValueSolution(max(...$results));
    }

    protected function solvePartTwo(): Solution
    {
        $permutations = Permutations::permuteUnique(range(5, 9));
        $results = [0];
        foreach ($permutations as $permutation) {
            $startIo = FiberIo::from([$permutation[0], 0]);

            $a = new Computer($this->getProgram());
            $a->setInputProvider($startIo);
            $a->setOutputProvider(FiberIo::from([$permutation[1]]));
            $a->run();

            $b = new Computer($this->getProgram());
            $a->pipeOutputInto($b);
            $b->setOutputProvider(FiberIo::from([$permutation[2]]));
            $b->run();

            $c = new Computer($this->getProgram());
            $b->pipeOutputInto($c);
            $c->setOutputProvider(FiberIo::from([$permutation[3]]));
            $c->run();

            $d = new Computer($this->getProgram());
            $c->pipeOutputInto($d);
            $d->setOutputProvider(FiberIo::from([$permutation[4]]));
            $d->run();

            $e = new Computer($this->getProgram());
            $d->pipeOutputInto($e);
            $e->setOutputProvider($startIo);
            $e->run();

            $results[] = $startIo->read();
        }
        return new PrimitiveValueSolution(max(...$results));
    }

    private function getInput(): Stringable
    {
        return $this->read('2019', '7');
    }
}
