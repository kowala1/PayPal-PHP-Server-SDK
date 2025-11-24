<?php

declare(strict_types=1);

namespace PaypalServerSdkLib\Controllers;

use Core\Request\Parameters\BodyParam;
use Core\Request\Parameters\HeaderParam;
use Core\Request\Parameters\QueryParam;
use Core\Response\Types\ErrorType;
use CoreInterfaces\Core\Request\RequestMethod;
use PaypalServerSdkLib\Exceptions\ErrorException;
use PaypalServerSdkLib\Http\ApiResponse;
use PaypalServerSdkLib\Models\Webhook;
use PaypalServerSdkLib\Models\WebhooksEventTypeListResponse;
use PaypalServerSdkLib\Models\WebhookSimulateRequest;
use PaypalServerSdkLib\Models\WebhooksListResponse;

class WebhookController extends BaseController
{
    public function listWebhooks(array $options = [])
    {
        $requestBuilder = $this->requestBuilder(RequestMethod::GET, '/v1/notifications/webhooks')
            ->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
                QueryParam::init('anchor_id', $options)->extract('eventType')
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
            ->type(WebhooksListResponse::class)
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }

    public function listAvailableEventTypes()
    {
        $requestBuilder = $this->requestBuilder(RequestMethod::GET, '/v1/notifications/webhooks-event-types')
            ->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
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
            ->throwErrorOn('0', ErrorType::init('The error response.', ErrorException::class))
            ->type(WebhooksEventTypeListResponse::class)
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }

    public function createWebhook(array $options = [])
    {
        $requestBuilder = $this->requestBuilder(RequestMethod::GET, '/v1/notifications/webhooks')
            ->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
                BodyParam::init($options)->extract('body')
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
            ->type(Webhook::class)
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }

    public function deleteWebhook(string $webhookId)
    {
        $requestBuilder = $this->requestBuilder(
            RequestMethod::DELETE,
            sprintf('/v1/notifications/webhooks/%s', $webhookId)
        )->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
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
                '403',
                ErrorType::init('Authorization failed due to insufficient permissions.', ErrorException::class)
            )
            ->throwErrorOn('500', ErrorType::init('An internal server error has occurred.', ErrorException::class))
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }

    public function simulateWebhook(array $options)
    {
        $requestBuilder = $this->requestBuilder(RequestMethod::POST, '/v1/notifications/simulate-event')
            ->auth('Oauth2')
            ->parameters(
                HeaderParam::init('Content-Type', 'application/json'),
                BodyParam::init($options)->extract('body')
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
            ->returnApiResponse();

        return $this->execute($requestBuilder, $responseHandler);
    }
}
