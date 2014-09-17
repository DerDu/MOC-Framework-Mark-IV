<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Propel\Generator\Command;

use Propel\Generator\Schema\Dumper\XmlDumper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Propel\Generator\Manager\ReverseManager;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class DatabaseReverseCommand extends AbstractCommand
{
    const DEFAULT_OUTPUT_DIRECTORY  = 'generated-reversed-database';
    const DEFAULT_DATABASE_NAME     = 'default';
    const DEFAULT_SCHEMA_NAME       = 'schema';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->addOption('output-dir',    null, InputOption::VALUE_REQUIRED, 'The output directory', self::DEFAULT_OUTPUT_DIRECTORY)
            ->addOption('database-name', null, InputOption::VALUE_REQUIRED, 'The database name used in the created schema.xml', self::DEFAULT_DATABASE_NAME)
            ->addOption('schema-name',   null, InputOption::VALUE_REQUIRED, 'The schema name to generate', self::DEFAULT_SCHEMA_NAME)
            ->addArgument('connection',  InputArgument::OPTIONAL,     'Connection to use. Example: \'mysql:host=127.0.0.1;dbname=test;user=root;password=foobar\' (don\'t forget the quote)')
            ->setName('database:reverse')
            ->setAliases(array('reverse'))
            ->setDescription('Reverse-engineer a XML schema file based on given database')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configOptions = array();

        if ($this->hasInputArgument('connection', $input)) {
            $configOptions += $this->connectionToProperties('reverseconnection='.$input->getArgument('connection'), 'reverse');
            $configOptions['propel']['reverse']['parserClass'] = 
                sprintf('\\Propel\\Generator\\Reverse\\%sSchemaParser', ucfirst($configOptions['propel']['database']['connections']['reverseconnection']['adapter']));
        }

        $generatorConfig = $this->getGeneratorConfig($configOptions, $input);

        $this->createDirectory($input->getOption('output-dir'));

        $manager = new ReverseManager(new XmlDumper());
        $manager->setGeneratorConfig($generatorConfig);
        $manager->setLoggerClosure(function ($message) use ($input, $output) {
            if ($input->getOption('verbose')) {
                $output->writeln($message);
            }
        });
        $manager->setWorkingDirectory($input->getOption('output-dir'));
        $manager->setDatabaseName($input->getOption('database-name'));
        $manager->setSchemaName($input->getOption('schema-name'));

        if (true === $manager->reverse()) {
            $output->writeln('<info>Schema reverse engineering finished.</info>');
        } else {
            $more = $input->getOption('verbose') ? '' : ' You can use the --verbose option to get more information.';

            $output->writeln(sprintf('<error>Schema reverse engineering failed.%s</error>', $more));

            return 1;
        }
    }
}
