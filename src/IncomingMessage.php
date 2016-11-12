<?php

namespace Gevman\SlackBot;

use GuzzleHttp\Client;

class IncomingMessage
{
	private $httpClient;
	private $incomingHookUrl;
	private $request = [];
	private $attachments = [];

	public static function send($msg)
	{
		return new IncomingBot($msg);
	}

	public function to($to)
	{
		$this->request['channel'] = $to;
		return $this;
	}

	public function attach($attachment)
	{
		$this->attachments[] = $attachment;
		return $this;
	}

	public function from($from)
	{
		$this->request['username'] = $from;
		return $this;
	}

	public function withTitle($title)
	{
		$this->request['title'] = $title;
		return $this;
	}

	public function withIcon($icon)
	{
		if (!filter_var($icon, FILTER_VALIDATE_URL) === false) {
			$this->request['icon_url'] = $icon;
		} else {
			$this->request['icon_emoji'] = $icon;
		}
		return $this;
	}

	public function __construct($msg, Client $httpClient, $incomingHookUrl)
	{
		$this->httpClient = $httpClient;
		$this->incomingHookUrl = $incomingHookUrl;
		$this->request['text'] = $msg;
	}

	public function __destruct()
	{
		if (!empty($this->attachments)) {
			$this->request['attachments'] = $this->attachments;
		}
		$this->httpClient->post($this->incomingHookUrl, ['form_params' => ['payload' => \GuzzleHttp\json_encode($this->request)]]);
	}
}