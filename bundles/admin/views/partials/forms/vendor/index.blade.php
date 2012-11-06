{{ Form::open(null, 'GET', array('class' => 'noMargins', 'style' => 'padding:10px 10px 0 10px')) }}
{{ Form::input('text', 'name', null, array('class' => 'input-medium pull-left span9')) }}
{{ Form::submit('Search', array('class' => 'btn pull-right span3')) }}
{{ Form::close() }}