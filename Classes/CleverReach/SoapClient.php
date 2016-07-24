<?php

namespace WapplerSystems\FormhandlerCleverreach\CleverReach;


/**
 * @method mixed receiverGetByEmail(string $apiKey, integer $listId, string $email, integer $level)
 * @method mixed receiverDelete (string $apiKey, integer $listId, string $email)
 * @method mixed receiverAdd (string $apiKey, integer $listId, array $receiverData);
 * @method mixed receiverSetActive (string $apiKey, integer $listId, string $email)
 * @method mixed receiverSetInactive (string $apiKey, integer $listId, string $email)
 * @method mixed formsSendUnsubscribeMail (string $apiKey, integer $formId, string $email)
 * @method mixed formsSendActivationMail (string $apiKey, integer $formId, string $email, array $doidata);
 **/
class SoapClient extends \SoapClient { }