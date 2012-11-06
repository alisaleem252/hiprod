{{ Form::vertical_open(null, 'POST', array('id' => 'search')) }}
{{ Form::text('searchInput', null, array('class' => 'searchInput span9', 'placeholder' => 'Example: 61125')) }}
{{ Form::submit('Search', array('class' => 'span3 pull-right')) }}
{{ Form::close() }}