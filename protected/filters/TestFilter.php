<?php
class TestFilter extends CFilter
{
	private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

	protected function preFilter($filterChain)
	{
		echo $this->getName()."--prefilter";// 动作被执行之前应用的逻辑
		return true; // 如果controller中的动作不应被执行，此处返回 false
	}

	protected function postFilter($filterChain)
	{
		echo "postFilter";// 动作执行之后应用的逻辑
	}
}