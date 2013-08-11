<?php namespace Trq\Advisory\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use SensioLabs\Security\SecurityChecker;

class AdvisoryCheckerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'advisory:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the SensioLabs Security Advisory.';

    /**
     * Security Checker
     *
     * @var SensioLabs\Security\SecurityChecker
     */
    protected $checker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SecurityChecker $checker)
    {
        parent::__construct();

        $this->checker = $checker;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $lockFile = $this->argument('lock');

        try {
            $data = $this->checker->check($this->argument('lock'), $this->option('format'));
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }

        $this->info($data);

        if ($this->checker->getLastVulnerabilityCount() > 0) {
            return 1;
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('format', '', InputOption::VALUE_REQUIRED, 'The output format', 'text')
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('lock', InputArgument::OPTIONAL, 'The path to the composer.lock file', 'composer.lock')
        );
    }

}
