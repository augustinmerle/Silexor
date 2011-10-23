<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Benjamin Grandfond <benjamin.grandfond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * GenerateProject class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Silexor\Generator\ProjectGenerator;

class GenerateProjectCommand extends Command
{
    /**
     * @var Silexor\Generator\Generator $generator
     */
    protected $generator;

    public function configure()
    {
        $this->setName('project:generate')
            ->addArgument('name', InputArgument::REQUIRED, 'Your project name.')
            ->addOption('path', 'p', InputOption::VALUE_OPTIONAL, 'The path where Silexor will generate the project.', getcwd())
            ->setDescription('Generates the structure of a Silex project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Generating "%s" in %s.', $input->getArgument('name'), $input->getOption('path')));
        
        $this->getGenerator()->generate($input->getArgument('name'), $input->getOption('path'));

        $output->writeln(sprintf('Project "%s" generated.', $input->getArgument('name')));
    }

    /**
     * @param \Silexor\Command\Silexor\Generator\Generator $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return \Silexor\Command\Silexor\Generator\Generator
     */
    public function getGenerator()
    {
        if ($this->generator === null) {
            $this->generator = new ProjectGenerator();
        }
        
        return $this->generator;
    }
}
