<?php

Route::get('asi/(product|supplier)/(search|record)', array(
    'as'   => 'asi',
    'uses' => 'asi::(:1)@(:2)'
));

/* End of file routes.php */