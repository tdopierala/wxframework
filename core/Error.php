<?php

namespace Core;

use Core\View;

/**
 * Error and exception handler
 * 
 */
class Error
{

	/**
	 * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
	 * 
	 * @param int $level Error level
	 * @param string $message Error message
	 * @param string $file File name the error was raised in
	 * @param int $line Line number in the file
	 * 
	 * @return void
	 */
	public static function errorHandler(int $level, string $message, string $file, int $line) : void
	{
		if(error_reporting() !== 0) { // for @ operator to work
			throw new \ErrorException($message, 0, $level, $file, $line);
		}
	}

	/**
	 * Exception handler.
	 * 
	 * $param Exception $exception The exception
	 * 
	 * @return void
	 */
	public static function exceptionHandler(\Exception $exception) : void
	{
		//Code is 404 (not found) or 500 (general error)
		$code = $exception->getCode();
		if($code != 404) {
			$code = 500;
		}
		\http_response_code($code);

		$log = \dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
		\ini_set('error_log', $log);

		$msg  = "\nUncaught exception: " . get_class($exception);
		$msg .= " with message: " . $exception->getMessage();
		$msg .= "\nStack trace: " . $exception->getTraceAsString();
		$msg .= "\nThrown in " . $exception->getFile() . " on line " . $exception->getLine();

		\error_log($msg);

		if($code == 404) {
			//echo "<h1>Page not found</h1>";
		} else {
			//echo "<h1>An error occurred</h1>";
		}

		View::render($code.'.phtml', [
			'massage' => $msg
		]);
		
		/* if(\Config\Config::SHOW_ERRORS) {
			//echo "<h1>Fatal error</h1>";
			echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
			echo "<p>Message: '" . $exception->getMessage() . "'</p>";
			echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
			echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
		} */
	}
}