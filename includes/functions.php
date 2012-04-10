<?php

ini_set('session.save_path','/session/');

function check_messages ()
{
	if ( isset ($_GET['message']) )
	{
		$messages = explode(' ', $_GET['message']);
		foreach($messages as $message => $value)
		{
			if ($value == '') unset($messages[$message]);
		}
		$messages = array_values($messages);
		return $messages;
	}
	return false;
}

function display_messages ($message, $system_messages)
{
	if ( $message )
	{
		foreach ( $message as $m )
		{
			echo '<p class="message">' . $system_messages[$m] . '</p>';
		}
	}
}

function display_message ($message, $system_messages)
{
	if ( $message )
	{
		 echo '<p class="message">We\'re sorry, but ' . $system_messages["$message"] . '</p>';	
	}
}

?>