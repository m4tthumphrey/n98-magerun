<?php

namespace N98\Magento\Command\System\Website;

use N98\Magento\Command\AbstractMagentoCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends AbstractMagentoCommand
{
    /**
     * @var array
     */
    protected $infos;

    protected function configure()
    {
        $this
            ->setName('system:website:list')
            ->setAliases(array('sys:website:list'))
            ->setDescription('Lists all websites');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->detectMagento($output, true);

        $this->writeSection($output, 'Magento Websites');
        $this->initMagento();

        foreach (\Mage::app()->getWebsites() as $store) {
            $table[$store->getId()] = array(
                'id'   => '  ' . $store->getId(),
                'code' => $store->getCode(),
            );
        }

        ksort($table);
        $this->getHelper('table')->write($output, $table);
    }
}