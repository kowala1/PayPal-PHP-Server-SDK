<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Controllers;

use Core\Request\Parameters\BodyParam;
use Core\Request\Parameters\HeaderParam;
use Core\Response\Types\ErrorType;
use CoreInterfaces\Core\Request\RequestMethod;
use PaypalServerSdkLib\Exceptions\ErrorException;
use PaypalServerSdkLib\Models\Webhook;

class WebhookController extends BaseController
{
    public function listWebhooks(array $options)
    {
        $requestBuilder = $this->requestBuilder(RequestMethod::GET, '/v1/notifications/webhooks')
            ->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
                BodyParam::init($options)->extract('body'),
            );

        $responseHandler = $this->responseHandler()
            ->throwErrorOn(
                '400',
                ErrorType::init(
                    'Request is not well-formed, syntactically incorrect, or violates schema.',
                    ErrorException::class
                )
            )
            ->throwErrorOn(
                '401',
                ErrorType::init(
                    'Authentication failed due to missing authorization header, or invalid auth' .
                    'entication credentials.',
                    ErrorException::class
                )
            )
            ->throwErrorOn(
                '422',
                ErrorType::init(
                    'The requested action could not be performed, semantically incorrect, or fa' .
                    'iled business validation.',
                    ErrorException::class
                )
            )
            ->throwErrorOn('0', ErrorType::init('The error response.', ErrorException::class))
            ->type(Webhook::class, 1)
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }
}
