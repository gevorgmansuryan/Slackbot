<?php

namespace Gevman\SlackBot;

use GuzzleHttp\Client;

class IncomingBot
{
	/**
	 * @var Client
	 */
	private $httpClient;
	/**
	 * @var string
	 */
	private $incomingHookUrl;

	/**
	 * IncomingBot constructor.
	 *
	 * @param $incomingHookUrl
	 */
	public function __construct($incomingHookUrl)
	{
		$this->incomingHookUrl = $incomingHookUrl;
		$this->httpClient = new Client(['verify' => false]);
	}

	/**
	 * @param $msg
	 *
	 * @return IncomingMessage
	 */
	public function send($msg)
	{
		return new IncomingMessage($msg, $this->httpClient, $this->incomingHookUrl);
	}
}