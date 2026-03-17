<?php

namespace Redberry\LaravelConsole\App;

class Log
{
	/**
	 * Laravel console message possible types.
	 */
	const NUMBER = 'number';
	const STRING = 'string';
	const OBJECT = 'object';
	const NULL = 'null';

	/**
	 * log id.
	 */
	public int $id;

	/**
	 * log level.
	 */
	public string $level;

	/**
	 * log message.
	 */
	public mixed $message;

	/**
	 * Log type.
	 */
	public string $type;

        /**
         * Trace info.
         */
        public Trace $trace;

	/**
	 * Format laravel console log.
	 */
	public function __construct(int $id, string $level, mixed $message, Trace $trace)
	{
		$this->id = $id;
		$this->level = $level;
		$this->type = $this->getMessageType($message);
		$this->message = $message;
                $this->trace = $trace;
	}

	/**
	 * Get message type.
	 */
	protected function getMessageType(mixed $message): string
	{
		$nativeType = gettype($message);

		if (in_array($nativeType, ['boolean', 'integer', 'double'])) {
			return self::NUMBER;
		}

		if ($nativeType === 'string') {
			return self::STRING;
		}

		if (in_array($nativeType, ['object', 'array'])) {
			return self::OBJECT;
		}

		if ($nativeType === 'NULL') {
			return self::NULL;
		}

		throw new \InvalidArgumentException("Type '{$nativeType}' cannot be handled by Laravel Console.");
	}

	/**
	 * Convert log into json.
	 */
	public function json(): string
	{
		return json_encode($this->toArray());
	}

	/**
	 * Convert to array.
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'level' => $this->level,
			'type' => $this->type,
			'message' => $this->message,
                        'line' => $this->trace->line,
                        'file' => $this->trace->file,
		];
	}
}
