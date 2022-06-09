<?php


namespace Belvg\UiGrid\Controller\Mui;

use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $customerSession;

    protected $pageFactory;

    protected $factory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\View\Element\UiComponentFactory $factory,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->pageFactory = $pageFactory;
        $this->factory = $factory;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $isAjax = $this->getRequest()->isAjax();
        if ($isAjax) {
            $component = $this->factory->create($this->_request->getParam('namespace'));
            $this->prepareComponent($component);
            $this->_response->appendBody($component->render());
        } else {
            return $this->pageFactory->create();
        }
    }

    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}
