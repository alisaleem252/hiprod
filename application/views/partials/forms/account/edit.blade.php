<?php

    // Open the form
    echo Form::horizontal_open(null, 'POST', array('class' => 'well'));
            
        // Username control group
        echo Form::control_group(
                Form::label('asi_number', 'ASI #'),
                Form::text('asi_number', Input::old('asi_number', $client->asi_number)), $errors->has('asi_number') ? 'error ' : '',
                $errors->has('asi_number') ? Form::block_help( $errors->first('asi_number') ) : ''
            );
    
        // Username control group
        echo Form::control_group(
                Form::label('email', 'Email'),
                Form::text('email', Input::old('email', $client->email)), $errors->has('email') ? 'error ' : '',
                $errors->has('email') ? Form::block_help( $errors->first('email') ) : ''
            );
    
        // Username control group
        echo Form::control_group(
                Form::label('username', 'Username'),
                Form::text('username', Input::old('username', $client->username)), $errors->has('username') ? 'error ' : '',
                $errors->has('username') ? Form::block_help( $errors->first('username') ) : ''
            );

        // Password control group
        echo Form::control_group(
                Form::label('password', 'Password'),
                Form::password('password'), $errors->has('password') ? 'error ' : '',
                $errors->has('password') ? Form::block_help( $errors->first('password') ) : ''
        );    
        
        // Form Buttons
        echo Form::actions(array(
                Form::submit('Update Account', array('class' => 'btn btn-primary'))
        ));
        
    // Close the form
    echo Form::close();
;?>