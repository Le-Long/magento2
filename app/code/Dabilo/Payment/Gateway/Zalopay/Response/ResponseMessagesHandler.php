<?php


namespace Dabilo\Payment\Gateway\Zalopay\Response;

use Dabilo\Payment\Gateway\Zalopay\Validator\AbstractResponseValidator;
use Magento\Sales\Model\Order\Payment;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Payment\Gateway\Response\HandlerInterface;

class ResponseMessagesHandler implements HandlerInterface
{
    /**
     * @param array $handlingSubject
     * @param array $response
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = SubjectReader::readPayment($handlingSubject);
        /** @var Payment $payment */
        $payment = $paymentDO->getPayment();
        ContextHelper::assertOrderPayment($payment);

        $responseCode = $response[AbstractResponseValidator::RETURN_CODE];
        $messages     = $response[AbstractResponseValidator::RESPONSE_MESSAGE];
        $state        = $this->getState($responseCode);

        if ($state) {
            $payment->setAdditionalInformation(
                'approve_messages',
                $messages
            );
        } else {
            $payment->setIsTransactionPending(false);
            $payment->setIsFraudDetected(true);
            $payment->setAdditionalInformation('error_messages', $messages);
        }
    }

    /**
     * @param integer $responseCode
     * @return boolean
     */
    protected function getState($responseCode): bool
    {
        if ((string)$responseCode === '1' || (string)$responseCode === '2') {
            return false;
        }
        return true;
    }
}

