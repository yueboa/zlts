<?php
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
/**
 * 维护命令
 */
class Maintains extends Command
{
    public $op = [
        'getGoods' => 'getGoods',
    ];

    protected function configure()
    {
        $this->setName('w')->addOption('OP', 'o', Option::VALUE_REQUIRED)->setDescription('Maintain');
    }

    protected function execute(Input $input, Output $output)
    {
        $o = $this->op[$input->getOption('OP')];
        $output->writeln($this->{$o}());
    }
    //拉取商品
    protected function getGoods()
    {
        $Goods = controller('api/Goods');
        $re    = $Goods->getGoods();
        if ($re['num']=200) {
            return "update Successed";
        }else{
            return "update Fail";
        }
    }


}