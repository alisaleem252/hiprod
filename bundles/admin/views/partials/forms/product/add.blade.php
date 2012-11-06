{{ Form::vertical_open(null, 'GET', array('id' => 'search')) }}
    {{ Form::label('searchInput', 'Search Criteria') }}
    {{ Form::text('searchInput', null, array('class' => 'span12 searchInput', 'placeholder' => 'Type something...')) }}

    {{ Form::label('vendorAsiNumber', 'ASI #') }}
    <?php $select = array();?>
    <?php 
        foreach(Vendor::order_by('name')->get(array('asi_number', 'name')) as $option):
            $select[$option->asi_number] = $option->name . ' (' . $option->asi_number . ')';
        endforeach;
    ?>
    {{ Form::select('selectAsiNumber', $select, Input::query('selectAsiNumber', ''), array('class' => 'span12 selectAsiNumber')) }}
    {{ '<div></div>' }}
    {{ Form::hidden('page', 1, array('class' => 'page')) }}
    {{ Form::submit('Search') }}
{{ Form::close() }}